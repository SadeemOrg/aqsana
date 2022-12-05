@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false,'left_SideBar'=>false])
@section('content')
@if($Transaction->lang == 1)
@include('Pages.Bills.ArabicBills')
@elseif($Transaction->lang == 2)
@include('Pages.Bills.EnglishBills')
@else 
@include('Pages.Bills.HebrowBills')
@endif
@endsection