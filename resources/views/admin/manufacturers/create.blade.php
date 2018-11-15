@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script type="text/javascript" src="{{url('design\adminlte\dist\js\locationpicker.jquery.js')}}"></script>
@endpush

<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{$title}}</h3>
  </div>
  <!-- /.box-header -->
     <div class="box-body">
  	{!! Form::open(['id'=>'form_data','url'=>admin_url('manufacturers'),'method'=>'Post','files'=>true])!!}
        <div class="form-group">
             {!!  Form::label('name_ar','Arabic  Name')!!}
             {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
              {!!  Form::label('name_en','English  Name')!!}
             {!! Form::text('name_en',old('name_en'),['class'=>'form-control'])!!}
        </div>
      <div class="form-group">
          {!!  Form::label('mobile','mobile')!!}
          {!! Form::number('mobile',old('mobile'),['class'=>'form-control'])!!}
      </div>
      <div class="form-group">
          {!!  Form::label('email','email')!!}
          {!! Form::email('email',old('email'),['class'=>'form-control'])!!}
      </div>
      <div class="form-group">
          {!!  Form::label('contact_name','contact_name')!!}
          {!! Form::text('contact_name',old('contact_name'),['class'=>'form-control'])!!}
      </div>

      <div class="form-group">
          {!!  Form::label('twitter','twitter')!!}
          {!! Form::url('twitter',old('twitter'),['class'=>'form-control'])!!}
      </div>

      <div class="form-group">
          {!!  Form::label('facebook','facebook')!!}
          {!! Form::url('facebook',old('facebook'),['class'=>'form-control'])!!}
      </div>

      <div class="form-group">
          {!!  Form::label('website','website')!!}
          {!! Form::url('website',old('website'),['class'=>'form-control'])!!}
      </div>

        <div class="form-group">
          {!! Form::label('logo','Logo') !!}
          {!! Form::file('logo',['class'=>'form-control']) !!}
        </div> 
     {!! Form::submit('Create Manufacturer',['class'=>'btn btn-primary'])!!}




  
    {!!Form::close()!!}
     
   
  </div>
  <!-- /.box-body -->
</div>




@stop