<?php

namespace Divante\Connector\Magento;

use Divante\Connector\Magento\ApiClient\BaseClient;
use Divante\Connector\Magento\ApiClient\Product;

/**
 * Class ApiClient
 * @package Divante\Connector\Magento
 */
class ApiClient extends BaseClient implements ApiClientAware
{
    /**
     * @var Product
     */
    protected $productEndpoint;

    /**
     * @throws \RuntimeException
     */
    public function getApiDescription()
    {
        throw new \RuntimeException('Select endpoint');
    }

    /**
     * @return Product
     */
    public function product ()
    {
        if (null == $this->productEndpoint) {
            $this->productEndpoint = new Product(
                $this->config,
                $this->client
            );
        }

        return $this->productEndpoint;
    }
}