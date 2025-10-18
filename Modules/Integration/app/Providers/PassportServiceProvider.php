<?php

namespace Modules\Integration\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use League\OAuth2\Server\AuthorizationServer;
use Modules\Integration\Passport\CustomClientCredentialsGrant;

class PassportServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->afterResolving(AuthorizationServer::class, function (AuthorizationServer $server) {
            $grant = new CustomClientCredentialsGrant;
            $server->enableGrantType(
                $grant,
                Passport::tokensExpireIn()
            );
        });
    }
}
