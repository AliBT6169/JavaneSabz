<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => ":attribute باید پذیرفته شده باشد.",
    'accepted_if' => 'هنگامی که :other، :value است باید با :attribute توافق کنید.',
    "active_url" => "آدرس :attribute معتبر نیست",
    "after" => ":attribute باید تاریخی بعد از :date باشد.",
    'after_or_equal' => ':attribute باید بعد از یا برابر تاریخ :date باشد.',
    "alpha" => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash" => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num" => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array" => ":attribute باید شامل آرایه باشد.",
    "before" => ":attribute باید تاریخی قبل از :date باشد.",
    'before_or_equal' => ':attribute باید قبل از یا برابر تاریخ :date باشد.',
    "between" => [
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file" => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string" => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array" => ":attribute باید بین :min و :max آیتم باشد.",
    ],
    "boolean" => "فیلد :attribute فقط میتواند صحیح و یا غلط باشد",
    "confirmed" => ":attribute با تاییدیه مطابقت ندارد.",
    "date" => ":attribute یک تاریخ معتبر نیست.",
    'date_equals' => ':attribute باید برابر تاریخ :date باشد.',
    "date_format" => ":attribute با الگوی :format مطاقبت ندارد.",
    'declined' => ':attribute باید پذیرفته نشود.',
    'declined_if' => 'هنگامی که :other، :value است باید با :attribute نپذیرید.',
    "different" => ":attribute و :other باید متفاوت باشند.",
    "digits" => ":attribute باید :digits رقم باشد.",
    "digits_between" => ":attribute باید بین :min و :max رقم باشد.",
    'dimensions' => 'dimensions مربوط به فیلد :attribute اشتباه است.',
    'distinct' => ':attribute مقدار تکراری دارد.',
    "email" => "فرمت :attribute معتبر نیست.",
    'ends_with' => ':attribute باید با این مقدار تمام شود: :values.',
    "exists" => ":attribute انتخاب شده، معتبر نیست.",
    'file' => 'فیلد :attribute باید فایل باشد.',
    "filled" => "فیلد :attribute الزامی است",
    'gt' => [
        'numeric' => ':attribute باید بیشتر از :value باشد.',
        'file' => ':attribute باید بیشتر از :value کیلوبایت باشد.',
        'string' => ':attribute باید بیشتر از :value کاراکتر باشد.',
        'array' => ':attribute باید بیشتر از :value ایتم باشد.',
    ],
    'gte' => [
        'numeric' => ':attribute باید بیشتر یا برابر :value باشد.',
        'file' => ':attribute باید بیشتر یا برابر :value کیلوبایت باشد.',
        'string' => ':attribute باید بیشتر یا برابر :value کاراکتر باشد.',
        'array' => ':attribute باید :value ایتم یا بیشتر را داشته باشد.',
    ],
    "image" => ":attribute باید تصویر باشد.",
    "in" => ":attribute انتخاب شده، معتبر نیست.",
    "integer" => ":attribute باید نوع داده ای عددی (integer) باشد.",
    'in_array' => 'فیلد :attribute در :other موجود نیست.',
    "ip" => ":attribute باید IP آدرس معتبر باشد.",
    'ipv4' => ':attribute باید یک ادرس درست IPv4 باشد.',
    'ipv6' => ':attribute باید یک ادرس درست IPv6 باشد.',
    'json' => ':attribute یک مقدار درست JSON باشد.',
    'lt' => [
        'numeric' => ':attribute باید کمتر از :value باشد.',
        'file' => ':attribute باید کمتر از :value کیلوبایت باشد.',
        'string' => ':attribute باید کمتر از :value کاراکتر باشد.',
        'array' => ':attribute باید :value ایتم یا کمتر را داشته باشد.',
    ],
    'lte' => [
        'numeric' => ':attribute باید کمتر یا برابر :value باشد.',
        'file' => ':attribute باید کمتر یا برابر :value کیلوبایت باشد.',
        'string' => ':attribute باید کمتر یا برابر :value کاراکتر باشد.',
        'array' => ':attribute باید :value ایتم یا کمتر را داشته باشد.',
    ],
    "max" => [
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file" => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string" => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array" => ":attribute نباید بیشتر از :max آیتم باشد.",
    ],
    "mimes" => ":attribute باید یکی از فرمت های :values باشد.",
    'mimetypes' => ':attribute باید تایپ ان از نوع: :values باشد.',
    "min" => [
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file" => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string" => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array" => ":attribute نباید کمتر از :min آیتم باشد.",
    ],
    'multiple_of' => ':attribute باید ضریبی از :value باشد.',
    "not_in" => ":attribute انتخاب شده، معتبر نیست.",
    'not_regex' => ':attribute فرمت معتبر نیست.',
    "numeric" => ":attribute باید شامل عدد باشد.",
    'password' => 'رمز عبور اشتباه است.',
    'present' => ':attribute باید وجود داشته باشد.',
    'prohibited' => 'فیلد :attribute ممنوع است.',
    'prohibited_if' => 'هنگام که :other، :value است فیلد :attribute ممنوع است.',
    'prohibited_unless' => ':attribute ممنوع است مگر اینکه :other برابر با (:values) باشد.',
    'prohibits' => 'هنگام ورود فیلد :attribute، وارد کردن فیلد :other ممنوع است.',
    "regex" => ":attribute یک فرمت معتبر نیست",
    "required" => "فیلد :attribute الزامی است",
    "required_if" => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    'required_unless' => 'قیلد :attribute الزامیست مگر این فیلد :other مقدارش  :values باشد.',
    "required_with" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "same" => ":attribute و :other باید مانند هم باشند.",
    "size" => [
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file" => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string" => ":attribute باید برابر با :size کاراکتر باشد.",
        "array" => ":attribute باسد شامل :size آیتم باشد.",
    ],
    'starts_with' => ':attribute باید با یکی از این مقادیر شروع شود: :values.',
    "string" => ":attribute باید رشته باشد.",
    "timezone" => "فیلد :attribute باید یک منطقه صحیح باشد.",
    "unique" => ":attribute قبلا انتخاب شده است.",
    'uploaded' => 'فیلد :attribute به درستی اپلود نشد.',
    "url" => "فرمت آدرس :attribute اشتباه است.",
    'uuid' => ':attribute باید یک فرمت درست UUID باشد.',
    'invalid' => 'فیلد :attribute نامعتبر می باشد.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        "name" => "نام",
        "username" => "نام کاربری",
        "user" => 'کاربر',
        "full_name" => "نام و نام خانوادگی",
        "email" => "پست الکترونیکی",
        "first_name" => "نام",
        "last_name" => "نام خانوادگی",
        "family" => "نام خانوادگی",
        "password" => "رمز عبور",
        "password_confirmation" => "تاییدیه ی رمز عبور",
        "city" => "شهر",
        "country" => "کشور",
        "address" => "نشانی",
        "phone" => "تلفن",
        "mobile" => "تلفن همراه",
        "cellphone" => "شماره موبایل",
        "age" => "سن",
        "sex" => "جنسیت",
        "gender" => "جنسیت",
        "day" => "روز",
        "month" => "ماه",
        "year" => "سال",
        "hour" => "ساعت",
        "minute" => "دقیقه",
        "second" => "ثانیه",
        "title" => "عنوان",
        "text" => "متن",
        "content" => "محتوا",
        "description" => "توضیحات",
        "excerpt" => "گلچین کردن",
        "date" => "تاریخ",
        "time" => "زمان",
        "available" => "موجود",
        "size" => "اندازه",
        "file" => "فایل",
        "price" => "قیمت",
        "slug" => "پیوند یکتا",
        "body" => "توضیحات",
        "image" => "تصویر",
        "old_password" => "کلمه عبور فعلی",
        "course_code" => "کد دوره",
        "course_coach" => "نام مربی",
        "capacity" => "ظرفیت",
        "session_number" => "نعداد جلسات",
        "type" => "نوع",
        "sub_title" => "توضیح کوتاه",
        "age_range" => "رده سنی",
        "genre" => "ژانر",
        "print" => "چاپ",
        "read_time" => "زمان مطالعه",
        "count" => "تعداد",
        "general_price" => "شهریه عمومی",
        "price_three" => "شهریه سه نفره",
        "price_two" => "شهریه دو نفره",
        "price_one" => "شهریه یک نفره",
        "not_present_price" => "شهریه غیر حضوری",
        "standard_time" => "ساعت استاندارد",
        "standard_code" => "کد استاندارد",
        "firstname" => "نام",
        "lastname" => "نام خانوادگی",
        "national_code" => "کد ملی",
        "post_code" => "کد پستی",
        "postal_code" => "کد پستی",
        "standard_group_id" => "دسته بندی",
        "learnstandard_id" => "مهارت",
        "coupon_code" => "کد تخفیف",
        "user_name" => "نام کاربری",

        "roleName" => "نام مقام",


        "category_id" => "نام دوره",
        "number_of_sessions" => "تعداد جلسات",
        "public_amount" => "شهریه عمومی",
        "three_people_amount" => "شهریه سه نفره",
        "two_people_amount" => "شهریه دو نفره",
        "one_people_amount" => "شهریه یک نفره",
        "non_attendance_amount" => "شهریه غیر حضوری",
        "status" => "وضعیت",
        "brand" => "برند",
        "category" => "دسته بندی",
        "is_active" => "وضعیت",
        "comment" => "نظر",


        'variation.*.size' => 'اندازه محصول',
        'variation.*.weight' => 'وزن محصول',
        'variation.*.quantity' => 'تعداد محصول',
        'variation.*.off_sale' => 'تخفیف محصول',
        'variation.*.price' => 'قیمت محصول',
        'variation.*.image.*' => 'تصویر محصول',

        "age_range_from" => "سن اول",
        "age_range_to" => "سن دوم",
        "id" => "آیدی",
        "category_count" => "دسته بندی",
    ],
];
