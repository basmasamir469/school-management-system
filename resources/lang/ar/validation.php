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

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => ':attribute يجب ان يكون  تاريخ مساويا او بعد :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'يجب ان يكون بريد الكتروني صالح',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ':attribute  يجب الا يكون اكبر من :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => ':attribute  يجب الا يكون اكبر من :max حروف.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => ':attribute  يجب ان يكون علي الاقل :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => ':attribute  يجب ان يكون علي الاقل :min حروف.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => ':attribute غير صالح.',
    'required' => ' :attribute مطلوب',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => ':attribute  يجب ان يكون :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => ':attribute  يجب ان يكون :size حروف.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => ':attribute موجود من قبل ',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name_en'=>'الاسم بالانجليزية',
        'name_ar'=>'الاسم بالعربية',
        'data.classes_list.*.class_name_ar'=>'اسم الفصل الدراسي بالعربية ',
        'data.classes_list.*.class_name_en'=>'اسم الفصل الدراسي بالانجليزية ',
        'data.classes_list.*.grade_id'=>'اسم المرحلة ',
        'class_name_ar'=>'اسم الفصل الدراسي بالعربية ',
        'class_name_en'=>'اسم الفصل الدراسي بالانجليزية ',
        'grade_id'=>'اسم المرحلة ',
        'gradeClass_id'=>'الفصل الدراسي',
        'section_name.ar'=>'اسم القسم بالعربية',
        'section_name.en'=>'اسم القسم بالانجليزية',
        'Email'=>'البريد الالكتروني',
        'National_ID_Father' => 'الرقم القومي للاب',
        'Passport_ID_Father' => 'رقم الجواز للاب',
        'Phone_Father' => 'رقم تليفون الاب',
        'National_ID_Mother' => 'الرقم القومي للام',
        'Passport_ID_Mother' => 'رقم الجواز للام',
        'Phone_Mother' => 'رقم تليفون الام',
        'Password'=>'كلمة المرور',
        'Name_Father'=>'اسم الاب بالعربية',
        'Name_Father_en'=>'اسم الاب بالانجليزية',
        'Job_Father'=>'وظيفة الاب بالعربية',
        'Job_Father_en'=>'وظيفة الاب بالانجليزية',
        'Nationality_Father_id'=>'جنسية الاب',
        'Blood_Type_Father_id'=>'فصيلة دم الاب',
        'Address_Father'=>'عنوان الاب',
        'Religion_Father_id'=>'ديانة الاب',
        'Name_Mother'=>'اسم الام بالعربية',
        'Name_Mother_en'=>'اسم الام بالانجليزية',
        'Job_Mother'=>'وظيفة الام بالعربية',
        'Job_Mother_en'=>'وظيفة الام بالانجليزية',
        'Nationality_Mother_id'=>'جنسية الام',
        'Blood_Type_Mother_id'=>'فصيلة دم الام',
        'Address_Mother'=>'عنوان الام',
        'Religion_Mother_id'=>'ديانة الام',
        'specialization_id'=>'التخصص',
        'gender_id'=>'النوع',
        'password'=>'كلمة المرور',
        'email'=>'البريد الالكتروني',
        'joining_date'=>'تاريخ التعيين',
        'address'=>'العنوان',
        'teachers'=>'المعلمين',
        'section_name_en'=>'اسم القسم بالانجليزية',
        'section_name_ar'=>'اسم القسم بالعربية',
        'gradeClass_id'=>' اسم الصف',
        'student_name_en'=>'اسم الطالب بالانجليزية',
        'student_name_ar'=>'اسم الطالب العربية',
        'academic_year'=>'السنة الدراسية',
        'parent_id'=>'اسم ولي الامر',
        'nationality_id'=>'الجنسية',
        'blood_type_id'=>'فصيلة الدم',
        'grade_class_id'=>'الفصل الدراسي',
        'section_id'=>'اسم القسم',
        'birth_date'=>'تاريخ الميلاد'
        
        

    ],

    'dates'=>[
        'today'=>'اليوم'
    ]

];
