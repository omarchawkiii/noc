<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Moviescod extends Model
{
    use HasFactory;
    protected $fillable = [
        'moviescods_id',
        'code',
        'title',
        'titleShort',
        'last_update',
        'status',
        'location_id',
        'nocspl_id'
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function nocspl(): BelongsTo
    {
        return $this->belongsTo(Nocspl::class);
    }
}
