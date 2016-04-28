<?php namespace Roomz\Dropbox\Providers;

use Illuminate\Support\ServiceProvider;
use Roomz\Dropbox\Auth\AuthRepository;
use Roomz\Dropbox\Client\ClientRepository;

class RoomzDropboxServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->setupContainerBinding();
    }

    public function setupContainerBinding()
    {
        $this->app->bind('Roomz\Dropbox\Auth\AuthRepositoryInterface', function ($app) {
            return $app['roomz.dropbox.auth'];
        });

        $this->app->bind('Roomz\Dropbox\Client\ClientRepositoryInterface', function ($app) {
            return $app['roomz.dropbox.client'];
        });
    }

    public function register()
    {
        $this->registerAuth();
    }

    protected function registerAuth()
    {
        $this->app->bind('roomz.dropbox.auth', function ($app) {
            return new AuthRepository(
                $app['events']
            );
        });
    }
}
