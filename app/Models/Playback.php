<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Playback extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_server" ,
        "serverName" ,
        "playback" ,
        "managment_ip" ,
        "usernameAdmin" ,
        "passwordAdmin" ,
        "serverType" ,
        "storage_configuration" ,
        "storage_ip" ,
        "enable_power_control" ,
        "projector_ip" ,
        "sound_ip" ,
        "id_auditorium" ,
        "number_auditorium" ,
        "sound_model" ,
        "ip_management_server_status" ,
        "storage_generale_status" ,
        "schedule_mode" ,
        "hardware" ,
        "securityManager" ,
        "total_server_status" ,
        "schedule_generale_status" ,
        "projector_status" ,
        "projector_lamp_stat" ,
        "spl_title" ,
        "cpl_title" ,
        "playback_status" ,
        "elapsed_runtime" ,
        "remaining_runtime" ,
        "progress_bar" ,
        "lamp_status" ,
        "dowser_status" ,
        'location_id',
        'screen_id',
    ];

    public function screen(): BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
