<?php

namespace App\Models\Api\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'doctor_id', 'patient_id'];

    public function doctor()
    {
        return $this->belongsTo(\App\Models\Api\Users\Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(\App\Models\Api\Users\Patient::class);
    }
}
