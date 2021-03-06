<?php

declare(strict_types=1);

namespace EasyWeChat\MiniProgram\Auth;

use EasyWeChat\Kernel\AccessToken as BaseAccessToken;

class AccessToken extends BaseAccessToken
{
    /**
     * @var string
     */
    protected string  $endpointToGetToken = 'https://api.weixin.qq.com/cgi-bin/token';

    /**
     * {@inheritdoc}
     */
    protected function getCredentials(): array
    {
        return [
            'grant_type' => 'client_credential',
            'appid' => $this->app['config']['app_id'],
            'secret' => $this->app['config']['secret'],
        ];
    }
}
