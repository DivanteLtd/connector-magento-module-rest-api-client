<?php

namespace Divante\Connector\Magento;

use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Client;

/**
 * Interface ApiClientAware
 * @package Divante\Connector\Magento
 */
interface ApiClientAware
{
    /**
     * @param array $config
     * @param Client|null $client
     */
    public function __construct(array $config = [], Client $client = null);

    /**
     * @return string
     */
    public function getVersion();

    /**
     * @param $version
     * @return $this
     */
    public function setVersion($version);

    /**
     * @return Description
     */
    public function getApiDescription();

    /**
     * @return GuzzleClient
     */
    public function getApiClient();

    /**
     * @return Client|null
     */
    public function getHttpClient ();
}