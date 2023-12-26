<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskusage extends Model
{
    use HasFactory;

    protected $fillable = [
        'session',
        'type',
        'totalSpaceFormatted',
        'usedSpaceFormatted',
        'cpls_complete',
        'cpls_incomplete',
        'Kdms_expired',
        'Kdms_not_valid',
        'Kdms_valid',
        'splCount',
        'free_space_percentage',
        'location_id',
    ];



}
