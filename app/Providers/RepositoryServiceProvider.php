<?php

namespace App\Providers;

use App\Repository\IRepositories\UserIRepository;
use App\Repository\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\IRepositories\MemeIRepository;
use App\Repository\IRepositories\CategoryIRepository;
use App\Repository\IRepositories\EditRequestIRepository;
use App\Repository\IRepositories\VoteIRepository;
use App\Repository\IRepositories\MemeReportIRepository;
use App\Repository\IRepositories\UserNotificationIRepository;
use App\Repository\Repositories\MemeRepository;
use App\Repository\Repositories\CategoryRepository;
use App\Repository\Repositories\CommentRepository;
use App\Repository\Repositories\EditRequestRepository;
use App\Repository\Repositories\VoteRepository;
use App\Repository\Repositories\MemeReportRepository;
use App\Repository\Repositories\UserNotificationRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    public $bindings = [
        MemeIRepository::class => MemeRepository::class,
        CategoryIRepository::class => CategoryRepository::class,
        EditRequestIRepository::class => EditRequestRepository::class,
        MemeReportIRepository::class => MemeReportRepository::class, 
        UserNotificationIRepository::class => UserNotificationRepository::class,
        UserIRepository::class => UserRepository::class, 
        VoteIRepository::class => VoteRepository::class
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(MemeIRepository::class, MemeRepository::class);
        // $this->app->bind(CategoryIRepository::class, CategoryRepository::class);
        // $this->app->bind(EditRequestIRepository::class, EditRequestRepository::class);
        // $this->app->bind(MemeReportIRepository::class, MemeReportRepository::class);
        // $this->app->bind(UserNotificationIRepository::class, UserNotificationRepository::class);
        // $this->app->bind(UserIRepository::class, UserRepository::class);
        // $this->app->bind(VoteIRepository::class, VoteRepository::class);
    }
}
