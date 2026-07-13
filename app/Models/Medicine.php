<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_name',
        'unit_price',
    ];

    public function billDetails()
    {
        return $this->hasMany(BillDetail::class);
    }
}
