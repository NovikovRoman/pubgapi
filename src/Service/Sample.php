<?php

namespace PubgApi\Service;

use GuzzleHttp\Exception\GuzzleException;
use PubgApi\Exception\ExceptionNotFound;
use PubgApi\Exception\ExceptionTooManyRequests;
use PubgApi\Exception\ExceptionUnauthorized;
use PubgApi\Exception\ExceptionUnsupported;

class Sample extends AbstractService
{
    const url = '/samples';

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