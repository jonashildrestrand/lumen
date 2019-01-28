<?php

namespace App\Services\JWT;

use App\Services\JWT\Contracts\JWTInterface;
use App\Services\JWT\Contracts\JWTRepository;
use Illuminate\Support\ServiceProvider;

class JWTServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(JWTInterface::class, function() {
            return $this->app->make(JWTRepository::class);
        });
    }
}