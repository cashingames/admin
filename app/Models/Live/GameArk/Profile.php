<?php

namespace App\Models\Live\GameArk;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
        protected $connection = 'mysqlGameark';
        protected $appends = ['full_name'];

        public function getFullNameAttribute(){
                return $this->first_name;
        }
}
