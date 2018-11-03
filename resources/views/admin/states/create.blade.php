@extends('admin.index')
@section('content')
@push('js')

<script>
  $(document).ready(function(){
    @if(old('country_id'))
          $.ajax({
          url:"{{ admin_url('states/create') }}",
          type:'get',
          dataType:'html',
          data:{country_id:"{{old('country_id')}}",select:"{{old('city_id')}}"},
          success: function(data){
//alert(data);
              $('.city').html(data);
          }

        });

    @endif
    $(document).on('change','.country_id',function(){
      //alert("changed");
      var country=$('.country_id option:selected').val();
      if(country>0){
        $.ajax({
          url:"{{ admin_url('states/create') }}",
          type:'get',
          dataType:'html',
          data:{country_id:country,select:''},
          success: function(data){
//alert(data);
              $('.city').html(data);
          }

        });
      }else{
        $('.city').html(' {!! Form::select('city_id',[],'................................',['class'=>'form-control city','placeholder'=>'..................'])!!}');
      }

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
  	{!! Form::open(['id'=>'form_data','url'=>admin_url('states'),'method'=>'Post'])!!}
        <div class="form-group">
             {!!  Form::label('state_name_ar','Arabic State Name')!!}
             {!! Form::text('state_name_ar',old('state_name_ar'),['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
              {!!  Form::label('state_name_en','English State Name')!!}
             {!! Form::text('state_name_en',old('state_name_en'),['class'=>'form-control'])!!}
        </div>
         <div class="form-group">

              {!!  Form::label('country_id','Country')!!}
             {!! Form::select('country_id',$country_ids,old('country_id'),['class'=>'country_id form-control','placeholder'=>'..................'])!!}
        </div>

          <div class="form-group">

              {!!  Form::label('city_id','City')!!}
            {!! Form::select('city_id',[],old('city_id'),['class'=>'form-control city','placeholder'=>'..................'])!!}
        </div>
     
     {!! Form::submit('Create State',['class'=>'btn btn-primary'])!!}




  
    {!!Form::close()!!}
     
   
  </div>
  <!-- /.box-body -->
</div>




@stop