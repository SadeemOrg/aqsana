<!-- This example requires Tailwind CSS v2.0+ -->
<style>
    .hiddenModal {
        display: none;
    }
</style>
@php
$id=1;
@endphp

<div dir="rtl" class="PrivecySettingModal relative hiddenModal  z-10" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed z-10 inset-0 sm:top-14 overflow-y-scroll">
        <div
            class="flex items-start sm:items-center justify-center max-w mt-20 sm:mt-4 xl:mt-0 min-h-full p-4 sm:p-0 text-right">
            <div
                class="relative ModalContainer bg-white rounded-lg px-4 pt-5 pb-4  shadow-xl transform transition-all sm:my-8 overflow-y-visible sm:p-6">
                <div class="flex flex-row items-center justify-between pb-4">
                    <!--header cancellationPolicy -->
                    <h4 class="text-xl leading-6 font-medium text-[#349A37] tab tab-1" id="modal-title">سياسة الإلغاء
                    </h4>
                    <!--header PrivecyPolicy -->
                    <h4 class="text-2xl leading-6 font-normal text-[#349A37] tab tab-2" id="modal-title">سياسة الخصوصية
                    </h4>
                    <button type="button"
                        class="bg-white showModal mr-4 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">Close</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col items-start justify-start tab tab-1 font-Flatnormal max-w-md sm:max-w-xl">
                    <P class="pt-2  text-xs sm:text-base">
                        1. يحق للشخص الذي يقوم بالتبرع التواصل مع الجمعية لطلب تغيير تفاصيل الدفع وإلغاء المعاملة.</br>
                        2. يمكن الغاء المعاملة خلال 30 يوم من يوم التبرع عبر الانترنت او عبر الهاتف وفقا لقانون لدفه
                        المستهلك 1981</br>
                        3. تقوم الجمعية بإجراء التغيير المطلوب وفقا للسياسة المتبعة في شرك الائتمان.</br>
                        4. في حالة كانت شركة الائتمان تتقاضى عمولة من الجمعية عن التبرع، فسيتم تحصيل العمولة من المتبرع
                        كما ذكر</br>
                        5. سوف تقوم الجمعية بإلغاء او تغيير مبلغ التبرع بناء على طلب المتبرع.</br>
                    </P>
                    <!--Cancellation Policy -->
                    <h4 class="text-2xl mt-6 leading-6 font-medium text-[#349A37] tab tab-1" id="modal-title">מדיניות ביטולים
                    </h4>
                    <P class="pt-2 tab tab-1 text-sm sm:text-lg font-medium">
                        1. מבצעת הפעולה תהיה רשאית לפנות לעמותה בבקשה לשינוי פרטי החיוב וביטול עסקה </br>
                        2. ניתן לבטל עסקה בתוך 30 יום מיום שבוצעה פעולת התרומה באינטרנט או בטלפון ע“פ חוק הגנת הצרכן
                        1981</br>
                        3. העמותה תבצע את השינוי הנדרש בהתאם למדיניות הנהוגה באותה עת בחברת האשראי</br>
                        4. במידה וחברת האשראי תחייב את העמותה בעמלה בגין הפעולה, תחויב מבצעת הפעולה בעמלה כאמור</br>
                        5. העמותה תבצע ביטול או שינוי סכום תרומה על פי בקשת התורמת </br>
                    </P>
                </div>
                <!---Privacy Policy -->
                <div class=" flex flex-col items-start justify-start tab font-Flatnormal tab-2 max-w-md md:max-w-2xl">
                    <p class="font-FlatBold pb-2">
                        نشكرك على رغبتك في التبرع للجمعية، ستستخدم مساهمتك لتعزيز الحق في الخصوصية، وستستخدم لتحقيق رؤية
                        الجمعية.
                        يشكل التبرع وافقة للشروط الاتية:</br>
                    </p>
                    <P class="pt-1 text-xs sm:text-base">
                        1. يجوز لجمعية الأقصى استخدام أموال التبرع لصالح قضيتها ووفقا لتقديرها.</br>
                        2. انت تقر بانك مؤهل لاتخاذ اجراءات قانونية ملزمة. ومع ذلك، إذا كان عمرك اقل من 18 عاما او غير
                        صالح او غير كفء لأداء الإجراءات القانونية لأي سبب من الأسباب دون اذن الوصي، يبدو تبرعك وكأنه قد
                        حصلت على موافقة الوصي.</br>
                        3. تتعهد جمعية الأقصى بعدم نقل معلوماتك الشخصية الى أي طرف، باستثناء عن مزودي الخدمة المشاركين
                        في المقاصة في موقعنا (חברת טרנזילה וחברת ישראכרט).</br>
                        4. بالإضافة الى ذلك، جمعية الأقصى تقبل تبرعك لمرة واحدة عن طريق التحويل البنكي دون الحاجة
                        للتسجيل او تقديم التفاصيل الشخصية على الموقع.</br>
                        5. أي تبرع يتجاوز 20000 شيكل (اعتبارا من يوم كتابة الوثيقة) سيتم ابلاغ السلطات المخولة بتفاصيل،
                        إذا كانت لا توافق على ذلك،
                        <a class="text-[#349A37] text-lg underline" href="/contact-us">فاتصل بنا </a>
                        قبل تحويل التبرع. وستقوم جمعية الأقصى بالإبلاغ عن التبرعات
                        الى السلطات المخولة ووفقا لأحكام القانون حيث ستكون سارية المفعول اعتبارا من هذه المرحلة، لا يتم
                        الاعتراف بالتبرعات المقدمة الى جمعية الأقصى لأغراض ضريبية بموجب المادة 46 من قانون ضريبة
                        الدخل.</br>
                        6. تحتفظ جمعية الأقصى بالحق في رفض تلقي التبرعات او الغاء استمرار التبرعات الحالية من أي جهة وهو
                        حسب تقديرها.</br>
                    </P>
                    <h4 class="text-3xl mt-6 leading-6  text-[#349A37] tab tab-2" id="modal-title">מדיניות פרטיות
                    </h4>
                    <p class="font-extrabold sm:text-base text-xl pt-2 pb-2">
                        אנחנו מודים לך על רצונך לתרום לעמותה. תרומתך תשמש לקידום הזכות לפרטיות, ותשמש להגשמת החזון של
                        העמותה.
                        מתן תרומה מהווה הסכמה לתנאים להלן:</br>
                    </p>
                    <P class="pt-4 font-Flatnormal text-sm sm:text-lg tab tab-2">

                        1. עמותת אלאקסא רשאית להשתמש בכספי התרומה, לטובת עילותה ולפי שיקול דעתה. </br>
                        2. את או אתה מצהיר/ה כי הנך כשיר לבצע פעולות משפטיות מחייבות. אולם, במידה והנך מתחת לגיל 18 או
                        פסול/ת דין או לא כשיר/ה לבצע פעולות משפטיות מכל סיבה שהיא ללא אישור אפוטרופוס, יראו את תרומתך
                        כאילו
                        קיבלה את אישור האפוטרופוס.</br>
                        3. עמותת אלאקסא מתחייבת לא להעביר את פרטיכם האישיים לאף גורם, מלבד ספקי השירות שמעורבים בסליקה
                        באתרנו (חברת טרנזילה וחברת ישראכרט).</br>
                        4. בנוסף, עמותת אלאקסא מקבלת גם תרומות חד פעמיות באמצעות העברה בנקאית, ללא צורך בהרשמה או מסירת
                        פרטים אישיים באתר.</br>
                        5. תרומה העולה על 20,000 ש״ח (נכון למועד כתיבת המדיניות) תדווח לרשויות המוסמכות עם פרטיך. אם
                        אינך
                        מסכימ/ה לכך,
                        <a class="text-green-900 text-2xl underline" href="/contact-us">צרו עמנו קשר </a>
                        לפני העברת התרומה. עמותת אלאקסא תדווח על התרומות לרשויות המוסמכות, בהתאם
                        להוראות הדין כפי שיהיו בתוקף מעת לעת. בשלב זה, התרומות לעמותת אלאקסא אינן מוכרות לצרכי מס על פי
                        סעיף
                        46 לפקודת מס הכנסה.</br>
                        6. עמותת אלאקסא שומרת את הזכות לדחות קבלת תרומות או לבטל המשך תרומות קיימות מכל גורם שהוא, לפי
                        שיקול
                        דעתה.</br>
                    </P>
                </div>
            </div>

        </div>
    </div>
</div>
