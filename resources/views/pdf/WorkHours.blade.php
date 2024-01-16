<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    <title>تقرير ساعات العمل</title>
    <style>
        table.blueTable {
            border: 2px solid white;
            background-color: #f1fff1;
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }

        table.blueTable td,
        table.blueTable th {
            border: 3px solid white;
            padding: 3px 2px;
        }

        table.blueTable tbody td {
            font-size: 13px;
            font-weight: bold;
            color: black;
            padding: 8px 0;
            margin: 12px;
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
    @endphp
    <div dir="rtl">
        <p style="font-size: 18px; font-weight: bold; text-decoration: underline;">تقرير ساعات العمل لشهر:
            <span>1</span>
        </p>
        <div dir="rtl" style="align-items: right;">
            <p style="font-size: 16px; font-weight: bold;color:#101426">اسم الموظف : <span
                    style="font-size: 16px;">{{ $user }}</span></p>
            <p style="font-size: 16px; font-weight: bold;color:#101426">عدد الساعات الشهرية :
                <span style="font-size: 16px;">100</span>
            </p>
        </div>

        <table dir="rtl" class="blueTable">
            <thead>
                <tr>
                    <th> التاريخ</th>
                    <th> اليوم</th>
                    <th> ساعة البداية</th>
                    <th> ساعة النهاية </th>
                    <th>عدد الساعات</th>
                    <th>المهام اليومية</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $day)
                    @php
                        $carbonDate = \Carbon\Carbon::parse($day['date']);
                    @endphp
                    <tr style="{{ $day['table'] === 'vacations' ? 'background-color: #ff3333;' : '' }}">
                        @unless ($day['table'] === 'vacations')
                            <td>{{ $carbonDate->toDateString() }}</td>
                            <td>{{ $day['day'] }}</td>
                        @else
                            <td style="color:white;">{{ $carbonDate->toDateString() }}</td>
                            <td style="color:white;">{{ $day['day'] }}</td>
                        @endunless
            
                        @unless ($day['table'] === 'vacations')
                            <td>{{ $day['start_time'] }}</td>
                            <td>{{ $day['end_time'] }}</td>
                        @else
                            <td style="color:white;"> - </td>
                            <td style="color:white;"> - </td>
                        @endunless
            
                        @unless ($day['table'] === 'vacations')
                            <td>{{ $day['day_hours'] }}</td>
                        @else
                            <td style="color:white;"> - </td>
                        @endunless
            
                        @unless ($day['table'] === 'vacations')
                            <td>-</td>
                        @else
                            <td style="color:white;">{{ $day['type'] }}</td>
                        @endunless
                    </tr>
                @endforeach
            </tbody>
            </table>
            
            <div dir="rtl" style="align-items: right;padding-top:24px;">
                <p style="font-size: 16px; font-weight: bold;color:#101426">عدد ايام الاجازات: <span
                        style="font-size: 16px;">10</span></p>
                        <p style="font-size: 16px; font-weight: bold;color:#101426">عدد ايام الاجازات المرضية: <span
                            style="font-size: 16px;">10</span></p>
            </div>

        </div>
    </body>

    </html>

