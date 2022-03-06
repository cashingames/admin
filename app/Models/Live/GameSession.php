<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    protected $connection = 'mysqllive';
    

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

}
