<?php

return [

    'required' => 'فیلد :attribute الزامی است.',
    'email' => 'فرمت :attribute معتبر نیست.',
    'min' => [
        'string' => ':attribute باید حداقل :min کاراکتر باشد.',
        'numeric' => ':attribute باید حداقل :min باشد.',
        'array' => ':attribute باید حداقل :min آیتم داشته باشد.',
    ],
    'max' => [
        'string' => ':attribute نباید بیشتر از :max کاراکتر باشد.',
        'numeric' => ':attribute نباید بیشتر از :max باشد.',
        'file' => 'حجم :attribute نباید بیشتر از :max کیلوبایت باشد.',
    ],
    'unique' => 'این :attribute قبلاً ثبت شده است.',
    'confirmed' => 'تأیید :attribute مطابقت ندارد.',
    'exists' => ':attribute انتخاب‌شده معتبر نیست.',
    'image' => ':attribute باید یک تصویر باشد.',
    'mimes' => ':attribute باید از نوع: :values باشد.',
    'numeric' => ':attribute باید عدد باشد.',
    'integer' => ':attribute باید عدد صحیح باشد.',
    'string' => ':attribute باید متن باشد.',
    'boolean' => ':attribute باید صحیح یا غلط باشد.',
    'in' => ':attribute انتخاب‌شده معتبر نیست.',
    'not_in' => ':attribute انتخاب‌شده معتبر نیست.',
    'date' => ':attribute یک تاریخ معتبر نیست.',
    'after' => ':attribute باید تاریخی بعد از :date باشد.',
    'before' => ':attribute باید تاریخی قبل از :date باشد.',
    'url' => 'فرمت :attribute معتبر نیست.',
    'regex' => 'فرمت :attribute معتبر نیست.',
    'same' => ':attribute و :other باید یکسان باشند.',
    'different' => ':attribute و :other باید متفاوت باشند.',
    'digits' => ':attribute باید :digits رقم باشد.',
    'digits_between' => ':attribute باید بین :min و :max رقم باشد.',
    'file' => ':attribute باید یک فایل باشد.',
    'uploaded' => 'آپلود :attribute با خطا مواجه شد.',

    // نام فیلدها به فارسی
    'attributes' => [
        'title' => 'عنوان',
        'email' => 'ایمیل',
        'password' => 'رمز عبور',
        'password_confirmation' => 'تأیید رمز عبور',
        'content' => 'محتوا',
        'name' => 'نام',
        'phone' => 'شماره تماس',
        'category_id' => 'دسته‌بندی',
        'photo' => 'تصویر',
        'description' => 'توضیحات',
        'price' => 'قیمت',
        'slug' => 'نامک',
        'body' => 'متن',
        'mobile' => 'موبایل',
    ],

];
