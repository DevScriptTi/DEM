<?php

namespace App\Models\Api\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'prescription_id'];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
