<?php

namespace App\Models\Api\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    public function photoable()
    {
        return $this->morphTo();
    }
}
