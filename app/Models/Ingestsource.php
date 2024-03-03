<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingestsource extends Model
{
    use HasFactory;
    protected $fillable = [
        'defaultlocation_add_form',
        'usb_content_add_form',
        'defaultContent_add_form',
        'serverName',
        'server_ip',
        'ingestProtocol',
        'usernameServer',
        'passwordServer',
        'path',
    ];


}
