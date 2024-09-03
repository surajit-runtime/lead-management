<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    use HasFactory;
    protected $fillable = [
        'audience_name',
        'lead_ids',
    ];

    protected $casts = [
        'lead_ids' => 'array',
    ];
}
