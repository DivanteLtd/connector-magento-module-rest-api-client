<?php

namespace Divante\Connector\Magento\ApiClient;

use Divante\Connector\Magento\ApiClientAware;
use GuzzleHttp\Command\Guzzle\Description;

/**
 * Class Product
 * @package Divante\Connector\Magento\ApiClient\Pimcore
 */
class Product extends BaseClient implements ApiClientAware
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create (array $data)
    {
        return $this->getApiClient()->create($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function update (array $data)
    {
        return $this->getApiClient()->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove ($id)
    {
        return $this->getApiClient()->remove(['id' => $id]);
    }

    /**
     * @return Description
     */
    public function getApiDescription()
    {
        $productDefinition = $this->getProductDescription();

        return new Description([
            'baseUri' => $this->apiUrl,
            'apiVersion' => $this->getVersion(),
            'operations' => [
                'create' => [
                    'httpMethod' => 'POST',
                    'uri' => '/api/rest/bus/products',
                    'responseModel' => 'getResponse',
                    'parameters' =>
                        array_merge($productDefinition, [
                            'id' => [
                                'type' => 'string',
                                'location' => 'json',
                                'required' => false
                            ]
                        ])
                ],
                'update' => [
                    'httpMethod' => 'PUT',
                    'uri' => '/api/rest/bus/product/{id}',
                    'responseModel' => 'getResponse',
                    'parameters' =>
                        array_merge($productDefinition, [
                            'id' => [
                                'type' => 'string',
                                'location' => 'uri',
                                'required' => true
                            ]
                        ])
                ],
                'remove' => [
                    'httpMethod' => 'DELETE',
                    'uri' => '/api/rest/bus/product/{id}',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'id' => [
                            'type' => 'string',
                            'location' => 'uri',
                            'required' => true
                        ]
                    ]
                ]
            ],

            'models' => [
                'getResponse' => [
                    'type' => 'object',
                    'additionalProperties' => [
                        'location' => 'json'
                    ]
                ]
            ]
        ]);
    }

    /**
     * @return array
     */
    protected function getProductDescription()
    {
        $productDescription = [
            'name' => [
                'type' => 'string',
                'location' => 'json',
                'required' => true
            ],
            'description' => [
                'type' => 'string',
                'location' => 'json',
                'required' => true
            ],
            'short_description'=> [
                'type' => 'string',
                'location' => 'json',
                'required' => true
            ],
            'sku' => [
                'type' => 'string',
                'location' => 'json',
                'required' => true
            ],
            'price' => [
                'type' => 'number',
                'location' => 'json',
                'required' => true
            ],
            'weight' => [
                'type' => 'number',
                'location' => 'json',
                'required' => true
            ],
            'website_ids' => [
                'type' => 'string',
                'location' => 'json',
                'required' => false
            ],
            'type_id' => [
                'type' => 'string',
                'location' => 'json',
                'required' => false
            ],
            'attribute_set_id' => [
                'type' => 'string',
                'location' => 'json',
                'required' => false
            ],
            'status' => [
                'type' => 'string',
                'location' => 'json',
                'required' => false
            ],
            'visibility' => [
                'type' => 'string',
                'location' => 'json',
                'required' => false
            ],
            'tax_class_id' => [
                'type' => 'string',
                'location' => 'json',
                'required' => false
            ],
            'orbaallegro_use_mapping' => [
                'type' => 'string',
                'location' => 'json',
                'required' => false
            ],
            'multistore' => [
                'type' => 'array',
                'location' => 'json',
                'required' => false
            ]
        ];
        return $productDescription;
    }
}
