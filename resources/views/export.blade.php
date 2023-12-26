<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @livewireStyles
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

</head>
<body>

{{-- /    <livewire:export-donations :key="$key"/> --}}
    @livewire('export-donations', ['key' => $key,'ref' => $ref,'name'=>$name,'from'=>$from,'to'=>$to])

    @livewireScripts

</body>
</html>
