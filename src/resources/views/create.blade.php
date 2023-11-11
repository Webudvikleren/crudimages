@extends('layout.app')
@section('meta_title', trans('crudimages::image.upload'))

@section('content')
<h1>{{ trans('crudimages::image.upload') }}</h1>
@include('crudimages::form')
@endsection