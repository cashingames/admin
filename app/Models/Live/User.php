<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;
use App\Models\Live\Profile;

class User extends Model
{
        protected $connection = 'mysqllive';

        public function profile()
        {
                return $this->hasOne(Profile::class);
        }

        public function gameSessions()
        {
                return $this->hasMany(GameSession::class);
        }
}
