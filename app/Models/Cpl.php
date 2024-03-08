<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Cpl extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'uuid',
        'id_dcp',
        'contentTitleText',
        'contentKind',
        'EditRate',
        'is_3D',
        'totalSize',
        'soundChannelCount',
        'durationEdits',
        'ScreenAspectRatio',
        'available_on',
        'serverName',
        'cpl_is_linked',
        'location_id',
        'screen_id',
        'playable' ,
        'pictureEncodingAlgorithm',
        'pictureEncryptionAlgorithm',
        'soundQuantizationBits',
        'soundEncodingAlgorithm',
        'soundEncryptionAlgorithm',
        'markersCount',
        'pictureWidth',
        'pictureHeight',
        'type',
    ];

    protected $primaryKey = 'id';
   // protected $primaryKey = ['uuid', 'location_id'];
    public $incrementing = false;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'id' => 'integer',
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

    public function spls(): BelongsToMany
    {
        return $this->belongsToMany(Spl::class,'cpls_spls')->where('location_id','=', $this->location_id)->groupBy('uuid');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function kdms(): hasMany
    {
        return $this->hasMany(Kdm::class);
    }
    public function screen(): BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }
}
