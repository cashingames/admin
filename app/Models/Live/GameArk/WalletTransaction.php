<?php

namespace App\Models\Live\GameArk;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
        protected $connection = 'mysqlGameark';

        protected $fillable = [
                'wallet_id', 'transaction_type', 'amount', 'description', 
                'reference', 'balance','viable_date','settled_at'
            ];
        
        public function wallet()
        {
                return $this->belongsTo(Wallet::class);
        }

        public function owner()
        {
                return $this->belongsTo(User::class);
        }
}
