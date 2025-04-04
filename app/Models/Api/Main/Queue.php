<?php

namespace App\Models\Api\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'current_demand_id', 'doctor_id'];

    public function doctor()
    {
        return $this->belongsTo(\App\Models\Api\Users\Doctor::class);
    }
}
