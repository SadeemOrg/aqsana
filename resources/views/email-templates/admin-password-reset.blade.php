<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Password Reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 400;
                src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 700;
                src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
        }
        body, a {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        img {
            -ms-interpolation-mode: bicubic;
        }
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }
        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            background-color: white;
            font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 24px;
            border-top: 3px solid #d4dadf;
        }
        .logo {
            text-align: center;
            padding: 36px 0;

        }
        .logo img {
            width: 100px;
            height: auto;
        }
        .content h1 {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -1px;
            line-height: 48px;
            margin: 0;
        }
        .content p {
            font-size: 16px;
            line-height: 24px;
            margin: 8px 0;
            /* border: 2px solid #e9ecef; */
        }
        .button-container {
            text-align: center;
            padding: 12px 0;
        }
        .button {
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
            text-decoration: none;
            background-color: #1a82e2;
            border-radius: 6px;
            padding: 10px 20px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="logo">
            <a href="https://aqsana.org" target="_blank">
                <img src="{{ asset('assets/image/QawafelLogo.png') }}" alt="Logo">
            </a>
        </div>
        <div class="content" style="border: 2px solid #e9ecef;display: flex; flex-direction: column; align-items: center;justify-content: center; padding: 46px 0px; border-radius: 10px;background-color: white">
            <h1>إعادة تعيين كلمة المرور</h1>
            <div class="button-container">
                <a href="https://aqsana.org/app/password/reset/{{ $token }}" target="_blank" class="button">إعادة تعيين كلمة المرور</a>
            </div>
            <p>إذا لم تطلب إعادة تعيين كلمة المرور، يمكنك تجاهل هذا البريد الإلكتروني بأمان</p>
            <p>إذا لم يعمل الزر، انسخ الرابط التالي والصقه في متصفحك</p>
            <p><a href="https://aqsana.org/app/password/reset/{{ $token }}" target="_blank">https://aqsana.org/app/password/reset/{{ $token }}</a></p>
        </div>
    </div>
</body>
</html>
