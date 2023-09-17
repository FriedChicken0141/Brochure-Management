<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

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
        'img_public_id',
        'updated_at',
    ];

    use Sortable;
    public $sortable = [
        'id','area_id','quantity','updated_at',
    ];

    public function area()
    {
        // return $this->hasOne(Area::class,);
        return $this->belongsTo(Area::class);
    }

    // 作成日時と更新日時のカラムを更新
    public $timestamps = true;
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
