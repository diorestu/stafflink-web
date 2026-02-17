<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'age',
        'religion',
        'province',
        'city',
        'address',
        'speaks_english',
        'english_level',
        'willing_to_travel',
        'has_motorbike',
        'has_passport',
        'can_drive_car',
        'position_title',
        'cover_letter',
        'portfolio_url',
        'custom_answers',
        'career_job_id',
        'resume_path',
        'id_ktp_path',
        'skck_path',
        'cover_letter_file_path',
        'portfolio_file_path',
        'attachment_link',
        'reference_name',
        'reference_company',
        'reference_phone',
        'reference_email',
        'reference_token',
        'status',
    ];

    protected $casts = [
        'speaks_english' => 'boolean',
        'willing_to_travel' => 'boolean',
        'has_motorbike' => 'boolean',
        'has_passport' => 'boolean',
        'can_drive_car' => 'boolean',
        'custom_answers' => 'array',
    ];
}
