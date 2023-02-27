<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchievementBadge extends Model
{
    use HasFactory;
    protected $connection = 'mysqllive';

    protected $fillable = ['title', 'milestone_type', 'milestone', 'milestone_count', 'reward_type', 'reward','description', 'medal', 'quality_image'];

    public function userAchievementBadges()
    {
        return $this->hasMany(UserAchievementBadge::class);
    }
}
