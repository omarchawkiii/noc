<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Screen extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'seat',
        'api_namespace',
        'type',
        'masking_movement',
        'screen_h',
        'screen_w',
        'screen_d',
        'projector_brand',
        'projector_model',
        'projector_ip_lan',
        'lens_model',
        'installed',
        'server_brand',
        'server_model',
        'server_ip_lan',
        'ingest_capabilities',
        '3d_brand',
        '3d_model',
        'automation_brand',
        'automation_model',
        'automation_ip_lan',
        'satelite_or_live',
        'transmission_brand',
        'transmission_model',
        'transmission_ip_lan',
        'processor_brand',
        'processor_model',
        'processor_ip_lan',
        'audio_type',
        'audio_brand',
        'audio_model',
        'audio_channel',
        'audio_frequency',
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
}
