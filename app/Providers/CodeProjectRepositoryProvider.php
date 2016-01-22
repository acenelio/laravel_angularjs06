<?php

namespace CodeProject\Providers;

use Illuminate\Support\ServiceProvider;

class CodeProjectRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(
            \CodeProject\Repositories\ClientRepository::class,
            \CodeProject\Repositories\ClientRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeProject\Repositories\UserRepository::class,
            \CodeProject\Repositories\UserRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeProject\Repositories\ProjectRepository::class,
            \CodeProject\Repositories\ProjectRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeProject\Repositories\ProjectTaskRepository::class,
            \CodeProject\Repositories\ProjectTaskRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeProject\Repositories\ProjectMemberRepository::class,
            \CodeProject\Repositories\ProjectMemberRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeProject\Repositories\ProjectFileRepository::class,
            \CodeProject\Repositories\ProjectFileRepositoryEloquent::class
        );

    }
}
