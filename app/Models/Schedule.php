<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [

    'scheduleId',
    'screen_number',
    'duration',
    'cod_film',
    'id_film',
    'color',
    'date_start',
    'date_end',
    'type',
    'screen_name',
    'screen_id',
    'spl_id',

    ] ;

}
