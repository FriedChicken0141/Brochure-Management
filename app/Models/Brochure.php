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
        'area_id',
        'quantity',
        'detail',
        'img_path',
        'updated_at',
    ];

    public function area()
    {
        // return $this->hasOne(Area::class,);
        return $this->belongsTo(Area::class);
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
