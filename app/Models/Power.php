<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Power extends Model
{
    use HasFactory;
    protected $fillable = [
        'model',
        'ip',
        'device_name',
        'screen_id',
        'id_server',
        'id_power',
        'location_id',
    ] ;

    public function screen(): BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }

}
