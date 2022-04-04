<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameType extends Model
{
    use SoftDeletes;

    protected $connection = 'mysqllive';


    protected $fillable = ['name', 'description', 'instruction', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // public function IsEnabled()
    // {
    //     $hasQuestions = Question::where('game_type_id', $this->id)->first();

    //     if ($hasQuestions === null) {
    //         return false;
    //     }
    //     return true;
    // }
}
