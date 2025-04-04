<?php

namespace App\Models\Api\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function baladiyas()
    {
        return $this->hasMany(Baladiya::class);
    }
}
