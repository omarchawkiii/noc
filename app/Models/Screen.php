<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Screen extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id_server" ,
        "screen_number" ,
        "screen_name" ,
        "screenModel" ,
        "playback" ,
        "sound" ,
        "server_ip" ,
        "ingestProtocol_server" ,
        "remotPath" ,
        "managment_ip" ,
        "projector_enable" ,
        "projector_ip" ,
        "projector_brand" ,
        "projector_model" ,
        "sound_enable" ,
        "sound_ip" ,
        "sound_brand" ,
        "sound_model" ,
        "audio_enable" ,
        "audio_ip" ,
        "audio_brand" ,
        "audio_model" ,
        "automation_enable" ,
        "automation_ip" ,
        "automation_brand" ,
        "automation_model" ,
        "automation_username" ,
        "automation_password" ,
        "enable_power_control" ,
        'location_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'seat' => 'integer',
        'screen_h' => 'decimal:2',
        'screen_w' => 'decimal:2',
        'screen_d' => 'decimal:2',
        'installed' => 'boolean',
        'location_id' => 'integer',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function powers(): HasMany
    {
        return $this->hasMany(Power::class);
    }
    public function spls(): HasMany
    {
        return $this->hasMany(Spl::class);
    }
    public function cpls(): HasMany
    {
        return $this->hasMany(Cpl::class);
    }
    public function kdms(): HasMany
    {
        return $this->hasMany(Kdm::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function playbacks(): HasMany
    {
        return $this->hasMany(Playback::class);
    }

}
