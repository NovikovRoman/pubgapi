<?php

namespace PubgApi\Service;

use GuzzleHttp\Exception\GuzzleException;
use PubgApi\Exception\ExceptionNotFound;
use PubgApi\Exception\ExceptionTooManyRequests;
use PubgApi\Exception\ExceptionUnauthorized;
use PubgApi\Exception\ExceptionUnsupported;

class Tournament extends AbstractService
{
    const url = '/tournaments';

    /**
     * @param string $id
     * @return array
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     * @throws GuzzleException
     */
    public function getId(string $id)
    {
        $url = self::url . '/:id';
        return $this->requestGet($url, ['id' => $id]);
    }

    /**
     * @return array
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     * @throws GuzzleException
     */
    public function list()
    {
        return $this->requestGet(self::url);
    }
}