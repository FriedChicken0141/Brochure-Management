<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brochure extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'area',
        'quantity',
        'detail',
        'updated_at',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class,'area','id');
    }
}

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var array<int, string>
//      */
//     protected $hidden = [
//     ];

//     /**
//      * The attributes that should be cast.
//      *
//      * @var array<string, string>
//      */
//     protected $casts = [
//     ];
// }
