<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
        protected $connection = 'mysqllive';

        protected $fillable = [
                'wallet_id', 'transaction_type', 'amount', 'description', 'balance_type',
                'reference', 'balance','viable_date','settled_at', 'transaction_action'
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
