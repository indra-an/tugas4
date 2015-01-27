@extends("layouts.application")
@section("content")

{{Form::open(array('url' => 'articles', 'class' => 'form-horizontal', 'role' => 'form'))}}

  <div class="form-group">
    {{Form::label('title', 'Title', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-9">
      {{Form::text('title', null, array('class' => 'form-control', 'autofocus' => 'true'))}}
      {{$errors->first('title')}}
    </div>
    <div class="clear"></div>
  </div>


  <div class="form-group">
    {{Form::label('content', 'Content', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-9">
      {{Form::textarea('content', null, array('class' => 'form-control', 'rows' => 10))}}
      {{$errors->first('content')}}
    </div>
    <div class="clear"></div>
  </div>


  <div class="form-group">
    {{Form::label('author', 'Writer', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-9">
      {{Form::text('author', null, array('class' => 'form-control'))}}
      {{$errors->first('author')}}
    </div>
    <div class="clear"></div>
  </div>


  <div class="form-group">
    <div class="col-lg-3"></div>
    <div class="col-lg-9">
      {{Form::submit('Save', array('class' => 'btn btn-primary'))}}
    </div>
    <div class="clear"></div>
  </div>
  
{{Form::close()}}

@stop

