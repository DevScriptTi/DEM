<?php

namespace App\Models\Api\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'pharmacy_id', 'doctor_id', 'patient_id'];

    public function pharmacy()
    {
        return $this->belongsTo(\App\Models\Api\Users\Pharmacy::class);
    }

    public function doctor()
    {
        return $this->belongsTo(\App\Models\Api\Users\Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(\App\Models\Api\Users\Patient::class);
    }

    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }
}
