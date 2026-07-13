<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'medicine_id',
        'quantity',
        'unit_price',
        'total_price',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
