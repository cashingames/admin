<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;

class GameMode extends Model
{
    protected $connection = 'mysqllive';

    public function gameSessions(){
        return $this->hasMany(GameSession::class);
    }
}
