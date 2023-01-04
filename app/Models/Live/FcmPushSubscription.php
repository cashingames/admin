<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FcmPushSubscription extends Model
{
    use HasFactory;

    protected $connection = 'mysqllive';

    protected $guarded = [];
}
