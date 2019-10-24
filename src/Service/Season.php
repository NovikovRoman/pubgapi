<?php

namespace PubgApi\Service;

use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use PubgApi\Exception\ExceptionNotFound;
use PubgApi\Exception\ExceptionTooManyRequests;
use PubgApi\Exception\ExceptionUnauthorized;
use PubgApi\Exception\ExceptionUnsupported;

class Season extends AbstractService
{
    const url = '/seasons';

    /**
     * @return array
     * @throws GuzzleException
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     */
    public function list()
    {
        return $this->requestGet(self::url);
    }

    /**
     * @param string $seasonId
     * @param string $gameMode
     * @param array $playerIds
     * @return array
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     * @throws GuzzleException
     */
    public function players(string $seasonId, string $gameMode, array $playerIds)
    {
        if (count($playerIds) > 10) {
            throw new InvalidArgumentException('Too many ids. No more than 10.');
        }

        $url = self::url . '/seasons/:seasonId/gameMode/:gameMode/players';
        return $this->requestGet($url,
            ['seasonId' => $seasonId, 'gameMode' => $gameMode],
            ['filter[playerIds]' => implode(',', $playerIds)]);
    }

    /**
     * @param string $gameMode
     * @param array $playerIds
     * @return array
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     * @throws GuzzleException
     */
    public function lifetime(string $gameMode, array $playerIds)
    {
        if (count($playerIds) > 10) {
            throw new InvalidArgumentException('Too many ids. No more than 10.');
        }

        $url = self::url . '/seasons/lifetime/gameMode/:gameMode/players';
        return $this->requestGet($url, ['gameMode' => $gameMode], ['filter[playerIds]' => implode(',', $playerIds)]);
    }
}