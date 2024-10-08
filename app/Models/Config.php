<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $fillable = [
        'timeStart',
        'timeEnd',
        'autoIngest' ,
        'dayStart',
        'transfer_simultaneously',
        'maximum_transfer_rate',
    ];



}
