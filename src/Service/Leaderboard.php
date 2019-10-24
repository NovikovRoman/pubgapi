<?php

namespace PubgApi\Service;

use GuzzleHttp\Exception\GuzzleException;
use PubgApi\Exception\ExceptionNotFound;
use PubgApi\Exception\ExceptionTooManyRequests;
use PubgApi\Exception\ExceptionUnauthorized;
use PubgApi\Exception\ExceptionUnsupported;

class Leaderboard extends AbstractService
{
    const url = '/leaderboards';

    /**
     * @param string $gameMode
     * @return array
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     * @throws GuzzleException
     */
    public function getId(string $gameMode)
    {
        $url = self::url . '/:gameMode';
        return $this->requestGet($url, ['gameMode' => $gameMode]);
    }
}