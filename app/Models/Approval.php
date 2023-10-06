<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'brochure_id',
        'quantity',
        'detail',
        'status',
    ];

    public function brochure()
    {
        return $this -> belongsTo(Brochure::class,'brochure_id');
    }

    public function user()
    {
        return $this -> belongsTo(user::class,'user_id');
    }
}

