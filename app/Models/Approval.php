<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Approval extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'brochure_id',
        'quantity',
        'detail',
        'status',
        'created_at',
        'updated_at',
    ];

    use Sortable;
    public $sortable = [
        'created_at','updated_at'
    ];

    public function brochure()
    {
        return $this -> belongsTo(Brochure::class);
    }

    public function user()
    {
        return $this -> belongsTo(user::class);
    }
}

