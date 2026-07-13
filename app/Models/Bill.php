<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_store_id',
        'patient_id',
        'receipt_no',
        'date',
    ];

    public function billDetails()
    {
        return $this->hasMany(BillDetail::class);
    }

    public function medicalStore()
    {
        return $this->belongsTo(MedicalStore::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function grossTotal()
    {
        return $this->billDetails->sum('total_price');
    }
}
