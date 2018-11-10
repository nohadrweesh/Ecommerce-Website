@extends('admin.index')
@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{$title}}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  	{!! Form::open(['id'=>'form_data','url'=>admin_url('trademarks'),'method'=>'Post','files'=>true])!!}
        <div class="form-group">
             {!!  Form::label('name_ar','Arabic Trademark Name')!!}
             {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
              {!!  Form::label('name_en','English Trademark Name')!!}
             {!! Form::text('name_en',old('name_en'),['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
          {!! Form::label('logo','Logo') !!}
          {!! Form::file('logo',['class'=>'form-control']) !!}
        </div> 
     {!! Form::submit('Create Trademark',['class'=>'btn btn-primary'])!!}




  
    {!!Form::close()!!}
     
   
  </div>
  <!-- /.box-body -->
</div>




@stop