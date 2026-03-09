<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NannyInquiry extends Model
{
    protected $fillable = [
        'wedding_couple_names',
        'unique_code',
        'wedding_date',
        'wedding_start_time',
        'wedding_location_address',
        'wedding_venue_name',
        'wedding_group_key',
        'guardian_name',
        'guardian_phone',
        'guardian_email',
        'children_count',
        'nannies_required',
        'children',
        'accommodation_location_option',
        'accommodation_detail',
        'ceremony_service_choice',
        'additional_hours',
        'payment_acknowledgement',
        'whatsapp_message',
        'submitted_from_ip',
        'submitted_user_agent',
    ];

    protected $casts = [
        'children' => 'array',
        'wedding_date' => 'date',
    ];
}
