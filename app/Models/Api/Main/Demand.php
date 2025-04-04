<?php

namespace App\Models\Api\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'status', 'queue_id', 'patient_id'];

    public function patient()
    {
        return $this->belongsTo(\App\Models\Api\Users\Patient::class);
    }

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
}
