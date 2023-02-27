<?php

namespace App\Http\Livewire\Gaming;

use Livewire\Component;
use App\Models\Live\AchievementBadge;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;

class UserAchievementBadges extends LivewireDatatable
{

    public $persistPerPage = false;
    public $persistSearch = false;
    public $persistSort = false;
    public $persistFilters = false;
    public $complex = true;
    const TIMEZONE = 'Africa/Lagos';

    public function builder()
    {
        $livedb = config('database.connections.mysqllive.database');

        return AchievementBadge::query()
            ->join("{$livedb}.user_achievement_badges", "user_achievement_badges.achievement_badge_id", "=", "achievement_badges.id")
            ->join("{$livedb}.users", "users.id", "=", "user_achievement_badges.user_id")
            ->where('user_achievement_badges.is_claimed', true);
    }

    public function columns()
    {
        return
            [
                Column::index($this),

                Column::name('achievement_badges.title')->searchable()->filterable(),

                Column::name('users.username')->searchable()->filterable(),

                Column::name('users.phone_number')->searchable()->hideable(),

                Column::name('users.email')->searchable()->hideable(),

                DateColumn::name('achievement_badges.updated_at')->label('Earned At')->filterable()->hideable(),

                DateColumn::name('users.created_at')->label("Joined On")->filterable()->hideable(),



            ];
    }
}
