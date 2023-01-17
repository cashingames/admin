<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestPrizePool extends Model
{
    use HasFactory;

    protected $fillable = [
        'rank_from', 'rank_to', 'prize', 'prize_type', 'contest_id'
    ];

    public function contest(){
        return $this->belongsTo(Contest::class);
    }
}
