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
                    <img src="{{ asset('assets/image/QawafelLogo.png') }}" alt="Logo" style="width: 100px; height: auto;">
                </a>
            </div>
            <div style="border: 2px solid #e9ecef; border-radius: 10px; background-color: white; padding: 46px 24px; text-align: center;">
                <h1 style="font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px; margin: 0;">
                  .  شكرًا  على معاملتك مع جمعية الاقصي<br>

                <div style="padding: 12px 0;">
                    <a style=" font-size: 16px; font-weight: 700; color: #ffffff; text-decoration: none; background-color: #16803c; border-radius: 6px; padding: 10px 20px; display: inline-block; min-width:100px"
                    href="{{ config('app.url') . '/generate-pdf/' . $Transaction['id'] }}">
                    تحميل الفاتورة
                    </a>
                </div>
            </div>
        </div>
    </body>
    </html>
