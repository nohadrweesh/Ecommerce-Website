@extends('admin.index')
@section('content')
    @push('js')
        <script>
            $(function () {
                // 6 create an instance when the DOM is ready
                $('#jstree').jstree({ 'core' : {
                        "themes" : {
                            "variant" : "large"
                        },
                        'data' : [
                            { "id" : "1", "parent" : "#", "text" : "Simple root node" },
                            { "id" : "2", "parent" : "1", "text" : "Root node 2" },
                            { "id" : "3", "parent" : "2", "text" : "Child 1" },
                            { "id" : "4", "parent" : "2", "text" : "Child 2" },
                        ]
                    },

                    "checkbox" : {
                        "keep_selected_style" : false
                    },
                    "plugins" : [ "wholerow" ]


                });

                $('button').on('click', function () {
                    $('#jstree').jstree(true).select_node('child_node_1');
                    $('#jstree').jstree('select_node', 'child_node_1');
                    $.jstree.reference('#jstree').select_node('child_node_1');
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
  	{!! Form::open(['id'=>'form_data','url'=>admin_url('departments'),'method'=>'Post','files'=>true])!!}
        <div class="form-group">
             {!!  Form::label('dep_name_ar','Arabic Department Name')!!}
             {!! Form::text('dep_name_ar',old('dep_name_ar'),['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
              {!!  Form::label('dep_name_en','English Department Name')!!}
             {!! Form::text('dep_name_en',old('dep_name_en'),['class'=>'form-control'])!!}
        </div>
        <div class="form-group">

              {!!  Form::label('parent_id','Parent Department')!!}
            <div id="jstree"></div>

        </div>
      <div class="form-group">
          {!! Form::label('icon',trans('admin.icon')) !!}
          {!! Form::file('icon',['class'=>'form-control']) !!}
      </div>

      <div class="form-group">
          {!! Form::label('description',trans('admin.description')) !!}
          {!! Form::textarea('description',old('description'),['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
          {!! Form::label('keywords',trans('admin.keywords')) !!}
          {!! Form::textarea('keywords',old('keywords'),['class'=>'form-control']) !!}
      </div>
     {!! Form::submit('Create Department',['class'=>'btn btn-primary'])!!}




  
    {!!Form::close()!!}
     
   
  </div>
  <!-- /.box-body -->
</div>




@stop