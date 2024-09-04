<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'tbl_lead';

    // The primary key associated with the table.
    protected $primaryKey = 'id';

    // Indicates if the model should be timestamped.
    public $timestamps = true;

    // The attributes that are mass assignable.
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'refernce_number',
        'email',
        'lead_type_id',
        'lead_date',
        'last_lead_updated_date',
        'lead_status_id',
        'next_date_call',
        'lead_assign_by',
        'executive_id_assign_to',
        'BM_id',
        'address',
        'pincode',
        'zone_id',
        'district_id',
        'is_new',
        'callcenter_id',
        'state_id',
        'lead_follow_up_id',
        'first_action_by',
        'last_action_by',
        'created_from',
        'total_time_taken',
        'lead_data',
        'is_manual',
        'time_taken'
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'lead_date' => 'datetime',
        'last_lead_updated_date' => 'datetime',
        'next_date_call' => 'datetime',
        'total_time_taken' => 'time',
        'time_taken' => 'time'
    ];
}
