<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialNumberOut extends Model
{
    use HasFactory;

    protected $fillable = [
        "inventory_out_id" ,
        "serial",
    ];

    public function inventoryOut()
    {
        return $this->belongsTo(InventoryOut::class);
    }

}
