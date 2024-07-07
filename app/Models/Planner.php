<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Planner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpl_uuid',
        'date_start',
        'date_end',
        'location_id',
        'screen_type',
        'movies_id',
        'spl_uuid',
        'template_position',
        'position',
        'marker',
        'priority',
        'feature',
    ];
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Moviescod::class,'moviescods','id');
    }

}
