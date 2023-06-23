<?php

namespace App\Providers;

use App\Repository\GraduatedRepository;
use App\Repository\GraduatedRepositoryInterface;
use App\Repository\PromotionRepository;
use App\Repository\PromotionRepositoryInterface;
use App\Repository\StudentRepository;
use App\Repository\StudentRepositoryInterface;
use App\Repository\TeacherRepository;
use App\Repository\TeacherRepositoryInterface;
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
        //
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(PromotionRepositoryInterface::class, PromotionRepository::class);
        $this->app->bind(GraduatedRepositoryInterface::class, GraduatedRepository::class);

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
