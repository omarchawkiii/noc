<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'folder_title',
        'connection_ip',
        'tms_system',
        'rentrak_id',
        'type',
        'hostname',
        'email',
        'password',
        'port',
        'location_email',
        'phone',
        'support_email',
        'modem',
        'internet',
        'address',
        'city',
        'zip',
        'country',
        'state',
        'company',
        'language',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

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

    public function lmsspls(): HasMany
    {
        return $this->hasMany(Lmsspl::class);
    }

    public function lmscpls(): HasMany
    {
        return $this->hasMany(Lmscpl::class);
    }

    public function lmskdms(): HasMany
    {
        return $this->hasMany(Lmskdm::class);
    }

    public function diskusage(): HasOne
    {
        return $this->hasOne(Diskusage::class);
    }

    public function screens(): HasMany
    {
        return $this->hasMany(Screen::class);
    }
    public function snmps(): HasMany
    {
        return $this->hasMany(Snmp::class);
    }
    public function playbacks(): HasMany
    {
        return $this->hasMany(Playback::class);
    }
    public function macros(): HasMany
    {
        return $this->hasMany(Macro::class);
    }

}
