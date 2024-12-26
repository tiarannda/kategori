<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider; // Pastikan ini diimpor
use Illuminate\Support\Facades\Storage;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;
use League\Flysystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Storage::extend('dropbox', function ($app, $config) {
            $client = new Client($config['authorization_token']);
            $adapter = new DropboxAdapter($client);

            return new \League\Flysystem\Filesystem($adapter);
        });
    }
}
