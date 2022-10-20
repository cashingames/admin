<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StakingOddsRule extends Model
{
    use HasFactory;

    protected $connection = 'mysqllive';
    protected $guarded = [];

    protected $table = "staking_odds_rules";
}
