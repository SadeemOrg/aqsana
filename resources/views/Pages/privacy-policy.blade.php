@extends('layout.app', ['hasHeader' => true, 'hasFooter' => true, 'left_SideBar' => false])
@section('content')
<div class="bg-gray-100 min-h-screen p-6">
    <div class="container mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold mb-4">سياسة الخصوصية</h1>
            <p class="text-gray-700 mb-4">
                مرحبًا بك في تطبيق جمعية الأقصى ("التطبيق"). تم تصميم هذه سياسة الخصوصية لمساعدتك على فهم كيفية جمعنا واستخدامنا وحماية معلوماتك الشخصية عند التسجيل واستخدامك لتطبيقنا.
            </p>
            <h2 class="text-xl font-semibold mb-2">1. المعلومات التي نجمعها</h2>
            <p class="text-gray-700 mb-4">
                عند التسجيل في تطبيق جمعية الأقصى، قد نقوم بجمع المعلومات التالية:
                <ul class="list-disc pl-6">
                    <li>اسمك وتفاصيل الاتصال الخاصة بك، بما في ذلك البريد الإلكتروني ورقم الهاتف.</li>
                    <li>معلومات أخرى قد تقدمها خلال عملية التسجيل.</li>
                </ul>
            </p>
            
            <h2 class="text-xl font-semibold mb-2">2. كيفية استخدام المعلومات</h2>
            <p class="text-gray-700 mb-4">
                نستخدم المعلومات التي نجمعها لأغراض محددة تشمل ما يلي:
                <ul class="list-disc pl-6">
                    <li>تزويدك بالمحتوى والخدمات المقدمة من جمعية الأقصى والتطبيق.</li>
                    <li>إرسال تنبيهات وإشعارات عن أحداث وأنشطة جمعية الأقصى والتحديثات ذات الصلة.</li>
                    <li>تحسين وتطوير خدماتنا وتجربة المستخدم.</li>
                </ul>
            </p>
            
            <h2 class="text-xl font-semibold mb-2">3. مشاركة المعلومات</h2>
            <p class="text-gray-700 mb-4">
                لا نقوم بمشاركة معلوماتك الشخصية مع أي أطراف خارجية دون موافقتك الصريحة، باستثناء الحالات التي تشمل الالتزامات القانونية.
            </p>

            <h2 class="text-xl font-semibold mb-2">4. حماية المعلومات</h2>
            <p class="text-gray-700 mb-4">
                نحن نتخذ تدابير أمان معقولة لحماية معلوماتك الشخصية من الوصول غير المصرح به والاستخدام أو الإفصاح غير المصرح به.
            </p>

            <h2 class="text-xl font-semibold mb-2">5. تحديثات سياسة الخصوصية</h2>
            <p class="text-gray-700 mb-4">
                نحتفظ بحق تحديث أو تعديل سياسة الخصوصية من وقت لآخر. سيتم نشر التغييرات على هذه الصفحة.
            </p>

            <p class="text-gray-700">
                لمزيد من المعلومات أو للإبلاغ عن أية مخاوف أمان أو لطرح أسئلة إضافية حول سياسة الخصوصية، يرجى <a href="contact-us" class="text-blue-500">الاتصال بنا</a>.
            </p>
        </div>
    </div>
</div>
@endsection