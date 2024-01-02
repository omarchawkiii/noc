<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lmskdm extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'idkdm_files',
        'AnnotationText',
        'ContentKeysNotValidBefore',
        'ContentKeysNotValidAfter',
        'SubjectName',
        'DeviceListDescription',
        'path_file',
        'server_name',
        'file_type',
        'id_server',
        'file_size',
        'file_progress',
        'tms_path',
        'last_update',
        'device_target',

        'serverName_by_serial',
        'kdm_installed',
        'content_present',
        'screen_id',

        'cpl_id',
        'location_id',
    ];

    public function lmscpl(): BelongsTo
    {
        return $this->belongsTo(Lmscpl::class);
    }
    public function screen(): BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }

}
