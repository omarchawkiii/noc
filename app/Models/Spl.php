<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spl extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'uuid',
        'annotation',
        'issue_date',
        'creator',
        'path_file',
        'server_name',
        'last_update',
        'file_type',
        'duration',
        'is_downloaded',
        'tms_path',
        'id_server',
        'id_local_server',
        'file_size',
        'file_progress',
        'spl_type',
        'location_id',
        'screen_id',
        'available_on',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'last_update' => 'datetime',
        'file_size' => 'decimal:2',
        'file_progress' => 'decimal:2',
        'location_id' => 'integer',
    ];

    public function cpls(): BelongsToMany
    {
        return $this->belongsToMany(Cpl::class,'cpls_spls');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
    public function screen(): BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }
}
