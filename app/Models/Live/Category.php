<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $connection = 'mysqllive';

  public function gameSessions()
  {
    return $this->hasMany(GameSession::class);
  }

  // public function gameTypes()
  // {
  //   return $this->hasMany(GameType::class);
  // }

  public function users()
  {
    return $this->belongsToMany(Category::class, 'game_sessions')->withPivot('points_gained', 'user_id');
  }
}
