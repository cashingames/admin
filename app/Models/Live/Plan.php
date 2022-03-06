<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Plan extends Model
{
    protected $connection = 'mysqllive';

    public function gameSessions(){
        return $this->hasMany(GameSession::class);
    }
   
    

}
