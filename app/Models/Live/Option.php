<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $connection = 'mysqllive';

    public function question() {
        return $this->belongsTo(Question::class);
    }

}
