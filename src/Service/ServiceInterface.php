<?php

namespace PubgApi\Service;

use PubgApi\PubgClient;

interface ServiceInterface
{
    public function __construct(PubgClient $pubgClient);
}