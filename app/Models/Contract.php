<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'contract_number',
        'template',
        'division_id',
        'employee_name',
        'employee_title',
        'employee_id_number',
        'position_title',
        'employment_basis',
        'company_name',
        'employer_name',
        'first_party_name',
        'agreement_date',
        'start_date',
        'end_date',
        'salary_total',
        'salary_base',
        'salary_allowance',
        'food_allowance',
        'transport_allowance',
        'form_data',
    ];

    protected $casts = [
        'agreement_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'salary_total' => 'decimal:0',
        'salary_base' => 'decimal:0',
        'salary_allowance' => 'decimal:0',
        'food_allowance' => 'decimal:0',
        'transport_allowance' => 'decimal:0',
        'form_data' => 'array',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function getTemplateLabel(): string
    {
        return match ($this->template) {
            'fixed_term_pkwt' => 'PKWT',
            'permanent_pkwtt' => 'PKWTT',
            default => $this->template,
        };
    }
}
