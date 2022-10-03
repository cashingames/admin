<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StakingOdd extends Model
{
    protected $connection = 'mysqllive';
    //protected $table = 'odds_conditions_and_rules';
    protected $casts = [
        'active' => 'boolean',
      ];
}
