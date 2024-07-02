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
        <img style="height: 220px; "
            src="{{ asset('/assets/image/iuktui.png') }}"
            alt="alaqsa Logo">
    </div>
    <!--End Top Image -->

    <!--First Paragraph-->
    <div style="align-items: left; padding-top: 70px;">
        <p style="font-size: 16px;color:#101426">Association Id : <span
                style="color: #6B7280;font-size: 16px;">{{ $society_id }}</span></p>
        <p style="font-size: 16px;color:#101426">title : <span
                style="color: #6B7280;font-size: 16px;">{{ $address }}</span></p>
        <p style="font-size: 16px;color:#101426">Telephone: <span
                style="color: #6B7280;font-size: 16px;">{{ $phone }}</span></p>
        <p style="font-size: 16px;color:#101426">Email : <span
                style="color: #6B7280;font-size: 16px;">{{ $email }}</span></p>
    </div>
    <!--End First Paragraph-->

    <!--Start Second Paragraph-->
    <div style="text-align: center">
        <p style="font-size: 16px;color:#101426">{{ $ChickBillDate }}</p>
        <p style="font-size:16px; color:#101426 ">receipt voucher number
            <span>
                F-{{ $TransactionArray['bill_number'] }}
            </span>
        </p>
        <p style="font-size:16px; color:#101426; ">copy of orginal Bill</p>
    </div>
    <!--End Second Paragraph-->

    <!--Start for Account Paragraph-->
    <p style="text-align: left;font-size: 16px;color:#101426">account owner :
        <span style="color: #6B7280;font-size: 16px;">
            @if ($TransactionArray['Payment_type'] == 5)
                moneybox :

                                {{ $TransactionArray['description'] }}
            @else
                {{ $TransactionArray['telephone_directory']['name'] }}
            @endif
        </span>
    </p>
    <!--End for Account Paragraph-->

    <!--Start Table -->

    @if ($PaymentType == 'Bank transfer')
        <table class="blueTable">
            <thead>
                <tr>
                    <th>Pay way</th>
                    <th>date</th>
                    <th>Bank</th>
                    <th>Branch</th>
                    <th>Account Id</th>
                    <th>total</th>
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
                        total :</td>
                    <td class=""></td>
                    <td class="">
                        {{ $TransactionArray['transact_amount'] }} </td>
                </tr>
            </tbody>
            </tr>
        </table>
    @elseif($PaymentType == 'cash')
        <table class="blueTable">
            <thead>
                <tr>
                    <th>Pay way</th>
                    <th>date</th>
                    <th>total</th>
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
                        total :</td>
                    <td class="">
                        {{ $TransactionArray['transact_amount'] }} </td>
                </tr>
            </tbody>
            </tr>
        </table>
    @elseif($PaymentType == 'bit')
        <table class="blueTable">
            <thead>
                <tr>
                    <th>Pay way</th>
                    <th>date</th>
                    <th>telephone Number</th>
                    <th>total</th>
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
                        total :</td>
                    <td class=""></td>
                    <td class="">
                        {{ $TransactionArray['equivelant_amount'] }} </td>
                </tr>
            </tbody>
            </tr>
        </table>
    @elseif($PaymentType == 'Bank doubt')
        <table class="blueTable">
            <thead>
                <tr>
                    <th>Pay way</th>
                    <th>date doubt</th>
                    <th>Bank number</th>
                    <th>Branch number</th>
                    <th>doubt Id</th>
                    <th>total</th>
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
                        total :</td>
                    <td class=""></td>
                    <td class="">
                        {{ $TransactionArray['equivelant_amount'] }} </td>
                </tr>
            </tbody>
            </tr>
        </table>
    @elseif($PaymentType == 'moneybox')
        <table class="blueTable">
            <thead>
                <tr>
                    <th> Pay way:</th>
                    <th>date </th>
                    <th> total</th>

                </tr>
            </thead>
            <tbody>

                @php
                    // $ChickBillDate = date('d/m/Y', strtotime($ChikPayment['attributes']['Date']));
                @endphp
                <tr>
                    <td> {{ $PaymentType }} : {{ $TransactionArray['alhisalat']['number_alhisala'] }} </td>
                    <td>{{ $ChickBillDate }}</td>
                    <td> {{ $TransactionArray['equivelant_amount'] }}</td>
                </tr>
                <tr>
                    <td class="">
                        total :</td>
                    <td class=""></td>
                    <td class="">
                        {{ $TransactionArray['equivelant_amount'] }} </td>
                </tr>
            </tbody>

        </table>
    @endif
    <!--End Table -->

    <!--Start Sector Name-->
    <div style="width:full;">
        <p style="font-size: 17px;"> sector Name :
            @if ($TransactionArray['sectors'] != null)
                <span style="color: #6B7280;font-size: 16px;">{{ $TransactionArray['sectors']['text'] }}</span>
            @else
                <span style="color: #6B7280;font-size: 16px;">مخرجات عامة</span>
            @endif
        </p>
        <p dir="ltr" style="font-size: 17px;text-align: left"> project :
            <span style="color: #6B7280;font-size: 16px;">{{  $TransactionArray['project']['project_name'] }}</span>
        </p>
        <p dir="ltr" style="font-size: 17px;text-align: left"> payment reason :
            <span style="color: #6B7280;font-size: 16px;">{{ $TransactionArray['project']['payment_reason'] }}</span>
        </p>
        @if ($TransactionArray['description'] != null)
        <p dir="ltr" style="font-size: 17px;text-align: left"> notes :
            <span style="color: #6B7280;font-size: 16px;">{{ $TransactionArray['description'] }}</span>
        </p>
    @endif
    </div>
    <div style="position: relative; max-height: 160px; margin-left: 20%; ">
        <img style="height:290px;" src="{{ asset('assets/image/-dc.png') }}" alt="logo">
    </div>
    <div style="position: absolute; height: 150px; bottom: 13%; left: 37%;">
        <img src="{{ asset('assets/image/-removebg-preview.png') }}" alt="ttab">
    </div>
    <!--End Sector Name-->

</body>

</html>
