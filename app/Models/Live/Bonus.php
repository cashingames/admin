<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;
    protected $connection = 'mysqllive';

    protected $fillable = ['name', 'trigger', 'duration_count','duration_measurement'];

    public function userBonuses()
    {
        return $this->hasMany(UserBonus::class);
    }
}
