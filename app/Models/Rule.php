<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_start',
        'date_end',
        'target_screen_type',
        'movies_id',
        'template_selection',
        'marker',
        'priority',
        'location_id',
        'planner_id'
    ];


    public function planner(): BelongsTo
    {
        return $this->belongsTo(Planner::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Moviescod::class,'moviescods','id');
    }
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
