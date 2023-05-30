<?php

namespace App\Models\Live\GameArk;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Plan extends Model
{
    protected $connection = 'mysqlGameark';

    public function gameSessions(){
        return $this->hasMany(GameSession::class);
    }
   
    

}
