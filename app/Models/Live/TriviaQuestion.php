<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TriviaQuestion extends Model
{
    use HasFactory;
    protected $connection = 'mysqllive';
    
    protected $fillable = ['question_id','trivia_id'];

    public function trivia()
    {
      return $this->belongsTo(Trivia::class);
    }

    public function question()
    {
      return $this->belongsTo(Question::class);
    }
}
