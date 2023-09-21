<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <button id="downloadExcel">Download Excel</button>
    <button onclick="downloadExcel()" id="btn-download-payroll" class="btn btn-dark-success btn-md"
        style="transform: translateY(50%); top: 50%; font-size: 13px;"><i aria-hidden="true" class="fa fa-cog mr-10"></i>
        Download
    </button>
    <script>
        function downloadExcel() {

            $.ajax({
                xhrFields: {
                    responseType: 'blob',
                },
                type: 'get',
                url: '/export/excel',

                success: function(result, status, xhr) {

                    var disposition = xhr.getResponseHeader('content-disposition');
                    var matches = /"([^"]*)"/.exec(disposition);
                    var filename = (matches != null && matches[1] ? matches[1] : 'salary.csv');

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
