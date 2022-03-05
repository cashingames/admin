<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
        protected $connection = 'mysqllive';
        protected $appends = ['full_name'];

        public function getFullNameAttribute(){
                return $this->first_name;
        }
}
