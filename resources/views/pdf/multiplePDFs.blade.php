<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple PDFs</title>

</head>

<body>
    @foreach($pdfFiles as $pdfContent)
        <embed src="data:application/pdf;base64,{{ base64_encode($pdfContent) }}" type="application/pdf" width="100%" height="800px" />
        <hr>
    @endforeach
</body>

</html>
