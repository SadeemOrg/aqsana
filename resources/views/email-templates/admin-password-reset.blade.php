<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Password Reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="width: 100% !important; height: 100% !important; padding: 0 !important; margin: 0 !important; background-color: #f3f4f6; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;">
    <div style="display: none; font-size: 1px; color: #e9ecef; line-height: 1px; max-height: 0; max-width: 0; opacity: 0; overflow: hidden;">
        A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
    </div>
    <div style="max-width: 600px; margin: 0 auto; padding: 24px; border-top: 3px solid #d4dadf;">
        <div style="text-align: center; padding: 36px 0;">
            <a href="https://aqsana.org" target="_blank">
                <img src="{{ asset('assets/image/QawafelLogo.png') }}" alt="Logo" style="width: 100px; height: auto;">
            </a>
        </div>
        <div style="border: 2px solid #e9ecef; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 46px 24px; border-radius: 10px; background-color: white;">
            <h1 style="font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px; margin: 0;">إعادة تعيين كلمة المرور</h1>
            <div style="text-align: center; padding: 12px 0;">
                <a href="https://aqsana.org/app/password/reset/{{ $token }}" target="_blank" style="font-size: 16px; font-weight: 700; color: #ffffff; text-decoration: none; background-color: #1a82e2; border-radius: 6px; padding: 10px 20px; display: inline-block;">إعادة تعيين كلمة المرور</a>
            </div>
            <p style="font-size: 16px; line-height: 24px; margin: 8px 0;">إذا لم تطلب إعادة تعيين كلمة المرور، يمكنك تجاهل هذا البريد الإلكتروني بأمان.</p>
            <p style="font-size: 16px; line-height: 24px; margin: 8px 0;">إذا لم يعمل الزر، انسخ الرابط التالي والصقه في متصفحك:</p>
            <p style="font-size: 16px; line-height: 24px; margin: 8px 0;"><a href="https://aqsana.org/app/password/reset/{{ $token }}" target="_blank">https://aqsana.org/app/password/reset/{{ $token }}</a></p>
        </div>
    </div>
</body>
</html>
