<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [

    'name' ,
    'scheduleId' ,
    'titleShort' ,
    'uuid_spl' ,
    'screen_number' ,
    //'duration' ,
    'cod_film' ,
    'id_film' ,
    'color' ,
    'date_start' ,
    'date_end' ,
    'type' ,
    'status' ,
    'cpls' ,
    'kdm' ,
    "idserver" ,
    'ShowTitleText' ,
    'spl_available' ,
    'screen_id' ,
    'spl_id' ,
    'location_id' ,
    'kdm_status',
    'date_expired',


    ] ;

    public function screen(): BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }
    public function spls(): BelongsTo
    {
        return $this->belongsTo(Spl::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

}
