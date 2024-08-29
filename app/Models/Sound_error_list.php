<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sound_error_list extends Model
{
    use HasFactory;
    protected $fillable = [
        "alarm_id",
        "date_saved",
        "severity",
        "title",
        "clearable",
        "hardware",
        "screen",
        "location_id",
    ];
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

}
