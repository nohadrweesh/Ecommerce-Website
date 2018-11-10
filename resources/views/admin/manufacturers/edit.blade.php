@extends('admin.index')
@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{$title}}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  	{!! Form::model($country,['id'=>'form_data','url'=>admin_url('trademarks/'.$country->id),'method'=>'Put','files'=>true])!!}
    <div class="form-group">
             {!!  Form::label('name_ar','Arabic Trademark Name')!!}
             {!! Form::text('name_ar',$country->name_ar,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
              {!!  Form::label('name_en','English Trademark Name')!!}
             {!! Form::text('name_en',$country->name_en,['class'=>'form-control'])!!}
        </div>
      @if(!empty($country->logo))
          <img src="{{Storage::url($country->logo)}}" width="50px" />
      @endif
        <div class="form-group">
          {!! Form::label('logo','Logo') !!}
          {!! Form::file('logo',['class'=>'form-control']) !!}
        </div> 

     {!! Form::submit('Edit',['class'=>'btn btn-primary'])!!}




  
    {!!Form::close()!!}
     
   
  </div>
  <!-- /.box-body -->
</div>




@stop