<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'company_size',
        'preferred_call_time',
        'preferred_call_date',
        'message',
        'submitted_from_ip',
        'submitted_user_agent',
    ];

    protected $casts = [
        'preferred_call_date' => 'date',
    ];
}
