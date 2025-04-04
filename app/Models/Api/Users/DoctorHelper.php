<?php

namespace App\Models\Api\Users;

use App\Models\Api\Core\Key;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorHelper extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'name', 'last', 'date_of_birth', 'phone', 'email', 'doctor_id'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function photo()
    {
        return $this->morphOne(\App\Models\Api\Core\Photo::class, 'photoable');
    }

    public function key(){
        return $this->morphOne(Key::class , 'keyable');
    }
}
