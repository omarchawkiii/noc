<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kdm_error_list extends Model
{
    use HasFactory;
    protected $fillable = [
        'annotationText',
        'cpl_id',
        'date_time',
        'details',
        'screen_id',
        'serverName',
        'location_id',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
