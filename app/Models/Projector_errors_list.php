<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Projector_errors_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'id_projector_errors',
        'id_screen',
        'ip_projector',
        'message',
        'number',
        'serverName',
        'severity',
        'time_saved',
        'title',
        'location_id',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }



}
