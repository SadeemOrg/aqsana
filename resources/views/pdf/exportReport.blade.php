<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>المعرف</th>
            <th>رقم الفاتوره</th>
            <th>تاريخ السند</th>
            <th>تاريخ الدفعة</th>
            <th>نوع السند</th>
            <th>الاسم</th>
            <th>القيمة</th>
            <th>طريقة الدفع</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $data as $selectedTransaction )
        <tr>
            <td>{{ $selectedTransaction['id'] }}</td>
            <td>{{ $selectedTransaction['bill'] }}</td>
            <td>{{ $selectedTransaction['date'] }}</td>
            <td>{{ $selectedTransaction['date'] }}</td>
            <td>{{ $selectedTransaction['type'] }}</td>
            <td>{{ $selectedTransaction['name'] }}</td>
            <td>{{ $selectedTransaction['transact_amount'] }}</td>
            <td>{{ $selectedTransaction['paymentTypeValue'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
