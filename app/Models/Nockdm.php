<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nockdm extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'ContentKeysNotValidBefore',
        'ContentKeysNotValidAfter',
        'kdm_installed',
        'content_present',
        'serverName_by_serial',
        'screen_id',
        'cpl_id',
        'location_id',
        'xmlpath'

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
