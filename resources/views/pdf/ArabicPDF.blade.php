<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    <style>
        table.blueTable {
            border: 1px solid white;
            background-color: #f1fff1;
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }

        table.blueTable td,
        table.blueTable th {
            border: 1px solid white;
            padding: 3px 2px;
        }

        table.blueTable tbody td {
            font-size: 13px;
            font-weight: bold;
            color: black;
            padding: 8px 0;
        }

        table.blueTable thead {
            background: #39A423;
            background: -moz-linear-gradient(top, #6abb5a 0%, #4cad39 66%, #39A423 100%);
            background: -webkit-linear-gradient(top, #6abb5a 0%, #4cad39 66%, #39A423 100%);
            background: linear-gradient(to bottom, #6abb5a 0%, #4cad39 66%, #39A423 100%);
            border-bottom: 0px solid #444444;
        }

        table.blueTable thead th {
            font-size: 15px;
            font-weight: bold;
            background: #39A423;
            color: white;
            text-align: center;
            border-left: 2px solid #D0E4F5;
        }

        table.blueTable thead th:first-child {
            border-left: none;
        }

        table.blueTable tfoot td {
            font-size: 14px;
        }

        table.blueTable tfoot .links {
            text-align: right;
        }

        table.blueTable tfoot .links a {
            display: inline-block;
            background: #1C6EA4;
            color: #FFFFFF;
            padding: 8px 8px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    @php
        $society_id = nova_get_setting('society_id', '580179794');
        $phone = nova_get_setting('phone', 'default_value');
        $email = nova_get_setting('email', 'default_value');
        $address = nova_get_setting('address', 'default_value');
        // $newaddress = explode(',', $address);
        $ChickBillDate = date('d/m/Y', strtotime($TransactionArray['transaction_date']));
        // dd($TelephoneDirectory);
    @endphp
    <!--Top Image -->
    <div style="position: absolute; top: -15px;">
        <img style="height: 220px; " src="{{ asset('/assets/image/iuktui.png') }}" alt="alaqsa Logo">
    </div>
    <!--End Top Image -->

    <!--First Paragraph-->
    <div dir="rtl" style="align-items: left; padding-top: 70px;">
        <p style="font-size: 17px;color:#101426; font-weight: 700">رقم الجمعية : <span
                style="color: #6B7280;font-size: 14px;font-weight: 200">{{ $society_id }}</span></p>
        <p style="font-size: 17px;color:#101426;font-weight: 700">العنوان : <span
                style="color: #6B7280;font-size: 16px;font-weight: 200">{{ $address }}</span></p>
        <p style="font-size: 17px;color:#101426;font-weight: 700">رقم التلفون: <span
                style="color: #6B7280;font-size: 16px;font-weight: 200">{{ $phone }}</span></p>
        <p style="font-size: 17px;color:#101426;font-weight: 700">الايميل : <span
                style="color: #6B7280;font-size: 16px;font-weight: 200">{{ $email }}</span></p>
    </div>
    <!--End First Paragraph-->

    <!--Start Second Paragraph-->
    <div style="text-align: center">
        <p style="font-size: 16px;color:#101426">{{ $ChickBillDate }}</p>
        <p style="font-size:16px; color:#101426 ">
            F-{{ $TransactionArray['bill_number'] }}
            <span>
                سند قبض رقم
            </span>
        </p>
        <p style="font-size:16px; color:#101426; ">نسخة عن الفاتورة الأصلية</p>
    </div>
    <!--End Second Paragraph-->

    <!--Start for Account Paragraph-->
    <p style="text-align: right;font-size: 16px;color:#101426">لحساب :
        <span style="color: #6B7280;font-size: 16px;">
            @if ($TransactionArray['Payment_type'] == 5)
                حصالة رقم:
                {{ $TransactionArray['description'] }}
            @else
                {{ $TransactionArray['telephone_directory']['name'] }}
            @endif
        </span>
    </p>
    <!--End for Account Paragraph-->

    <!--Start Table -->

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
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class="">
                        المجموع :</td>
                    <td class=""></td>
                    <td class="">
                        {{ $TransactionArray['equivelant_amount'] }} </td>
                </tr>
            </tbody>
            </tr>
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
                    <td class=""></td>
                    <td class="">
                        المجموع :</td>
                    <td class="">
                        {{ $TransactionArray['transact_amount'] }} </td>
                </tr>
            </tbody>
            </tr>
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
                    <td class=""></td>
                    <td class="">
                        المجموع :</td>
                    <td class=""></td>
                    <td class="">
                        {{ $TransactionArray['equivelant_amount'] }} </td>
                </tr>
            </tbody>
            </tr>
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
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class="">
                        المجموع :</td>
                    <td class=""></td>
                    <td class="">
                        {{ $TransactionArray['equivelant_amount'] }} </td>
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

                @php
                    // $ChickBillDate = date('d/m/Y', strtotime($ChikPayment['attributes']['Date']));
                @endphp
                <tr>
                    <td> {{ $PaymentType }} {{ $TransactionArray['description'] }}</td>

                    <td>{{ $ChickBillDate }}</td>
                    <td> {{ $TransactionArray['equivelant_amount'] }}</td>

                </tr>

                <tr>

                    <td class="">
                        المجموع :</td>
                    <td class=""></td>
                    <td class="">
                        {{ $TransactionArray['equivelant_amount'] }} </td>
                </tr>
            </tbody>

        </table>
    @endif
    <!--End Table -->

    <!--Start Sector Name-->
    <div style="width: 100%; position: relative;">
        <p style="font-size: 17px; text-align: right"> اسم القطاع :
            @if ($TransactionArray['sectors'] != null)
                <span style="color: #6B7280;font-size: 16px;">{{ $TransactionArray['sectors']['text'] }}</span>
            @else
                <span style="color: #6B7280;font-size: 16px;">مخرجات عامة</span>
            @endif
        </p>
        <p dir="rtl" style="font-size: 17px;text-align: right"> مشروع :
            <span style="color: #6B7280;font-size: 16px;">{{ $TransactionArray['project']['project_name'] }}</span>
        </p>
        @if ($TransactionArray['payment_reason'] != null)
            <p dir="rtl" style="font-size: 17px;text-align: right"> سبب التبرع :
                <span style="color: #6B7280;font-size: 16px;">{{ $TransactionArray['payment_reason'] }}</span>
            </p>
        @endif
        @if ($TransactionArray['description'] != null)
            <p dir="rtl" style="font-size: 17px;text-align: right"> ملاحظات :
                <span style="color: #6B7280;font-size: 16px;">{{ $TransactionArray['description'] }}</span>
            </p>
        @endif
        <div style="position: absolute; bottom: 13%; left:250px;">
            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative;">
                <img style="max-height: 160px;" src="{{ asset('assets/image/-dc.png') }}" alt="logo">
                <img style="height:120px; position:absolute;" src="{{ asset('assets/image/-removebg-preview.png') }}" alt="ttab">
            </div>
        </div>
   
    </div>


    <!--End Sector Name-->

</body>

</html>
