<?php

declare(strict_types=1);

namespace EasyWeChat\OpenPlatform\Component;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['component'] = function ($app) {
            return new Client($app);
        };
    }
}
