<?php

namespace PubgApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use PubgApi\Exception\ExceptionNotFound;
use PubgApi\Exception\ExceptionTooManyRequests;
use PubgApi\Exception\ExceptionUnauthorized;
use PubgApi\Exception\ExceptionUnsupported;

class PubgClient
{
    const url = 'https://api.pubg.com/shards';

    private $apiKey;
    private $platform;
    /** @var Client */
    private $httpClient;

    public function __construct(string $apiKey, string $platform)
    {
        $this->apiKey = $apiKey;
        $this->platform = $platform;
        $this->httpClient = new Client();
    }

    /**
     * @param $url
     * @param array $vars
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws ExceptionNotFound
     * @throws ExceptionTooManyRequests
     * @throws ExceptionUnauthorized
     * @throws ExceptionUnsupported
     */
    public function requestGet($url, $vars = [], $params = [])
    {
        $url = $this->getApiUrl() . $url;
        foreach ($vars as $code => $value) {
            $url = str_replace(':' . $code, urldecode($value), $url);
        }

        $url .= empty($params) ? '' : '?' . http_build_query($params);

        $request = new Request('GET', $url);
        $resp = $this->httpClient->send($request, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/vnd.api+json',
                'Accept-Encoding' => 'gzip',
            ]
        ]);

        switch ($resp->getStatusCode()) {
            case 200:
                return $resp;
                break;

            case 401:
                throw new ExceptionUnauthorized('Unauthorized.', $request, $resp);
                break;

            case 404:
                throw new ExceptionNotFound('Not Found.', $request, $resp);
                break;

            case 415:
                throw new ExceptionUnsupported('Unsupported.', $request, $resp);
                break;

            case 429:
                throw new ExceptionTooManyRequests('Too many requests.', $request, $resp);
                break;
        }

        throw new RequestException('Bad status code  ' . $resp->getStatusCode() . '.', $request, $resp);
    }

    private function getApiUrl()
    {
        return self::url . '/' . $this->platform;
    }
}