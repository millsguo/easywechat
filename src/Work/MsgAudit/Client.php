<?php

declare(strict_types=1);

namespace EasyWeChat\Work\MsgAudit;

use EasyWeChat\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * @param string|null $type
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getPermitUsers(string $type = null)
    {
        return $this->httpPostJson('cgi-bin/msgaudit/get_permit_user_list', (empty($type) ? [] : ['type' => $type]));
    }

    /**
     * @param array $info 数组，格式: [[userid, exteranalopenid], [userid, exteranalopenid]]
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSingleAgreeStatus(array $info)
    {
        $params = [
            'info' => $info
        ];

        return $this->httpPostJson('cgi-bin/msgaudit/check_single_agree', $params);
    }

    /**
     * @param  string  $roomId
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRoomAgreeStatus(string $roomId)
    {
        $params = [
            'roomid' => $roomId
        ];

        return $this->httpPostJson('cgi-bin/msgaudit/check_room_agree', $params);
    }

    /**
     * @param  string  $roomId
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRoom(string $roomId)
    {
        $params = [
            'roomid' => $roomId
        ];

        return $this->httpPostJson('cgi-bin/msgaudit/groupchat/get', $params);
    }
}
