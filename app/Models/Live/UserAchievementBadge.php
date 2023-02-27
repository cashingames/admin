<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAchievementBadge extends Model
{
    use HasFactory;
    protected $connection = 'mysqllive';

    public function userAchievementBadges()
    {
        return $this->belongsTo(AchievementBadge::class);
    }
}
