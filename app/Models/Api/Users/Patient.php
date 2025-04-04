<?php

namespace App\Models\Api\Users;

use App\Models\Api\Core\Key;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'name', 'last', 'date_of_birth', 'phone', 'email',
        'baladiya_id', 'description'
    ];

    public function baladiya()
    {
        return $this->belongsTo(\App\Models\Api\Core\Baladiya::class);
    }

    public function photo()
    {
        return $this->morphOne(\App\Models\Api\Core\Photo::class, 'photoable');
    }


    public function key(){
        return $this->morphOne(Key::class , 'keyable');
    }
}
