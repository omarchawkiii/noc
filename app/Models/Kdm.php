<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kdm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'ContentKeysNotValidBefore',
        'ContentKeysNotValidAfter',
        'kdm_installed',
        'content_present',
        'serverName_by_serial',
        'screen_id',
        'cpl_uuid',
        'location_id',
        'device_target',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'file_size' => 'decimal:2',
        'file_progress' => 'decimal:2',
        'last_update' => 'datetime',
        'screen_id' => 'integer',
        'cpl_id' => 'integer',
    ];

    public function cpl(): BelongsTo
    {
        return $this->belongsTo(Cpl::class);
    }

    public function screen(): BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }
}
