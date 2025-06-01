<?php

namespace App\Models\Api\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'current_demand_id', 'doctor_id'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('current_doctor', function ($builder) {
            if (Auth::check() && Auth::user()->key->keyable_type === 'doctor') {
                $builder->where('doctor_id', Auth::user()->key->keyable_id);
            }
        });
    }
    public function doctor()
    {
        return $this->belongsTo(\App\Models\Api\Users\Doctor::class);
    }

    public function demands()
    {
        return $this->hasMany(Demand::class);
    }
}
