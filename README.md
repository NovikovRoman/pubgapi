```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Exception\GuzzleException;
use PubgApi\Exception\ExceptionNotFound;
use PubgApi\Exception\ExceptionTooManyRequests;
use PubgApi\Exception\ExceptionUnauthorized;
use PubgApi\Exception\ExceptionUnsupported;
use PubgApi\PubgClient;
use PubgApi\Service\Player;

$apiKey = 'our_api_key';
$client = new PubgClient($apiKey, 'steam');

$player = new Player($client);

try {
    $resp = $player->getName('WackyJacky101');
    $resp = $player->getId($resp['data'][0]['id']);

    print_r($resp);

} catch (GuzzleException $e) {
    die($e->getMessage());

} catch (ExceptionNotFound $e) {
    die($e->getMessage());

} catch (ExceptionTooManyRequests $e) {
    die($e->getMessage());

} catch (ExceptionUnauthorized $e) {
    die($e->getMessage());

} catch (ExceptionUnsupported $e) {
    die($e->getMessage());
}
```