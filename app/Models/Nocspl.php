<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Nocspl extends Model
{
    use HasFactory;
    protected $fillable = [
        'spl_title',
        'display_mode',
        'spl_properties_hfr',
        'xmlpath',
        'duration',
        'location_id',
        'uuid',
    ];
    public function lmscpls(): BelongsToMany
    {
        return $this->belongsToMany(Lmscpl::class,'lmscpls_nocspls');
    }

}
