@extends('layout.app')
@section('content')
@include('layout.front-end.partial._top_banner')
{{-- @include('layout.front-end.partial._left-sidebar') --}}
@include('Components.Home.Association_news')
@include('Components.Home.AlaqsaBaneer')
@include('Components.Home.ProjectNews')
{{-- @include('Components.Home.Project_Support') --}}
@include('Components.Home.AlaqsaBaneerBottomBanner')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8  px-2">
@include('Components.Home.watch-us')
</div>
@include('Components.Home.Our_business_sectors')
<div class=" mt-24 overflow-hidden">
    @include('layout.front-end.partial.contact-us')
</div>
@endsection
