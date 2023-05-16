<?php

namespace App\Models\Live\GameArk;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $connection = 'mysqlGameark';
  

  public function users()
  {
    return $this->belongsToMany(Category::class, 'game_sessions')->withPivot('points_gained', 'user_id');
  }

  // public function questions()
  // {
  //     return $this->belongsToMany(Question::class, 'categories_questions')->withPivot('is_published','deleted_at');
  // }

  public function questions()
  {
    return $this->belongsToMany(Question::class, 'categories_questions')->withTimestamps();
  }

  public function scopeParentCategories($query)
  {
    return $query->where('category_id', 0);
  }

  public function scopeSubcategories($query)
  {
    return $query->where('category_id', '!=', 0);
  }

  public function publishedQuestions()
  {
    return $this->questions()->where('questions.is_published', true)->count();
  }

  public function unPublishedQuestions()
  {
    return $this->questions()->where('questions.is_published', false)->count();
  }
  public function easyQuestions()
  {
    return $this->questions()->where('questions.level', 'easy')->count();
  }
  public function mediumQuestions()
  {
    return $this->questions()->where('questions.level', 'medium')->count();
  }
  public function hardQuestions()
  {
    return $this->questions()->where('questions.level', 'hard')->count();
  }
  public function expertQuestions()
  {
    return $this->questions()->where('questions.level', 'expert')->count();
  }
}
