<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boost extends Model
{
    protected $connection = 'mysqllive';

    public function exhibitionBoosts()
    {
      return $this->hasMany(ExhibitionBoost::class);
    }
    

}
