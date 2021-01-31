<?php

declare(strict_types=1);

namespace EasyWeChat\OpenWork;

use EasyWeChat\Kernel\ServiceContainer;
use EasyWeChat\OpenWork\Work\Application as Work;

/**
 * Application.
 *
 *
 * @property \EasyWeChat\OpenWork\Server\Guard            $server
 * @property \EasyWeChat\OpenWork\Corp\Client             $corp
 * @property \EasyWeChat\OpenWork\Provider\Client         $provider
 * @property \EasyWeChat\OpenWork\SuiteAuth\AccessToken   $suite_access_token
 * @property \EasyWeChat\OpenWork\Auth\AccessToken        $provider_access_token
 * @property \EasyWeChat\OpenWork\SuiteAuth\SuiteTicket   $suite_ticket
 * @property \EasyWeChat\OpenWork\MiniProgram\Auth\Client $mini_program
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected array $providers = [
        Auth\ServiceProvider::class,
        SuiteAuth\ServiceProvider::class,
        Server\ServiceProvider::class,
        Corp\ServiceProvider::class,
        Provider\ServiceProvider::class,
        MiniProgram\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected array $defaultConfig = [
        // http://docs.guzzlephp.org/en/stable/request-options.html
        'http' => [
            'base_uri' => 'https://qyapi.weixin.qq.com/',
        ],
    ];

    /**
     * Creates the miniProgram application.
     *
     * @return \EasyWeChat\Work\MiniProgram\Application
     */
    public function miniProgram(): \EasyWeChat\Work\MiniProgram\Application
    {
        return new \EasyWeChat\Work\MiniProgram\Application($this->getConfig());
    }

    /**
     * @param string $authCorpId    企业 corp_id
     * @param string $permanentCode 企业永久授权码
     *
     * @return Work
     */
    public function work(string $authCorpId, string $permanentCode): Work
    {
        return new Work($authCorpId, $permanentCode, $this);
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this['base']->$method(...$arguments);
    }
}
