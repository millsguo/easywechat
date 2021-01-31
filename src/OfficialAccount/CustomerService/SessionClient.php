<?php

declare(strict_types=1);

namespace EasyWeChat\OfficialAccount\CustomerService;

use EasyWeChat\Kernel\BaseClient;

class SessionClient extends BaseClient
{
    /**
     * List all sessions of $account.
     *
     * @param string $account
     *
     * @return mixed
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function list(string $account)
    {
        return $this->httpGet('customservice/kfsession/getsessionlist', ['kf_account' => $account]);
    }

    /**
     * List all the people waiting.
     *
     * @return mixed
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function waiting()
    {
        return $this->httpGet('customservice/kfsession/getwaitcase');
    }

    /**
     * Create a session.
     *
     * @param string $account
     * @param string $openid
     *
     * @return mixed
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(string $account, string $openid)
    {
        $params = [
            'kf_account' => $account,
            'openid' => $openid,
        ];

        return $this->httpPostJson('customservice/kfsession/create', $params);
    }

    /**
     * Close a session.
     *
     * @param string $account
     * @param string $openid
     *
     * @return mixed
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function close(string $account, string $openid)
    {
        $params = [
            'kf_account' => $account,
            'openid' => $openid,
        ];

        return $this->httpPostJson('customservice/kfsession/close', $params);
    }

    /**
     * Get a session.
     *
     * @param string $openid
     *
     * @return mixed
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function get(string $openid)
    {
        return $this->httpGet('customservice/kfsession/getsession', ['openid' => $openid]);
    }
}
