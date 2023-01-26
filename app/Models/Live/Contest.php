<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $connection = 'mysqllive';
    
    protected $fillable = [
        'start_date', 'end_date', 'description',
        'name', 'display_name', 'contest_type', 'entry_mode'
    ];

    public function contestPrizePools()
    {
      return $this->hasMany(ContestPrizePool::class);
    }

    public function trivia(){
        return $this->hasMany(Trivia::class);
    }
}