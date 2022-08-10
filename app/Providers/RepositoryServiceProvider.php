<?php

namespace App\Providers;

use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\Admin\EloquentAdminRepository;
use App\Repositories\Answer\AnswerRepositoryInterface;
use App\Repositories\Answer\EloquentAnswerRepository;
use App\Repositories\Link\EloquentLinkRepository;
use App\Repositories\Link\LinkRepositoryInterface;
use App\Repositories\Permission\EloquentPermissionRepository;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Protest\EloquentProtestRepository;
use App\Repositories\Protest\ProtestRepositoryInterface;
use App\Repositories\Question\EloquentQuestionRepository;
use App\Repositories\Question\QuestionRepositoryInterface;
use App\Repositories\Role\EloquentRoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(LinkRepositoryInterface::class, EloquentLinkRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
