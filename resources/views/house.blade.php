@extends('app')
@section('content')
  @include('includes.navbar-desktop', ['index' => false])
  @include('includes.navbar-mobile', ['index' => false])
@endsection
