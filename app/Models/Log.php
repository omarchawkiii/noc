<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory;


    protected $fillable = [
        'recId',
        'converted_rec_date',
        'recType',
        'recSubtype',
        'recPriority',
        'recKeywords',
        'screen_number',
        'Abbreviation',
        'serverName',
        'screen_id',
        'location_id',
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
