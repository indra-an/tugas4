@extends("layouts.application")

@section("content")

 {{Form::open(array('url' => 'import-excel', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form'))}}
  
  <div class="form-group">
    {{Form::label('file', 'File Excel', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-9">
      {{Form::file('file', null, array('class' => 'form-control', 'autofocus' => true))}}
      {{$errors->first('file')}}
    </div>
    <div class="clear"></div>
  </div>
  
  <div class="form-group">
    <div class="col-lg-3"></div>
    <div class="col-lg-9">
      {{Form::submit('Import', array('class' => 'btn btn-primary'))}}
    </div>
    <div class="clear"></div>
  </div>
  
  {{Form::close()}}


@stop