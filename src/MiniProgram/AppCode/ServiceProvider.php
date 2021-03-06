<?php

declare(strict_types=1);

namespace EasyWeChat\MiniProgram\AppCode;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['app_code'] = function ($app) {
            return new Client($app);
        };
    }
}
