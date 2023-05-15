<?php

namespace App\Models\Live\GameArk;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $connection = 'mysqlGameark';

    public function question() {
        return $this->belongsTo(Question::class);
    }

}
