<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'contact',
        'email',
        'adress_1',
        'adress_2',
        'city',
        'state',
        'zip_code',
        'country',

    ];
}
