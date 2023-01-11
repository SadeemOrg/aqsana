<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
    @php

    @endphp
    <h1>Bill  </h1>

    <p><span>sector </span> {{ $Transaction->Sectors->text }}</p>
    <p><span>ref_id </span> {{ $Transaction->Project->project_name }}</p>

      <p><span>equivelant_amount </span> {{ $Transaction->equivelant_amount }}</p>
      <p><span>name </span> {{ $Transaction->TelephoneDirectory->name }}</p>
      <p><span>company_number </span> {{ $Transaction->company_number }}</p>
      <p><span>bill_number </span> {{ $Transaction->bill_number }}</p>
    <p>Thank you</p>
</body>
</html>
