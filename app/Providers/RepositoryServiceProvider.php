<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\IRepositories\CommentIRepository;
use App\Repository\IRepositories\EditRequestIRepository;
use App\Repository\IRepositories\MemeReportIRepository;
use App\Repository\IRepositories\UserNotificationIRepository;
use App\Repository\Repositories\CommentRepository;
use App\Repository\Repositories\EditRequestRepository;
use App\Repository\Repositories\MemeReportRepository;
use App\Repository\Repositories\UserNotificationRepository;

class RepositoryServiceProvider extends ServiceProvider
{
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
        $this->app->bind(CommentIRepository::class, CommentRepository::class);
        $this->app->bind(EditRequestIRepository::class, EditRequestRepository::class);
        $this->app->bind(MemeReportIRepository::class, MemeReportRepository::class);
        $this->app->bind(UserNotificationIRepository::class, UserNotificationRepository::class);
    }
}
