<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <a href="/export/excel">rrt</a>
    <button id="downloadExcel">Download Excel</button>
    <button onclick="downloadExcel()" id="btn-download-payroll" class="btn btn-dark-success btn-md"
        style="transform: translateY(50%); top: 50%; font-size: 13px;"><i aria-hidden="true" class="fa fa-cog mr-10"></i>
        Download
    </button>
    <script>
        function downloadExcel() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                xhrFields: {
                    responseType: 'blob',
                },
                type: 'post ',
                url: 'submit-form',

                success: function(result, status, xhr) {

                    var disposition = xhr.getResponseHeader('content-disposition');
                    var matches = /"([^"]*)"/.exec(disposition);
                    var filename = (matches != null && matches[1] ? matches[1] : 'salary.xlsx');

                    // The actual download
                    var blob = new Blob([result], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;

                    document.body.appendChild(link);

                    link.click();
                    document.body.removeChild(link);
                }
            });
        }
        $(document).ready(function() {
            $('#downloadExcel').click(function() {
                // Send a GET request to the Laravel route
                $.get('/export/excel', function() {

                });
            });
        });
    </script>
</body>

</html>
