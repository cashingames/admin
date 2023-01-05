<?php

namespace App\Models\Live;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends DatabaseNotification
{
    use HasFactory;

    protected $connection = 'mysqllive';
    protected $table = "user_notifications";
}
