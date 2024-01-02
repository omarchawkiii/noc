<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Snmp extends Model
{
    use HasFactory;
    protected $fillable = [
   'id_snmp',
   'ip_address',
   'type',
   'trap_data',
   'snmp_created_at',
   'category',
   'severity',
   'serverName',
    'location_id',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
