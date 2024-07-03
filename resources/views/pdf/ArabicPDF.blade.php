<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .header img {
            height: 100px;
            display: block;
            margin: 0 auto;
        }

        .info p {
            font-size: 12px;
            margin: 5px 0;
        }

        .info span {
            color: #6B7280;
            font-size: 12px;
        }

        .center-text {
            text-align: center;
            font-size: 12px;
            margin: 5px 0;
        }

        table.blueTable {
            border: 1px solid white;
            background-color: #f1fff1;
            width: 100%;
            text-align: center;
            border-collapse: collapse;
            font-size: 10px;
        }

        table.blueTable th,
        table.blueTable td {
            border: 1px solid white;
            padding: 3px 2px;
        }

        table.blueTable thead th {
            background: #39A423;
            color: white;
        }

        table.blueTable tfoot td {
            font-size: 10px;
        }

        .footer p {
            font-size: 12px;
            margin: 5px 0;
        }

        .footer span {
            color: #6B7280;
            font-size: 12px;
        }

        .images img {
            max-height: 100px;
            display: inline-block;
        }

    </style>
</head>

<body>
    <div class="container">
        <!--Top Image -->
        <div class="header">
            <img src="{{ asset('/assets/image/iuktui.png') }}" alt="alaqsa Logo">
        </div>

        <!--First Paragraph-->
        <div class="info" dir="rtl">
            <p>رقم الجمعية : <span>{{ $society_id }}</span></p>
            <p>العنوان : <span>{{ $address }}</span></p>
            <p>رقم التلفون: <span>{{ $phone }}</span></p>
            <p>الايميل : <span>{{ $email }}</span></p>
        </div>

        <!--Start Second Paragraph-->
        <div class="center-text">
            <p>{{ $ChickBillDate }}</p>
            <p>F-{{ $TransactionArray['bill_number'] }} <span>سند قبض رقم</span></p>
            <p>نسخة عن الفاتورة الأصلية</p>
        </div>

        <!--Start for Account Paragraph-->
        <div class="info" dir="rtl">
            <p>لحساب :
                <span>
                    @if ($TransactionArray['Payment_type'] == 5)
                        حصالة رقم: {{ $TransactionArray['description'] }}
                    @else
                        {{ $TransactionArray['telephone_directory']['name'] }}
                    @endif
                </span>
            </p>
        </div>

        <!--Start Table -->
        <div>
            @if ($PaymentType == 'حوالة مصرفية')
                <table dir="rtl" class="blueTable">
                    <thead>
                        <tr>
                            <th>طريقة الدفع</th>
                            <th>تاريخ الدفع</th>
                            <th>البنك</th>
                            <th>الفرع</th>
                            <th>رقم الحساب</th>
                            <th>المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($TransactionArray['Payment_type_details'] as $ChikPayment)
                            @php
                                $ChickBillDate = date('d/m/Y', strtotime($ChikPayment['attributes']['Date']));
                            @endphp
                            <tr>
                                <td> {{ $PaymentType }} </td>
                                <td>{{ $ChickBillDate }}</td>
                                <td> {{ $ChikPayment['attributes']['bank_number'] }}</td>
                                <td>{{ $ChikPayment['attributes']['Branch_number'] }}</td>
                                <td>{{ $ChikPayment['attributes']['account_number'] }}</td>
                                <td> {{ $ChikPayment['attributes']['equivelant_amount'] }} </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">المجموع :</td>
                            <td>{{ $TransactionArray['equivelant_amount'] }}</td>
                        </tr>
                    </tbody>
                </table>
            @elseif($PaymentType == 'نقدي')
                <table dir="rtl" class="blueTable">
                    <thead>
                        <tr>
                            <th>طريقة الدفع</th>
                            <th>التاريخ</th>
                            <th>المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> {{ $PaymentType }} </td>
                            <td>{{ $ChickBillDate }}</td>
                            <td>{{ $TransactionArray['transact_amount'] }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">المجموع :</td>
                            <td>{{ $TransactionArray['transact_amount'] }}</td>
                        </tr>
                    </tbody>
                </table>
            @elseif($PaymentType == 'بيت')
                <table dir="rtl" class="blueTable">
                    <thead>
                        <tr>
                            <th>طريقة الدفع</th>
                            <th>تاريخ الدفع</th>
                            <th>رقم التلفون</th>
                            <th>المحموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($TransactionArray['Payment_type_details'] as $ChikPayment)
                            @php
                                $ChickBillDate = date('d/m/Y', strtotime($ChikPayment['attributes']['Date']));
                            @endphp
                            <tr>
                                <td> {{ $PaymentType }} </td>
                                <td>{{ $ChickBillDate }}</td>
                                <td>{{ $ChikPayment['attributes']['telephone'] }}</td>
                                <td>{{ $ChikPayment['attributes']['equivelant_amount'] }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">المجموع :</td>
                            <td>{{ $TransactionArray['equivelant_amount'] }}</td>
                        </tr>
                    </tbody>
                </table>
            @elseif($PaymentType == 'شك')
                <table dir="rtl" class="blueTable">
                    <thead>
                        <tr>
                            <th>طريقة الدفع</th>
                            <th>تاريخ الشك</th>
                            <th>رقم البنك</th>
                            <th>رقم الفرع</th>
                            <th>رقم الشك</th>
                            <th>المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($TransactionArray['Payment_type_details'] as $ChikPayment)
                            @php
                                $ChickBillDate = date('d/m/Y', strtotime($ChikPayment['attributes']['Date']));
                            @endphp
                            <tr>
                                <td> {{ $PaymentType }} </td>
                                <td>{{ $ChickBillDate }}</td>
                                <td> {{ $ChikPayment['attributes']['bank_number'] }}</td>
                                <td>{{ $ChikPayment['attributes']['Branch_number'] }}</td>
                                <td>{{ $ChikPayment['attributes']['account_number'] }}</td>
                                <td> {{ $ChikPayment['attributes']['Doubt_value'] }} </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">المجموع :</td>
                            <td>{{ $TransactionArray['equivelant_amount'] }}</td>
                        </tr>
                    </tbody>
                </table>
            @elseif($PaymentType == 'حصالة')
                <table dir="rtl" class="blueTable">
                    <thead>
                        <tr>
                            <th> تم الدفع من خلال :</th>
                            <th>تاريخ </th>
                            <th> المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> {{ $PaymentType }} {{ $TransactionArray['description'] }}</td>
                            <td>{{ $ChickBillDate }}</td>
                            <td> {{ $TransactionArray['equivelant_amount'] }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">المجموع :</td>
                            <td>{{ $TransactionArray['equivelant_amount'] }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>

        <!--Start Sector Name-->
        <div class="footer">
            <p>اسم القطاع :
                <span>
                    @if ($TransactionArray['sectors'] != null)
                        {{ $TransactionArray['sectors']['text'] }}
                    @else
                        مخرجات عامة
                    @endif
                </span>
            </p>
            <p dir="rtl">مشروع : <span>{{ $TransactionArray['project']['project_name'] }}</span></p>
            @if ($TransactionArray['payment_reason'] != null)
                <p dir="rtl">سبب التبرع : <span>{{ $TransactionArray['payment_reason'] }}</span></p>
            @endif
            @if ($TransactionArray['description'] != null)
                <p dir="rtl">ملاحظات : <span>{{ $TransactionArray['description'] }}</span></p>
            @endif
        </div>

        <!-- Images at the Bottom -->
        <div class="images">
            <img src="{{ asset('assets/image/-dc.png') }}" alt="logo">
            <img src="{{ asset('assets/image/-removebg-preview.png') }}" alt="ttab">
        </div>
    </div>
</body>

</html>
