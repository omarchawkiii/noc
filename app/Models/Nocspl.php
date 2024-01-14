<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nocspl extends Model
{
    use HasFactory;
    protected $fillable = [
        'spl_title',
        'display_mode',
        'spl_properties_hfr',
        'xmlpath',
        'duration',
        'location_id',
    ];


}
