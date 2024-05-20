<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Storage_errors_list extends Model
{
    use HasFactory;

    protected $fillable = [
        "screen_number",
        "storage_generale_status",
        "serverName",
        "location_id",
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }


}
