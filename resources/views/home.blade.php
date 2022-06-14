@extends('layout.app')

@section('content')
@include('layout.front-end.partial._top_banner')
@include('Components.Home.Association_news')
@include('Components.Home.AlaqsaBaneer')
@include('Components.Home.ProjectNews')
@include('Components.Home.Project_Support')
{{-- @include('Components.Home.AlaqsaBaneerBottomBanner') --}}
@include('Components.Home.Our_business_sectors')
{{-- @include('layout.front-end.partial.contact-us') --}}
@endsection
