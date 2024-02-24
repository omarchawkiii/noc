<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class splcomponents extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_splcomponent',
        'CompositionPlaylistId',
        'AnnotationText',
        'EditRate',
        'editRate_numerator',
        'editRate_denominator',
        'uuid_spl',
        'spl_id',
        'location_id',
    ];

    public function spl(): BelongsTo
    {
        return $this->belongsTo(Spl::class);
    }

}
