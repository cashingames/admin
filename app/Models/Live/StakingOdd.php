<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StakingOdd extends Model
{
    protected $connection = 'mysqllive';
  
    protected $casts = [
        'active' => 'boolean',
      ];
}
