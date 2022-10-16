<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @livewireStyles
</head>
<body>

@php
use App\Models\Book;
 $Books = Book::all();
@endphp
    @livewire('type', ['Books' => $Books])


    @livewireScripts
</body>
</html>
