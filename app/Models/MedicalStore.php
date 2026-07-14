<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalStore extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sub_name',
        'license_no',
        'address',
        'phone',
        'bottom_content',
    ];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
