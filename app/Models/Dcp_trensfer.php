<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dcp_trensfer extends Model
{
    use HasFactory;

    protected $fillable = [
        "status",
        "torrent_path",
        "progress",
        "id_ingest",
        "source",
        "id_cpl",
        'location_id',
        'pkl_size',
    ];

    protected $casts = [
        'created_at'  => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];


    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
