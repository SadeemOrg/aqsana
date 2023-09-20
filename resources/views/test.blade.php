<!DOCTYPE html>
<html lang="en">
<head>
  <title>How To Export Excel File In Laravel 9 - Techsolutionstuff</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<form method="POST" action="{{ route('submit-form') }}">
    @csrf <!-- This generates a CSRF token to protect against cross-site request forgery -->
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>
    <!-- Add more form fields as needed -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>
