<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_or_institution',
        'service_type',
        'mikrotik_model',
        'isp_count',
        'user_count',
        'problem_description',
        'status',
        'admin_notes',
    ];
}
