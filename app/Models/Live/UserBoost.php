<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBoost extends Model
{
    protected $connection = 'mysqllive';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function boost()
    {
        return $this->belongsTo(Boost::class);
    }

}
