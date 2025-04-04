<?php

namespace App\Models\Api\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baladiya extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'wilaya_id'];

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }
}
