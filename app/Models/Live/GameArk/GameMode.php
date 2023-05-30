<?php

namespace App\Models\Live\GameArk;

use Illuminate\Database\Eloquent\Model;

class GameMode extends Model
{
    protected $connection = 'mysqlGameark';

    public function gameSessions(){
        return $this->hasMany(GameSession::class);
    }
}
