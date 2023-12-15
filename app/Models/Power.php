<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Power extends Model
{
    use HasFactory;
    protected $fillable = [
        'model',
        'ip',
        'device_name',
        'screen_id',
        'id_server',
    ] ;

    public function screen(): BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }

}
