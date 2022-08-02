<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class Challenge extends Model
{
    use HasFactory;

    protected $connection = 'mysqllive';

    protected $fillable = ['category_id', 'user_id', 'opponent_id', 'status'];

    public function users()
    {

        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function opponent()
    {
        return $this->belongsTo(User::class, 'opponent_id', 'id');
    }

    public function challengeGameSessions()
    {
        return $this->hasMany(ChallengeGameSession::class);
    }

}
