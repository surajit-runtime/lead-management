<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 0 -> save draft
 * 1 -> publish
 * 2 -> send now
 */
class Campaign extends Model
{
    use HasFactory, SoftDeletes;

    // Define the table associated with the model
    protected $table = 'campaigns';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'campaign_name',
        'audience_id',
        'date',
        'channel',
        'subject',
        'body',
        'flag',
        'success_status',
    ];

    // Define the attributes that should be cast to native types
    protected $casts = [
        'date' => 'datetime', // Cast to datetime for the 'date' column
        'flag' => 'boolean',
        'success_status' => 'boolean',
    ];

    // Define the relationship with the Audience model
    public function audience()
    {
        return $this->belongsTo(Audience::class);
    }
}
