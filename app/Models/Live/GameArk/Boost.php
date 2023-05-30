<?php

namespace App\Models\Live\GameArk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boost extends Model
{
    protected $connection = 'mysqlGameark';

    public function exhibitionBoosts()
    {
      return $this->hasMany(ExhibitionBoost::class);
    }
    

}
