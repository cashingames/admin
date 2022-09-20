<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StakersView extends Model
{
    use HasFactory;

    protected $connection = 'mysqllive';
    protected $table = 'stakers_view';
}
