@extends('admin.index')
@section('content')
    @push('js')
        <script>
            $(document).ready(function(){
                // 6 create an instance when the DOM is ready
                $('#jstree').jstree({ 'core' : {
                        "themes" : {
                            "variant" : "large"
                        },
                        'data' :{!! load_departments($department->parent_id,$department->id)!!}
                    },

                    "checkbox" : {
                        "keep_selected_style" : false
                    },
                    "plugins" : [ "wholerow" ]


                });

                $('#jstree').on('changed.jstree',function(e,data){
                  var i,j,r=[];
                  for(i=0,j=data.selected.length;i<j;i++){
                    r.push(data.instance.get_node(data.selected[i]).id);
                  }
                
                  $('.parent_id').val(r);

                });


              
            });
        </script>
    @endpush

<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{$title}}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::model($department,['id'=>'form_data','url'=>admin_url('departments/'.$department->id),'method'=>'Put','files'=>true])!!}
        <div class="form-group">
             {!!  Form::label('dep_name_ar','Arabic Department Name')!!}
             {!! Form::text('dep_name_ar',$department->dep_name_ar,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
              {!!  Form::label('dep_name_en','English Department Name')!!}
             {!! Form::text('dep_name_en',$department->dep_name_en,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">

              {!!  Form::label('parent_id','Parent Department')!!}
              <input type="hidden" name="parent_id" class="parent_id" value="{{$department->parent_id}}">
            <div id="jstree"></div>

        </div>

        @if(!empty($department->icon))
    <img src="{{Storage::url($department->icon)}}" width="50px" >
    @endif
      <div class="form-group">
          {!! Form::label('icon',trans('admin.icon')) !!}
          {!! Form::file('icon',['class'=>'form-control']) !!}
      </div>

      <div class="form-group">
          {!! Form::label('description',trans('admin.description')) !!}
          {!! Form::textarea('description',$department->description,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
          {!! Form::label('keywords',trans('admin.keywords')) !!}
          {!! Form::textarea('keywords',$department->keywords,['class'=>'form-control']) !!}
      </div>
     {!! Form::submit('Edit Department',['class'=>'btn btn-primary'])!!}




  
    {!!Form::close()!!}
     
   
  </div>
  <!-- /.box-body -->
</div>




@stop