<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'area_name',
    ];

    public function brochures()
    {
        return $this -> hasMany(Brochure::class,'area','id');
    }
}
