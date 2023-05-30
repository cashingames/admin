<?php

namespace App\Models\Live\GameArk;

use App\Models\live\GameSessionQuestion;
use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    protected $connection = 'mysqlGameark';
    

    public function mode()
    {
        return $this->belongsTo(GameMode::class, 'game_mode_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function gameSessionQuestions(){
        return $this->hasMany(GameSessionQuestion::class);
    }
    public function questions()
    {
        return $this->hasManyThrough(Question::class, GameSessionQuestion::class);
    }

    public function exhibitionBoosts()
    {
      return $this->hasMany(ExhibitionBoost::class);
    }
}
