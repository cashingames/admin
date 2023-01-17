<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trivia extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysqllive';
    protected $table = 'trivias';
    protected $casts = ['is_published' => 'boolean'];
    protected $fillable = ['name' ,'category_id','game_type_id','game_mode_id','grand_price','point_eligibility', 'start_time', 'end_time'];

    public function category(){
       return $this->belongsTo(Category::class);
    }

    public function triviaQuestions(){
        return $this->hasMany( TriviaQuestion::class);
    }

    public function gameSessions(){
        return $this->hasMany(GameSession::class);
    }

    public function contest(){
        return $this->belongsTo(Contest::class);
    }

   

}
