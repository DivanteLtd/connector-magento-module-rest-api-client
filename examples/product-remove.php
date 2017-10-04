<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Divante\Connector\Magento\ApiClient;

$api = new ApiClient([
    'apiUrl' => 'http://example.com'
]);

/**
 * @var GuzzleHttp\Command\Result $results
 */
$results = $api->product()->remove(123);

print_r($results->toArray());
