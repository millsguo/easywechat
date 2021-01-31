<?php

declare(strict_types=1);

namespace EasyWeChat\Payment\Transfer;

use EasyWeChat\Kernel\Exceptions\RuntimeException;
use EasyWeChat\Payment\Kernel\BaseClient;
use function EasyWeChat\Kernel\Support\get_server_ip;
use function EasyWeChat\Kernel\Support\rsa_public_encrypt;

class Client extends BaseClient
{
    /**
     * Query MerchantPay to balance.
     *
     * @param string $partnerTradeNo
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function queryBalanceOrder(string $partnerTradeNo)
    {
        $params = [
            'appid' => $this->app['config']->app_id,
            'mch_id' => $this->app['config']->mch_id,
            'partner_trade_no' => $partnerTradeNo,
        ];

        return $this->safeRequest('mmpaymkttransfers/gettransferinfo', $params);
    }

    /**
     * Send MerchantPay to balance.
     *
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function toBalance(array $params)
    {
        $base = [
            'mch_id' => null,
            'mchid' => $this->app['config']->mch_id,
            'mch_appid' => $this->app['config']->app_id,
        ];

        if (empty($params['spbill_create_ip'])) {
            $params['spbill_create_ip'] = get_server_ip();
        }

        return $this->safeRequest('mmpaymkttransfers/promotion/transfers', array_merge($base, $params));
    }

    /**
     * Query MerchantPay order to BankCard.
     *
     * @param string $partnerTradeNo
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function queryBankCardOrder(string $partnerTradeNo)
    {
        $params = [
            'mch_id' => $this->app['config']->mch_id,
            'partner_trade_no' => $partnerTradeNo,
        ];

        return $this->safeRequest('mmpaysptrans/query_bank', $params);
    }

    /**
     * Send MerchantPay to BankCard.
     *
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function toBankCard(array $params)
    {
        foreach (['bank_code', 'partner_trade_no', 'enc_bank_no', 'enc_true_name', 'amount'] as $key) {
            if (empty($params[$key])) {
                throw new RuntimeException(\sprintf('"%s" is required.', $key));
            }
        }

        $publicKey = file_get_contents($this->app['config']->get('rsa_public_key_path'));

        $params['enc_bank_no'] = rsa_public_encrypt($params['enc_bank_no'], $publicKey);
        $params['enc_true_name'] = rsa_public_encrypt($params['enc_true_name'], $publicKey);

        return $this->safeRequest('mmpaysptrans/pay_bank', $params);
    }
}
