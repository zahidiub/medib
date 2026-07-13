<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_store_id',
        'bill_number',
        'patient_name',
        'bill_date',
    ];

    public function billDetails()
    {
        return $this->hasMany(BillDetail::class);
    }

    public function medicalStore()
    {
        return $this->belongsTo(MedicalStore::class);
    }
}