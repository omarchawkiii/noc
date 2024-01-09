<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lmscpl extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid' ,
        'id_dcp' ,
        'contentTitleText' ,
        'contentKind' ,
        'EditRate' ,
        'is_3D',
        'totalSize' ,
        'soundChannelCount',
        'durationEdits' ,
        'ScreenAspectRatio',
        'available_on',
        'serverName',
        'cpl_is_linked',
        'date_create_ingest',
        'pictureEncryptionAlgorithm',
        'Width',
        'Height' ,
        'screen_id',
        'location_id',
        'type',
        'cinema_DCP',
        'aspect_Ratio',
        'duration_seconds',
        'duration',

    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function lmsspls(): BelongsToMany
    {
        return $this->belongsToMany(Lmsspl::class,'lmscpls_lmsspls');
    }
    public function screen(): BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }

}
