<?php

namespace App\Models\Live\GameArk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryQuestion extends Model
{
    use HasFactory;
    protected $connection = 'mysqlGameark';
    protected $table = 'categories_questions';

    protected $fillable = ['category_id','question_id'];
}
