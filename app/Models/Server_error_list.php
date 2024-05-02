<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Server_error_list extends Model
{
    use HasFactory;

    protected $fillable = [

        'class',
        'criticity',
        'date',
        'errorCode',
        'eventId',
        'id_server_error',
        'id_screen',
        'number',
        'serverName',
        'subType',
        'type',
        'location_id',

    ];


    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }


}
