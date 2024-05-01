<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

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
        'latitude',
        'longitude',
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
/*
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }*/

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

    public function moviescod(): HasMany
    {
        return $this->hasMany(Moviescod::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'locations_users');
    }

    public function assetinfos(): HasMany
    {
        return $this->hasMany(Assetinfo::class);
    }

    public function error_lists(): HasMany
    {
        return $this->hasMany(Error_list::class);
    }

}
