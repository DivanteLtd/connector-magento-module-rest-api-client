<?php

namespace Divante\Connector\Magento\ApiClient;

use Divante\Connector\Magento\ApiClientAware;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Client;

/**
 * Class BaseClient
 * @package Divante\Connector\Magento\ApiClient
 */
abstract class BaseClient implements ApiClientAware
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    protected $apiUrl = '';

    /**
     * @var string
     */
    protected $apiKey = '';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var GuzzleClient
     */
    protected $apiClient;

    /**
     * <code>
     *   ['username','password']
     * </code>
     * @var array|null
     */
    protected $basicAuth;

    /**
     * @var string
     */
    protected $version = '1.0';

    /**
     * @param array $config
     * @param Client|null $client
     */
    public function __construct(array $config = [], Client $client = null)
    {
        if (!empty($config)) {
            foreach ($config as $k => $v){
                switch ($k) {
                    case 'apiUrl':
                        $this->apiUrl = $v;
                        break;
                    case 'apiKey':
                        $this->apiKey = $v;
                        break;
                    case 'basicAuth':
                        $this->basicAuth = explode(':', $v);
                        break;
                    case 'version':
                        $this->version = $v;
                        break;
                }
            }
        }
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return GuzzleClient
     */
    public function getApiClient()
    {
        if (null === $this->apiClient) {
            $this->apiClient = new GuzzleClient(
                $this->getHttpClient(),
                $this->getApiDescription()
            );

        }
        return $this->apiClient;
    }

    /**
     * @return Client|null
     */
    public function getHttpClient ()
    {
        if (null === $this->client) {
            $config = [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json; charset=utf-8',
                    'User-Agent'    => 'Connector Magento REST API Client ' . $this->getVersion()
                ]
            ];

            if (null !== $this->basicAuth) {
                $config['auth'] = $this->basicAuth;
            }
            $this->client = new Client($config);
        }

        return $this->client;
    }
}