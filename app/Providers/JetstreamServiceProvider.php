<?php

namespace App\Providers;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\InviteTeamMember;
use App\Actions\Jetstream\RemoveTeamMember;
use App\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', 'Administrator', [
            'create',
            'read',
            'update',
            'delete',
            'cms:view',
            'cms:publish',
            'finance:view',
            'cms:approve',
            'cms:reject',
            'cms:delete',
            'cms:update',
            'gaming:view',
            'users:view'
        ])->description('Administrator users can perform any action.');

        Jetstream::role('editor', 'Editor', [
            'read',
            'create',
            'update',
            'cms:view',
            'gaming:view',
            'users:view'
        ])->description('Editor users have the ability to read, create, and update.');

        Jetstream::role('moderator', 'Moderator', [
            'read',
            'create',
            'update',
            'cms:view',
            'cms:publish',
            'gaming:view',
            'users:view'
        ])->description('Moderator users have the ability to perform moderation actions and additionally publish any content.');

        Jetstream::role('content-creator', 'Content Creator', [
            'cms:read',
            'cms:create',
            'cms:update',
            'cms:delete',
        ])->description('Content Creators have the ability to read, create, and update their own content.');

        Jetstream::role('content-admin', 'Content Administrator', [
            'cms:read',
            'cms:create',
            'cms:update',
            'cms:delete',
            'cms:publish',
            'cms:approve',
            'cms:reject',
            'cms:view'
        ])->description('Content Administrators have the ability to read, create, update and publish any cms content.');

    }
}
