<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        "inventory_in_id" ,
        "serial",
    ];

    public function inventoryIn()
    {
        return $this->belongsTo(InventoryIn::class);
    }
}
