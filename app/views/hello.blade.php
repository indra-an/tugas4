@extends("layouts.application")

@section("content")

  @if (Session::has('notice')) <div class="alert alert-info">{{Session::get('notice')}}</div>       @endif

  @if (Session::has('error')) <div class="alert alert-danger">{{Session::get('error')}}</div>       @endif

  <h1>Never Stop Learn, Roking \m/</h1>

@stop