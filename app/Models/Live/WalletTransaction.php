<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
        protected $connection = 'mysqllive';
        public function wallet()
        {
                return $this->belongsTo(Wallet::class);
        }

        public function owner()
        {
                return $this->belongsTo(User::class);
        }
}
