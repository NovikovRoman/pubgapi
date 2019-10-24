<?php

namespace PubgApi\Service;

use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use PubgApi\Exception\ExceptionNotFound;
use PubgApi\Exception\ExceptionTooManyRequests;
use PubgApi\Exception\ExceptionUnauthorized;
use PubgApi\Exception\ExceptionUnsupported;

class Player extends AbstractService
{
    const url = '/players';

    /**
     * @param string $id
     * @return array
     * @throws GuzzleException
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     */
    public function getId(string $id)
    {
        $url = self::url . '/:id';
        return $this->requestGet($url, ['id' => $id]);
    }

    /**
     * @param array $ids
     * @return array
     * @throws GuzzleException
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     */
    public function getIds(array $ids)
    {
        if (count($ids) > 10) {
            throw new InvalidArgumentException('Too many ids. No more than 10.');
        }

        return $this->requestGet(self::url, [], ['filter[playerIds]' => implode(',', $ids)]);
    }

    /**
     * @param string $name
     * @return array
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     * @throws GuzzleException
     */
    public function getName(string $name)
    {
        return $this->requestGet(self::url, [], ['filter[playerNames]' => $name]);
    }

    /**
     * @param array $names
     * @return array
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     * @throws GuzzleException
     */
    public function getNames(array $names)
    {
        if (count($names) > 10) {
            throw new InvalidArgumentException('Too many names. No more than 10. ');
        }

        return $this->requestGet(self::url, [], ['filter[playerNames]' => implode(',', $names)]);
    }

    /**
     * @param string $accountId
     * @param string $seasonId
     * @return array
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     * @throws GuzzleException
     */
    public function season(string $accountId, string $seasonId)
    {
        $url = self::url . '/players/:accountId/seasons/:seasonId';
        return $this->requestGet($url, ['accountId' => $accountId, 'seasonId' => $seasonId]);
    }

    /**
     * @param string $accountId
     * @return array
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     * @throws GuzzleException
     */
    public function lifetime(string $accountId)
    {
        $url = self::url . '/:accountId/seasons/lifetime';
        return $this->requestGet($url, ['accountId' => $accountId]);
    }

    /**
     * @param string $accountId
     * @return array
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     * @throws GuzzleException
     */
    public function weaponMastery(string $accountId)
    {
        $url = self::url . '/:accountId/weapon_mastery';
        return $this->requestGet($url, ['accountId' => $accountId]);
    }
}