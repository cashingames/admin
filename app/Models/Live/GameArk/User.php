<?php

namespace App\Models\Live\GameArk;

use Illuminate\Database\Eloquent\Model;
use App\Models\Live\Profile;
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

        public function challengeGameSessions()
        {
                return $this->hasMany(ChallengeGameSession::class);
        }

        
        public function plans()
        {
                return $this->hasMany(UserPlan::class);
        }

        public function initiatedChallenges()
        {
                return $this->hasMany(Challenge::class);
        }

        public function recievedChallenges()
        {
                return $this->hasMany(Challenge::class, 'opponent_id');
        }

        public function challenges()
        {
                return $this->initiatedChallenges()->union($this->recievedChallenges()->toBase());
        }
        
        public function notifications()
        {
            return $this->morphMany(UserNotification::class, 'notifiable')->orderBy('created_at', 'desc');
        }

}
