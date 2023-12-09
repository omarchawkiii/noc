<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cpl extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'durationEdits',
        'storageKind',
        'name',
        'contentKind',
        'editRate_numerator',
        'editRate_denominator',
        'editRateFPS',
        'pictureWidth',
        'pictureHeight',
        'pictureEncodingAlgorithm',
        'pictureEncryptionAlgorithm',
        'soundChannelCount',
        'soundQuantizationBits',
        'soundEncodingAlgorithm',
        'soundEncryptionAlgorithm',
        'encryptionKeysCount',
        'framesPerEdit',
        'is3D',
        'standardCompliance',
        'soundSamplingRate_numerator',
        'soundSamplingRate_denominator',
        'assets',
        'cplSizeInBytes',
        'packageSizeInBytes',
        'markersCount',
        'playable',
        'last_update',
        'cpl_list_uuivd',
        'id_auditorium',
        'id_server',
        'location_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pictureWidth' => 'decimal:2',
        'pictureHeight' => 'decimal:2',
        'soundChannelCount' => 'decimal:2',
        'soundQuantizationBits' => 'decimal:2',
        'encryptionKeysCount' => 'decimal:2',
        'framesPerEdit' => 'decimal:2',
        'is3D' => 'boolean',
        'assets' => 'decimal:2',
        'cplSizeInBytes' => 'decimal:2',
        'packageSizeInBytes' => 'decimal:2',
        'last_update' => 'datetime',
        'id_auditorium' => 'decimal:2',
        'location_id' => 'integer',
    ];

    public function spls(): HasMany
    {
        return $this->hasMany(Spl::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
