@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false])
@section('content')
{{-- @include('Pages.Bills.HebrowBills') --}}
@include('Pages.Bills.ArabicBills')
{{-- @include('Pages.Bills.EnglishBills') --}}


@endsection