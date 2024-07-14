<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Tabs</title>
</head>
<body>
    <script>
        const urls = @json($urls);

        urls.forEach(url => {
            window.open(url, '_blank');
        });

        // Close this tab after opening all URLs
        // window.close();
    </script>
</body>
</html>
