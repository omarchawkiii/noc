<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lmsspl extends Model
{
    use HasFactory;

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

    public function lmscpls(): BelongsToMany
    {
        return $this->belongsToMany(Lmscpl::class,'lmscpls_lmsspls');
    }
    public function screen(): BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
