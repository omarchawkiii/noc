<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Error_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'kdm_errors',
        'nbr_sound_alert',
        'nbr_projector_alert',
        'nbr_server_alert',
        'nbr_storage_errors',
        'location_id',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

}
