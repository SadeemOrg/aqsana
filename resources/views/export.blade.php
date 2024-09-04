
@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false ])
@section('content')
    @if ($key=='Report')

    @livewire('export-report', ['key' => $key,'ref' => $ref,'name'=>$name,'from'=>$from,'to'=>$to,'dateType'=>$dateType,'PaymentType'=>$PaymentType])

    @else

    @livewire('export-donations', ['key' => $key,'ref' => $ref,'name'=>$name,'from'=>$from,'to'=>$to,'dateType'=>$dateType,'PaymentType'=>$PaymentType])
    @endif


    @livewireScripts
@endsection
