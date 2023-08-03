<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;
use App\Models\Live\Profile;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
        use Notifiable;

        protected $connection = 'mysqllive';
        protected $with = [
                'profile'
        ];

        protected $casts = [
                'meta_data' => 'array',
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
