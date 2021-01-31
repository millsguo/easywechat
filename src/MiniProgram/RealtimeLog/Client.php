<?php

declare(strict_types=1);

namespace EasyWeChat\MiniProgram\RealtimeLog;

use EasyWeChat\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * Real time log query.
     *
     * @param string $date
     * @param int    $beginTime
     * @param int    $endTime
     * @param array  $options
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(string $date, int $beginTime, int $endTime, array $options = [])
    {
        $params = [
            'date' => $date,
            'begintime' => $beginTime,
            'endtime' => $endTime,
        ];

        return $this->httpGet('wxaapi/userlog/userlog_search', $params + $options);
    }
}
