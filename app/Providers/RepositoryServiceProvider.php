<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\AdminContract;
use App\Repositories\AdminRepository;
use App\Contracts\UserContract;
use App\Repositories\UserRepository;
use App\Contracts\BannerContract;
use App\Repositories\BannerRepository;
use App\Contracts\FaqContract;
use App\Repositories\FaqRepository;
use App\Contracts\NewsContract;
use App\Repositories\NewsRepository;
use App\Contracts\IndustryContract;
use App\Repositories\IndustryRepository;
use App\Contracts\SeniorityContract;
use App\Repositories\SeniorityRepository;
use App\Contracts\MentorContract;
use App\Repositories\MentorRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        AdminContract::class        =>    AdminRepository::class,
        UserContract::class         =>    UserRepository::class,
        BannerContract::class       =>    BannerRepository::class,
        FaqContract::class          =>    FaqRepository::class,
        NewsContract::class         =>    NewsRepository::class,
        IndustryContract::class     =>    IndustryRepository::class,
        SeniorityContract::class    =>    SeniorityRepository::class,
        MentorContract::class       =>    MentorRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
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
