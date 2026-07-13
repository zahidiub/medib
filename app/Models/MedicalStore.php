<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalStore extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_number',
        'address',
        'name',
        'phone_number',
    ];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}