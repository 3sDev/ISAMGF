// when Municipality dropdown changes
$('#gov').change(function() {
    var gov = $(this).val();
    var municipality = $("#municipality").val();

    $.ajax({
        type: "GET",
        success: function(res) {

            if (gov == 'تونس') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="قرطاج">' +
                    'قرطاج</option>');
                $("#municipality").append('<option value="المدينة">' +
                    'المدينة</option>');
                $("#municipality").append('<option value="باب البحر">' +
                    'باب البحر</option>');
                $("#municipality").append('<option value="باب سويقة">' +
                    'باب سويقة</option>');
                $("#municipality").append('<option value="العمران">' +
                    'العمران</option>');
                $("#municipality").append('<option value="العمران الأعلى">' +
                    'العمران الأعلى</option>');
                $("#municipality").append('<option value="التحرير">' +
                    'التحرير</option>');
                $("#municipality").append('<option value="المنزه">' +
                    'المنزه</option>');
                $("#municipality").append('<option value="حي الخضراء">' +
                    'حي الخضراء</option>');
                $("#municipality").append('<option value="باردو">' +
                    'باردو</option>');
                $("#municipality").append('<option value="السيجومي">' +
                    'السيجومي</option>');
                $("#municipality").append('<option value="الزهور">' +
                    'الزهور</option>');
                $("#municipality").append('<option value="الحرائرية">' +
                    'الحرائرية</option>');
                $("#municipality").append('<option value="سيدي حسين">' +
                    'سيدي حسين</option>');
                $("#municipality").append('<option value="الوردية">' +
                    'الوردية</option>');
                $("#municipality").append('<option value="الكبارية">' +
                    'الكبارية</option>');
                $("#municipality").append('<option value="سيدي البشير">' +
                    'سيدي البشير</option>');
                $("#municipality").append('<option value="جبل الجلود">' +
                    'جبل الجلود</option>');
                $("#municipality").append('<option value="حلق الوادي">' +
                    'حلق الوادي</option>');
                $("#municipality").append('<option value="الكرم">' +
                    'الكرم</option>');
                $("#municipality").append('<option value="المرسى">' +
                    'المرسى</option>');

            } else if (gov == 'أريانة') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="أريانة المدينة">' +
                    'أريانة المدينة</option>');
                $("#municipality").append('<option value="سكرة">' +
                    'سكرة</option>');
                $("#municipality").append('<option value="رواد">' +
                    'رواد</option>');
                $("#municipality").append('<option value="قلعة الأندلس">' +
                    'قلعة الأندلس</option>');
                $("#municipality").append('<option value="سيدي ثابت">' +
                    'سيدي ثابت</option>');
                $("#municipality").append('<option value="حي التضامن">' +
                    'حي التضامن</option>');
                $("#municipality").append('<option value="المنيهلة">' +
                    'المنيهلة</option>');
            } else if (gov == 'منوبة') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="منوبة">' +
                    'منوبة</option>');
                $("#municipality").append('<option value="وادي الليل">' +
                    'وادي الليل</option>');
                $("#municipality").append('<option value="طبربة">' +
                    'طبربة</option>');
                $("#municipality").append('<option value="البطان">' +
                    'البطان</option>');
                $("#municipality").append('<option value="الجديدة">' +
                    'الجديدة</option>');
                $("#municipality").append('<option value="المرناقية">' +
                    'المرناقية</option>');
                $("#municipality").append('<option value="برج العامري">' +
                    'برج العامري</option>');
                $("#municipality").append('<option value="دوار هيشر">' +
                    'دوار هيشر</option>');
            } else if (gov == 'بن عروس') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="بن عروس">' +
                    'بن عروس</option>');
                $("#municipality").append('<option value="المدينة الجديدة">' +
                    'المدينة الجديدة</option>');
                $("#municipality").append('<option value="المروج">' +
                    'المروج</option>');
                $("#municipality").append('<option value="حمام الأنف">' +
                    'حمام الأنف</option>');
                $("#municipality").append('<option value="حمام الشط">' +
                    'حمام الشط</option>');
                $("#municipality").append('<option value="بومهل البساتين">' +
                    'بومهل البساتين</option>');
                $("#municipality").append('<option value="الزهراء">' +
                    'الزهراء</option>');
                $("#municipality").append('<option value="رادس">' +
                    'رادس</option>');
                $("#municipality").append('<option value="مقرين">' +
                    'مقرين</option>');
                $("#municipality").append('<option value="المحمدية">' +
                    'المحمدية</option>');
                $("#municipality").append('<option value="فوشانة">' +
                    'فوشانة</option>');
                $("#municipality").append('<option value="مرناق">' +
                    'مرناق</option>');
            } else if (gov == 'نابل') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="نابل">' +
                    'نابل</option>');
                $("#municipality").append('<option value="دار شعبان الفهري">' +
                    'دار شعبان الفهري</option>');
                $("#municipality").append('<option value="بني خيار">' +
                    'بني خيار</option>');
                $("#municipality").append('<option value="قربة">' +
                    'قربة</option>');
                $("#municipality").append('<option value="منزل تميم">' +
                    'منزل تميم</option>');
                $("#municipality").append('<option value="الميدة">' +
                    'الميدة</option>');
                $("#municipality").append('<option value="قليبية">' +
                    'قليبية</option>');
                $("#municipality").append('<option value="حمام الأغزاز">' +
                    'حمام الأغزاز</option>');
                $("#municipality").append('<option value="الهوارية">' +
                    'الهوارية</option>');
                $("#municipality").append('<option value="تاكلسة">' +
                    'تاكلسة</option>');
                $("#municipality").append('<option value="سليمان">' +
                    'سليمان</option>');
                $("#municipality").append('<option value="منزل بوزلفة">' +
                    'منزل بوزلفة</option>');
                $("#municipality").append('<option value="بني خلاد">' +
                    'بني خلاد</option>');
                $("#municipality").append('<option value="قرمبالية">' +
                    'قرمبالية</option>');
                $("#municipality").append('<option value="بوعرقوب">' +
                    'بوعرقوب</option>');
                $("#municipality").append('<option value="الحمامات">' +
                    'الحمامات</option>');
            } else if (gov == 'بنزرت') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="بنزرت الشمالية">' +
                    'بنزرت الشمالية</option>');
                $("#municipality").append('<option value="جرزونة">' +
                    'جرزونة</option>');
                $("#municipality").append('<option value="بنزرت الجنوبية">' +
                    'بنزرت الجنوبية</option>');
                $("#municipality").append('<option value="سجنان">' +
                    'سجنان</option>');
                $("#municipality").append('<option value="جومين">' +
                    'جومين</option>');
                $("#municipality").append('<option value="ماطر">' +
                    'ماطر</option>');
                $("#municipality").append('<option value="غزالة">' +
                    'غزالة</option>');
                $("#municipality").append('<option value="منزل بورقيبة">' +
                    'منزل بورقيبة</option>');
                $("#municipality").append('<option value="تينجة">' +
                    'تينجة</option>');
                $("#municipality").append('<option value="أوتيك">' +
                    'أوتيك</option>');
                $("#municipality").append('<option value="غار الملح">' +
                    'غار الملح</option>');
                $("#municipality").append('<option value="منزل جميل">' +
                    'منزل جميل</option>');
                $("#municipality").append('<option value="العالية">' +
                    'العالية</option>');
                $("#municipality").append('<option value="رأس الجبل">' +
                    'رأس الجبل</option>');
            } else if (gov == 'زغوان') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="زغوان">' +
                    'زغوان</option>');
                $("#municipality").append('<option value="الزريبة">' +
                    'الزريبة</option>');
                $("#municipality").append('<option value="بئر مشارقة">' +
                    'بئر مشارقة</option>');
                $("#municipality").append('<option value="الفحص">' +
                    'الفحص</option>');
                $("#municipality").append('<option value="الناظور">' +
                    'الناظور</option>');
                $("#municipality").append('<option value="صواف">' +
                    'صواف</option>');
            } else if (gov == 'سوسة') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="سوسة المدينة">' +
                    'سوسة المدينة</option>');
                $("#municipality").append('<option value="الزاوية القصيبة الثريات">' +
                    'الزاوية القصيبة الثريات</option>');
                $("#municipality").append('<option value="سوسة الرياض">' +
                    'سوسة الرياض</option>');
                $("#municipality").append('<option value="سوسة جوهرة">' +
                    'سوسة جوهرة</option>');
                $("#municipality").append('<option value="سوسة سيدي عبد الحميد">' +
                    'سوسة سيدي عبد الحميد</option>');
                $("#municipality").append('<option value="حمام سوسة">' +
                    'حمام سوسة</option>');
                $("#municipality").append('<option value="أكودة">' +
                    'أكودة</option>');
                $("#municipality").append('<option value="القلعة الكبرى">' +
                    'القلعة الكبرى</option>');
                $("#municipality").append('<option value="سيدي بوعلي">' +
                    'سيدي بوعلي</option>');
                $("#municipality").append('<option value="هرقلة">' +
                    'هرقلة</option>');
                $("#municipality").append('<option value="النفيضة">' +
                    'النفيضة</option>');
                $("#municipality").append('<option value="بوفيشة">' +
                    'بوفيشة</option>');
                $("#municipality").append('<option value="كندار">' +
                    'كندار</option>');
                $("#municipality").append('<option value="سيدي الهاني">' +
                    'سيدي الهاني</option>');
                $("#municipality").append('<option value="مساكن">' +
                    'مساكن</option>');
                $("#municipality").append('<option value="القلعة الصغرى">' +
                    'القلعة الصغرى</option>');
            } else if (gov == 'المنستير') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="المنستيـر">' +
                    'المنستيـر</option>');
                $("#municipality").append('<option value="الوردانيـن">' +
                    'الوردانيـن</option>');
                $("#municipality").append('<option value="الساحليـن">' +
                    'الساحليـن</option>');
                $("#municipality").append('<option value="زرمديـن">' +
                    'زرمديـن</option>');
                $("#municipality").append('<option value="بنـي حسان">' +
                    'بنـي حسان</option>');
                $("#municipality").append('<option value="جمـال">' +
                    'جمـال</option>');
                $("#municipality").append('<option value="بنبلة">' +
                    'بنبلة</option>');
                $("#municipality").append('<option value="المكنين">' +
                    'المكنين</option>');
                $("#municipality").append('<option value="البقالطة">' +
                    'البقالطة</option>');
                $("#municipality").append('<option value="طبلبة">' +
                    'طبلبة</option>');
                $("#municipality").append('<option value="قصر هلال">' +
                    'قصر هلال</option>');
                $("#municipality").append('<option value="قصيبة المديوني">' +
                    'قصيبة المديوني</option>');
                $("#municipality").append('<option value="صيادة لمطة بوحجر">' +
                    'صيادة لمطة بوحجر</option>');
            } else if (gov == 'المهدية') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="المهدية">' +
                    'المهدية</option>');
                $("#municipality").append('<option value="بومرداس">' +
                    'بومرداس</option>');
                $("#municipality").append('<option value="أولاد الشامخ">' +
                    'أولاد الشامخ</option>');
                $("#municipality").append('<option value="شربان">' +
                    'شربان</option>');
                $("#municipality").append('<option value="هبيرة">' +
                    'هبيرة</option>');
                $("#municipality").append('<option value="السواسي">' +
                    'السواسي</option>');
                $("#municipality").append('<option value="الجم">' +
                    'الجم</option>');
                $("#municipality").append('<option value="الشابة">' +
                    'الشابة</option>');
                $("#municipality").append('<option value="ملولش">' +
                    'ملولش</option>');
                $("#municipality").append('<option value="ملولش">' +
                    'ملولش</option>');
                $("#municipality").append('<option value="قصور الساف">' +
                    'قصور الساف</option>');
            } else if (gov == 'صفاقس') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="صفاقس المدينة">' +
                    'صفاقس المدينة</option>');
                $("#municipality").append('<option value="صفاقس الغربية">' +
                    'صفاقس الغربية</option>');
                $("#municipality").append('<option value="ساقية الزيت">' +
                    'ساقية الزيت</option>');
                $("#municipality").append('<option value="ساقية الداير">' +
                    'ساقية الداير</option>');
                $("#municipality").append('<option value="صفاقس الجنوبية">' +
                    'صفاقس الجنوبية</option>');
                $("#municipality").append('<option value="طينة">' +
                    'طينة</option>');
                $("#municipality").append('<option value="عقارب">' +
                    'عقارب</option>');
                $("#municipality").append('<option value="جبنيانة">' +
                    'جبنيانة</option>');
                $("#municipality").append('<option value="العامرة">' +
                    'العامرة</option>');
                $("#municipality").append('<option value="الحنشة">' +
                    'الحنشة</option>');
                $("#municipality").append('<option value="منزل شاكر">' +
                    'منزل شاكر</option>');
                $("#municipality").append('<option value="الغريبة">' +
                    'الغريبة</option>');
                $("#municipality").append('<option value="بئر علي بن خليفة">' +
                    'بئر علي بن خليفة</option>');
                $("#municipality").append('<option value="الصخيرة">' +
                    'الصخيرة</option>');
                $("#municipality").append('<option value="المحرس">' +
                    'المحرس</option>');
                $("#municipality").append('<option value="قـرقنـة">' +
                    'قـرقنـة</option>');
            } else if (gov == 'باجة') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="باجة الشمالية">' +
                    'باجة الشمالية</option>');
                $("#municipality").append('<option value="باجة الجنوبية">' +
                    'باجة الجنوبية</option>');
                $("#municipality").append('<option value="عمدون">' +
                    'عمدون</option>');
                $("#municipality").append('<option value="نفزة">' +
                    'نفزة</option>');
                $("#municipality").append('<option value="تبرسق">' +
                    'تبرسق</option>');
                $("#municipality").append('<option value="تيبار">' +
                    'تيبار</option>');
                $("#municipality").append('<option value="تستور">' +
                    'تستور</option>');
                $("#municipality").append('<option value="قبلاط">' +
                    'قبلاط</option>');
                $("#municipality").append('<option value="مجاز الباب">' +
                    'مجاز الباب</option>');
            } else if (gov == 'جندوبة') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="جنـدوبة">' +
                    'جنـدوبة</option>');
                $("#municipality").append('<option value="جنـدوبة الشمالية">' +
                    'جنـدوبة الشمالية</option>');
                $("#municipality").append('<option value="بوسالم">' +
                    'بوسالم</option>');
                $("#municipality").append('<option value="طبرقـة">' +
                    'طبرقـة</option>');
                $("#municipality").append('<option value="عين دراهم">' +
                    'عين دراهم</option>');
                $("#municipality").append('<option value="فرنانة">' +
                    'فرنانة</option>');
                $("#municipality").append('<option value="غار الدماء">' +
                    'غار الدماء</option>');
                $("#municipality").append('<option value="وادي مليز">' +
                    'وادي مليز</option>');
                $("#municipality").append('<option value="بلطة  بوعوان">' +
                    'بلطة  بوعوان</option>');
            } else if (gov == 'الكاف') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="الكاف الغربية">' +
                    'الكاف الغربية</option>');
                $("#municipality").append('<option value="الكاف الشرقية">' +
                    'الكاف الشرقية</option>');
                $("#municipality").append('<option value="نبـر">' +
                    'نبـر</option>');
                $("#municipality").append('<option value="الطويرف">' +
                    'الطويرف</option>');
                $("#municipality").append('<option value="ساقية سيدي يوسف">' +
                    'ساقية سيدي يوسف</option>');
                $("#municipality").append('<option value="تاجروين">' +
                    'تاجروين</option>');
                $("#municipality").append('<option value="قلعة سنان">' +
                    'قلعة سنان</option>');
                $("#municipality").append('<option value="القلعة الخصبة">' +
                    'القلعة الخصبة</option>');
                $("#municipality").append('<option value="الجريصة">' +
                    'الجريصة</option>');
                $("#municipality").append('<option value="القصور">' +
                    'القصور</option>');
                $("#municipality").append('<option value="الدهماني">' +
                    'الدهماني</option>');
                $("#municipality").append('<option value="السرس">' +
                    'السرس</option>');
            } else if (gov == 'سليانة') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="سليانة الشمالية">' +
                    'سليانة الشمالية</option>');
                $("#municipality").append('<option value="سليانة الجنوبية">' +
                    'سليانة الجنوبية</option>');
                $("#municipality").append('<option value="بوعرادة">' +
                    'بوعرادة</option>');
                $("#municipality").append('<option value="قعفور">' +
                    'قعفور</option>');
                $("#municipality").append('<option value="العروسة">' +
                    'العروسة</option>');
                $("#municipality").append('<option value="الكريب">' +
                    'الكريب</option>');
                $("#municipality").append('<option value="بورويس">' +
                    'بورويس</option>');
                $("#municipality").append('<option value="مكثر">' +
                    'مكثر</option>');
                $("#municipality").append('<option value="الروحية">' +
                    'الروحية</option>');
                $("#municipality").append('<option value="كسرى">' +
                    'كسرى</option>');
                $("#municipality").append('<option value="برقو">' +
                    'برقو</option>')
            } else if (gov == 'القيروان') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="القيروان الشمالية">' +
                    'القيروان الشمالية</option>');
                $("#municipality").append('<option value="القيروان الجنوبية">' +
                    'القيروان الجنوبية</option>');
                $("#municipality").append('<option value="الشبيكة">' +
                    'الشبيكة</option>');
                $("#municipality").append('<option value="السبيخة">' +
                    'السبيخة</option>');
                $("#municipality").append('<option value="الوسلاتية">' +
                    'الوسلاتية</option>');
                $("#municipality").append('<option value="حفوز">' +
                    'حفوز</option>');
                $("#municipality").append('<option value="العلا">' +
                    'العلا</option>');
                $("#municipality").append('<option value="حاجب العيون">' +
                    'حاجب العيون</option>');
                $("#municipality").append('<option value="نصر الله">' +
                    'نصر الله</option>');
                $("#municipality").append('<option value="الشراردة">' +
                    'الشراردة</option>');
                $("#municipality").append('<option value="بوحجلة">' +
                    'بوحجلة</option>');
                $("#municipality").append('<option value="عين جلولة">' +
                    'عين جلولة</option>');
                $("#municipality").append('<option value="منزل المهيري">' +
                    'منزل المهيري</option>');
            } else if (gov == 'سيدي بوزيد') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="سيدي بوزيد الغربية">' +
                    'سيدي بوزيد الغربية</option>');
                $("#municipality").append('<option value="سيدي بوزيد الشرقية">' +
                    'سيدي بوزيد الشرقية</option>');
                $("#municipality").append('<option value="جلمة">' +
                    'جلمة</option>');
                $("#municipality").append('<option value="سبالة أولاد عسكر">' +
                    'سبالة أولاد عسكر</option>');
                $("#municipality").append('<option value="بئر الحفي">' +
                    'بئر الحفي</option>');
                $("#municipality").append('<option value="سيدي علي بن عون">' +
                    'سيدي علي بن عون</option>');
                $("#municipality").append('<option value="منزل بوزيان">' +
                    'منزل بوزيان</option>');
                $("#municipality").append('<option value="المكناسي">' +
                    'المكناسي</option>');
                $("#municipality").append('<option value="سوق الجديد">' +
                    'سوق الجديد</option>');
                $("#municipality").append('<option value="المزونة">' +
                    'المزونة</option>');
                $("#municipality").append('<option value="الرقاب">' +
                    'الرقاب</option>');
                $("#municipality").append('<option value="السعيدة">' +
                    'السعيدة</option>');
                $("#municipality").append('<option value="أولاد حفوز">' +
                    'أولاد حفوز</option>');
            } else if (gov == 'القصرين') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="القصرين الشمالية">' +
                    'القصرين الشمالية</option>');
                $("#municipality").append('<option value="القصرين الجنوبية">' +
                    'القصرين الجنوبية</option>');
                $("#municipality").append('<option value="الزهور">' +
                    'الزهور</option>');
                $("#municipality").append('<option value="حاسي الفريد">' +
                    'حاسي الفريد</option>');
                $("#municipality").append('<option value="سبيطلة">' +
                    'سبيطلة</option>');
                $("#municipality").append('<option value="سبيبة">' +
                    'سبيبة</option>');
                $("#municipality").append('<option value="جدليان">' +
                    'جدليان</option>');
                $("#municipality").append('<option value="العيون">' +
                    'العيون</option>');
                $("#municipality").append('<option value="تالة">' +
                    'تالة</option>');
                $("#municipality").append('<option value="حيدرة">' +
                    'حيدرة</option>');
                $("#municipality").append('<option value="فوسانة">' +
                    'فوسانة</option>');
                $("#municipality").append('<option value="فريانة">' +
                    'فريانة</option>');
                $("#municipality").append('<option value="ماجل بلعباس">' +
                    'ماجل بلعباس</option>');
            } else if (gov == 'قابس') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="قابـس المدينة">' +
                    'قابـس المدينة</option>');
                $("#municipality").append('<option value="قابـس الغربية">' +
                    'قابـس الغربية</option>');
                $("#municipality").append('<option value="قابـس الجنوبية">' +
                    'قابـس الجنوبية</option>');
                $("#municipality").append('<option value="غنوش">' +
                    'غنوش</option>');
                $("#municipality").append('<option value="المطوية">' +
                    'المطوية</option>');
                $("#municipality").append('<option value="منزل الحبيب">' +
                    'منزل الحبيب</option>');
                $("#municipality").append('<option value="الحامة">' +
                    'الحامة</option>');
                $("#municipality").append('<option value="مطماطة">' +
                    'مطماطة</option>');
                $("#municipality").append('<option value="مطماطة الجديدة">' +
                    'مطماطة الجديدة</option>');
                $("#municipality").append('<option value="مارث">' +
                    'مارث</option>');
                $("#municipality").append('<option value="دخيلة توجان">' +
                    'دخيلة توجان</option>');
            } else if (gov == 'مدنين') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="مدنيـن الشمالية">' +
                    'مدنيـن الشمالية</option>');
                $("#municipality").append('<option value="مدنين الجنوبية">' +
                    'مدنين الجنوبية</option>');
                $("#municipality").append('<option value="بني خداش">' +
                    'بني خداش</option>');
                $("#municipality").append('<option value="بن قردان">' +
                    'بن قردان</option>');
                $("#municipality").append('<option value="جرجيس">' +
                    'جرجيس</option>');
                $("#municipality").append('<option value="جربة حومة السوق">' +
                    'جربة حومة السوق</option>');
                $("#municipality").append('<option value="جربة ميدون">' +
                    'جربة ميدون</option>');
                $("#municipality").append('<option value="جربة أجيم">' +
                    'جربة أجيم</option>');
                $("#municipality").append('<option value="سيدي مخلوف">' +
                    'سيدي مخلوف</option>');
            } else if (gov == 'قفصة') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="قفصة الشمالية">' +
                    'قفصة الشمالية</option>');
                $("#municipality").append('<option value="سيدي عيش">' +
                    'سيدي عيش</option>');
                $("#municipality").append('<option value="القصر">' +
                    'القصر</option>');
                $("#municipality").append('<option value="قفصة الجنوبية">' +
                    'قفصة الجنوبية</option>');
                $("#municipality").append('<option value="أم العرائس">' +
                    'أم العرائس</option>');
                $("#municipality").append('<option value="سيدي بوبكر">' +
                    'سيدي بوبكر</option>');
                $("#municipality").append('<option value="الرديف">' +
                    'الرديف</option>');
                $("#municipality").append('<option value="المتلوي">' +
                    'المتلوي</option>');
                $("#municipality").append('<option value="المظيلة">' +
                    'المظيلة</option>');
                $("#municipality").append('<option value="القطار">' +
                    'القطار</option>');
                $("#municipality").append('<option value="بلخير">' +
                    'بلخير</option>');
                $("#municipality").append('<option value="السند">' +
                    'السند</option>');
                $("#municipality").append('<option value="صانوش">' +
                    'صانوش</option>');
            } else if (gov == 'توزر') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="توزر">' +
                    'توزر</option>');
                $("#municipality").append('<option value="دقاش">' +
                    'دقاش</option>');
                $("#municipality").append('<option value="تمغزة">' +
                    'تمغزة</option>');
                $("#municipality").append('<option value="نفطة">' +
                    'نفطة</option>');
                $("#municipality").append('<option value="حزوة">' +
                    'حزوة</option>');
                $("#municipality").append('<option value="حامة الجريد">' +
                    'حامة الجريد</option>');
            } else if (gov == 'تطاوين') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="تطاوين الشمالية">' +
                    'تطاوين الشمالية</option>');
                $("#municipality").append('<option value="تطاوين الجنوبية">' +
                    'تطاوين الجنوبية</option>');
                $("#municipality").append('<option value="الصمار">' +
                    'الصمار</option>');
                $("#municipality").append('<option value="البئر الأحمر">' +
                    'البئر الأحمر</option>');
                $("#municipality").append('<option value="غمراسن">' +
                    'غمراسن</option>');
                $("#municipality").append('<option value="ذهيبة">' +
                    'ذهيبة</option>');
                $("#municipality").append('<option value="رمادة">' +
                    'رمادة</option>');
                $("#municipality").append('<option value="بني مهيرة">' +
                    'بني مهيرة</option>');
            } else if (gov == 'قبلي') {
                $("#municipality").empty();
                $("#municipality").append('<option value="" selected disabled> إختر المعتمدية</option>');
                $("#municipality").append('<option value="قبلي الجنوبية">' +
                    'قبلي الجنوبية</option>');
                $("#municipality").append('<option value="قبلي الشمالية">' +
                    'قبلي الشمالية</option>');
                $("#municipality").append('<option value="سوق الأحد">' +
                    'سوق الأحد</option>');
                $("#municipality").append('<option value="دوز الشمالية">' +
                    'دوز الشمالية</option>');
                $("#municipality").append('<option value="دوز الجنوبية">' +
                    'دوز الجنوبية</option>');
                $("#municipality").append('<option value="الفوار">' +
                    'الفوار</option>');
                $("#municipality").append('<option value="رجيم معتوق">' +
                    'رجيم معتوق</option>');
            } else {
                $("#municipality").empty();
            }
        }
    });

});