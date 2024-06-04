<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Password Reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /* Inline CSS styles */
        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            background-color: #f3f4f6;
            font-family: Arial, Helvetica, sans-serif;
        }
        /* Add more inline styles as needed */
    </style>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; border-top: 3px solid #d4dadf;">
        <div style="text-align: center; padding: 36px 0;">
            <a href="https://aqsana.org" target="_blank">
                <img src="https://example.com/assets/image/QawafelLogo.png" alt="Logo" style="width: 100px; height: auto;">
            </a>
        </div>
        <div style="border: 2px solid #e9ecef; border-radius: 10px; background-color: white; padding: 46px 24px; text-align: center;">
            <h1 style="font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px; margin: 0;">إعادة تعيين كلمة المرور</h1>
            <div style="padding: 12px 0;">
                <a href="https://aqsana.org/app/password/reset/{{ $token }}" target="_blank" style="font-size: 16px; font-weight: 700; color: #ffffff; text-decoration: none; background-color: #1a82e2; border-radius: 6px; padding: 10px 20px; display: inline-block;">إعادة تعيين كلمة المرور</a>
            </div>
            <p style="font-size: 16px; line-height: 24px; margin: 8px 0;">إذا لم تطلب إعادة تعيين كلمة المرور، يمكنك تجاهل هذا البريد الإلكتروني بأمان.</p>
            <p style="font-size: 16px; line-height: 24px; margin: 8px 0;">إذا لم يعمل الزر، انسخ الرابط التالي والصقه في متصفحك:</p>
            <p style="font-size: 16px; line-height: 24px; margin: 8px 0;"><a href="https://aqsana.org/app/password/reset/{{ $token }}" target="_blank">https://aqsana.org/app/password/reset/{{ $token }}</a></p>
        </div>
    </div>
</body>
</html>
