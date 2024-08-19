<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryIn extends Model
{
    use HasFactory;
    protected $fillable = [
        'part_id',
        'storage_location_id',
        'user_id',
        'supplier_id',
        'description',
        'quantity',
        'serials',
        'po_reference',
        'do_reference'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];


    public function part(): BelongsTo
    {
        return $this->belongsTo(Part::class);
    }

    public function storageLocation(): BelongsTo
    {
        return $this->belongsTo(StorageLocation::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
    public function inventoryCategory(): BelongsTo
    {
        return $this->belongsTo(InventoryCategory::class);
    }

}
