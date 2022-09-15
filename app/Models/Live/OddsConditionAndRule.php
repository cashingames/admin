<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OddsConditionAndRule extends Model
{
    protected $connection = 'mysqllive';
    protected $table = 'odds_conditions_and_rules';
}
