<?php

namespace PubgApi\Service;

use PubgApi\Exception\ExceptionNotFound;
use PubgApi\Exception\ExceptionTooManyRequests;
use PubgApi\Exception\ExceptionUnauthorized;
use PubgApi\Exception\ExceptionUnsupported;
use PubgApi\PubgClient;
use GuzzleHttp\Exception\GuzzleException;

abstract class AbstractService implements ServiceInterface
{
    /** @var PubgClient */
    protected $pubgClient;

    public function __construct(PubgClient $pubgClient)
    {
        $this->pubgClient = $pubgClient;
    }

    /**
     * @param $url
     * @param array $vars
     * @param array $params
     * @return array
     * @throws GuzzleException
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     */
    protected function requestGet($url, $vars = [], $params = [])
    {
        $resp = $this->pubgClient->requestGet($url, $vars, $params);

        return json_decode($resp->getBody()->getContents(), true);
    }
}