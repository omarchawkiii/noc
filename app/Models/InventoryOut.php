<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'storage_location_id',
        'cinema_location_id',
        'user_id',
        'approved_by_id',
        'quantity',
        'serials',
        'date_out',
        'approved_date',

    ];


    public function part(): BelongsTo
    {
        return $this->belongsTo(Part::class);
    }

    public function storageLocation(): BelongsTo
    {
        return $this->belongsTo(StorageLocation::class);
    }

    public function CinemaLocation(): BelongsTo
    {
        return $this->belongsTo(CinemaLocation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'approved_by_id');
    }

    public function SerialNumberOuts()
    {
        return $this->hasMany(SerialNumberOut::class);
    }

}
