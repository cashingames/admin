<?php

namespace App\Models\live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameSessionQuestion extends Model
{
    use HasFactory;

    public function gameSession(){
        return $this->belongsTo(GameSession::class);
    }
   
}
