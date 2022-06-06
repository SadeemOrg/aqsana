@extends('layout.app')

@section('content')
@include('layout.front-end.partial._top_banner')
@include('Components.Association_news')
@include('Components.AlaqsaBaneer')
@include('Components.ProjectNews')
@include('Components.Our_business_sectors')
@include('layout.front-end.partial.contact-us')
@endsection
