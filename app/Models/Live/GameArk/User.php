<?php

namespace App\Models\Live\GameArk;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{       
        use Notifiable;

        protected $connection = 'mysqlGameark';
        protected $with = [
                'profile'
        ];

        public function profile()
        {
                return $this->hasOne(Profile::class);
        }

        public function wallet()
        {
            return $this->hasOne(Wallet::class);
        }
    
        public function transactions()
        {
            return $this->hasManyThrough(WalletTransaction::class, Wallet::class);
        }

        public function gameSessions()
        {
                return $this->hasMany(GameSession::class);
        }
        public function plans()
        {
                return $this->hasMany(UserPlan::class);
        }
        
        public function notifications()
        {
            return $this->morphMany(UserNotification::class, 'notifiable')->orderBy('created_at', 'desc');
        }

}
