@extends('admin.layouts.layout')

@section('content')
<x-card-component parentHeading="Dashboard" childHeading="Dashboard" parentUrl="{{route('admin.dashboard')}}" />

@endsection