<?php

namespace App\Models\Api\Users;

use App\Models\Api\Core\Key;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'name', 'last', 'date_of_birth', 'phone', 'email',
        'baladiya_id', 'speciality_id', 'description', 'status'
    ];

    public function baladiya()
    {
        return $this->belongsTo(\App\Models\Api\Core\Baladiya::class);
    }

    public function speciality()
    {
        return $this->belongsTo(\App\Models\Api\Core\Speciality::class);
    }

    public function photo()
    {
        return $this->morphOne(\App\Models\Api\Core\Photo::class, 'photoable');
    }


    public function key(){
        return $this->morphOne(Key::class , 'keyable');
    }
}
