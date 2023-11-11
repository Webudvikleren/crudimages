@extends('layout.app')
@section('meta_title', trans('crudimages::image.update'))

@section('content')
<h1>{{ trans('crudimages::image.update') }}</h1>
@include('crudimages::form')
@endsection