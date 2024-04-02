<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assetinfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'screen_status' ,
        'screen_number' ,
        'screen_name' ,
        'server_product_name' ,
        'server_esn' ,
        'server_software' ,
        'projector_model_number' ,
        'projector_serial_number' ,
        'sound_model' ,
        'sound_chasis_serial' ,
        'sound_esn' ,
        'location_id',
        'screen_id',
    ];

    public function screen(): BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

}
