<?php

declare(strict_types=1);

namespace EasyWeChat\MiniProgram\NearbyPoi;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['nearby_poi'] = function ($app) {
            return new Client($app);
        };
    }
}
