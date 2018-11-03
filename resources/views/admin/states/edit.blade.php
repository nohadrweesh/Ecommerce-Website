@extends('admin.index')
@section('content')
@push('js')

<script>
  $(document).ready(function(){
    @if($city->country_id)

       $.ajax({
          url:"{{ admin_url('states/create') }}",
          type:'get',
          dataType:'html',
          data:{country_id:"{{$city->country_id}}",select:"{{$city->city_id}}"},
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
  	{!! Form::model($city,['id'=>'form_data','url'=>admin_url('states/'.$city->id),'method'=>'Put','files'=>true])!!}
    <div class="form-group">
             {!!  Form::label('city_name_ar','Arabic City Name')!!}
             {!! Form::text('city_name_ar',$city->state_name_ar,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
              {!!  Form::label('city_name_en','English City Name')!!}
             {!! Form::text('city_name_en',$city->state_name_en,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">

              {!!  Form::label('country_id','Country Id')!!}
              {!! Form::select('country_id',$country_ids,old('country_id'),['class'=>'country_id form-control'])!!}
        </div>

        

          <div class="form-group">

              {!!  Form::label('city_id','City')!!}
            {!! Form::select('city_id',[],$city->city_id,['class'=>'form-control city'])!!}
        </div>


        
         
         <div class="form-group">
        
     {!! Form::submit('Edit',['class'=>'btn btn-primary'])!!}
</div>



  
    {!!Form::close()!!}
     
   
  </div>
  <!-- /.box-body -->
</div>




@stop