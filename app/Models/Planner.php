<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

}
