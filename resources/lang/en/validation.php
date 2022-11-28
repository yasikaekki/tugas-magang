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
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
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
    // 'confirmed' => 'The :attribute confirmation does not match.',
    'confirmed' => 'Konfirmasi :attribute tidak sama',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'Nomor :attribute wajib minimal :min - :max digit.',
    // 'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'email yang anda inputkan salah',
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
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    // 'not_regex' => ':attribute wajib memiliki angka huruf dan spesial karakter',
    'numeric' => 'The :attribute must be a number.',
    // 'password' => 'The password is incorrect.',
    'password_lama' => 'password lama yang anda inputkan salah',
    'password' => 'password yang anda inputkan salah',
    'password_confirmation' => 'password yang anda inputkan tidak sama dengan password sebelumnya',
    'present' => 'The :attribute field must be present.',
    // 'regex' => 'The :attribute format is invalid.',
    'regex' => ':attribute wajib memiliki angka huruf dan spesial karakter',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    // 'same' => 'The :attribute and :other must match.',
    'same' => ':attribute dengan :other tidak sama',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    // 'unique' => 'The :attribute has already been taken.',
    'unique' => ':attribute yang anda masukkan telah terdaftar',
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
        'selectrole' => [
            'required' => 'silahkan pilih role',
        ],
        'nama_lengkap' => [
            'required' => 'silahkan dilengkapi nama lengkap',
        ],
        'tentang_Saya' => [
            'required' => 'silahkan dilengkapi tentang saya',
        ],
        'pendidikan_user' => [
            'required' => 'silahkan pilih pendidikan anda saat ini',
        ],
        'pekerjaan' => [
            'required' => 'silahkan dilengkapi pekerjaan',
        ],
        'keahlian' => [
            'required' => 'silahkan dilengkapi keahlian',
        ],
        'tanggal_lahir' => [
            'required' => 'silahkan dilengkapi tanggal lahir',
        ],
        'tempat_lahir' => [
            'required' => 'silahkan dilengkapi tempat lahir',
        ],
        'jenis_kelamin' => [
            'required' => 'silahkan pilih jenis kelamin anda',
        ],
        'tentang_saya' => [
            'required' => 'silahkan lengkapi tentang saya',
        ],
        'alamat_rumah' => [
            'required' => 'silahkan dilengkapi alamat rumah',
        ],
        'telepon' => [
            'required' => 'silahkan dilengkapi nomor telepon',
        ],
        'pekerjaan' => [
            'required' => 'silahkan dilengkapi pekerjaan anda',
        ],
        'keahlian' => [
            'required' => 'silahkan dilengkapi nomor keahlian anda',
        ],
        'nama_perusahaan' => [
            'required' => 'silahkan lengkapi nama perusahaan anda',
        ],

        'jumlah_karyawan' => [
            'required' => 'silahkan lengkapi jumlah karyawan anda',
        ],
        'industri' => [
            'required' => 'silahkan pilih industri anda',
        ],
        'upload_foto' => [
            'required' => 'silahkan upload foto anda',
        ],
        'upload_akta' => [
            'required' => 'silahkan upload akte anda',
        ],
        'upload_siup' => [
            'required' => 'silahkan upload siup anda',
        ],
        'upload_portofolio' => [
            'required' => 'silahkan upload portofolio anda',
        ],
        'upload_sk' => [
            'required' => 'silahkan upload sk anda',
        ],
        'upload_cv' => [
            'required' => 'silahkan upload cv anda',
        ],
        'upload_nib' => [
            'required' => 'silahkan upload nib anda',
        ],
        'judul_pekerjaan' => [
            'required' => 'silahkan lengkapi judul pekerjaan',
        ],
        'bidang_pekerjaan' => [
            'required' => 'pilih bidang pekerjaan',
        ],
        'employee' => [
            'required' => 'pilih kebutuhan pekerjaan',
        ],
        'deskripsi_pekerjaan' => [
            'required' => 'silahkan lengkapi deskripsi pekerjaan',
        ],
        'persyaratan' => [
            'required' => 'silahkan lengkapi persyaratan pekerjaan',
        ],
        'masa_berakhir' => [
            'required' => 'silahkan lengkapi masa berakhir pekerjaan',
        ],
        'tentang_perusahaan' => [
            'required' => 'silahkan lengkapi tentang perusahaan anda',
        ],
        'alamat_perusahaan' => [
            'required' => 'silahkan lengkapi alamat perusahaan anda',
        ],
        'no_npwp' => [
            'required' => 'silahkan lengkapi nomor npwp anda',
        ],
        'nama_admin' => [
            'required' => 'silahkan lengkapi nama admin',
        ],
        'email_admin' => [
            'required' => 'silahkan lengkapi email admin',
        ],
        'password' => [
            'required' => 'silahkan lengkapi password',
        ],
        'password_konfirmasi' => [
            'required' => 'silahkan lengkapi konfirmasi password',
        ],
        'name' => [
            'required' => 'silahkan lengkapi nama akun anda',
        ],
        'email' => [
            'required' => 'silahkan lengkapi email akun anda',
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

    'attributes' => [],

];
