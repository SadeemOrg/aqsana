<!DOCTYPE html>
<html>

<head>
    <title>Ameeed.com</title>

</head>


<body>


    {{-- <h1 class="mt-10 add text-gray-400">Bill Ass </h1> --}}
    <div style="position: absolute;left: 39.5%; top:5%; @media(max-width: 600px){background:black;} ">
        <img style="widows: 170px;height:170px;"
            src="https://media.discordapp.net/attachments/938405759996276806/1064898282293301319/9a67de7e-4803-4aba-9b46-e7c1e8d3885b.jpg"
            alt="aqsa">
    </div>
    <p class="download" style="text-align: center;cursor: pointer; margin-top: 25%;"> To download the Pdf Bilss Just Click
        here</p>
    <a style="position: absolute; top:60%; left:45%; color: black"
        href='{{ config('app.url') . '/generate-pdf/' . $Transaction['id'] }}' style="text-align: center">Downlaod Pdf</a>
</body>

</html>
