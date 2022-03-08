<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    protected $connection = 'mysqllive';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


}
