@extends('layout.app', ['hasHeader' => false, 'hasFooter' => false])



@section('content')
    @if ($key == 'Report')
        @if ($print == 1)
            @livewire('export-report', ['key' => $key, 'ref' => $ref, 'name' => $name, 'from' => $from, 'to' => $to, 'dateType' => $dateType, 'PaymentType' => $PaymentType])
        @else
            @livewire('export-donations', ['key' => $key, 'ref' => $ref, 'name' => $name, 'from' => $from, 'to' => $to, 'dateType' => $dateType, 'PaymentType' => $PaymentType])
        @endif
    @else
        @livewire('export-donations', ['key' => $key, 'ref' => $ref, 'name' => $name, 'from' => $from, 'to' => $to, 'dateType' => $dateType, 'PaymentType' => $PaymentType])
    @endif


    @livewireScripts
@endsection
