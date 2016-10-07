<?php
return [
    'service_manager' => [
        'factories' => [
            \ContinuousDelivery\V1\Rest\ZendGS\ZendGSResource::class => \ContinuousDelivery\V1\Rest\ZendGS\ZendGSResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'continuous-delivery.rest.zend-gs' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/zend-gs[/:zend_gs_id]',
                    'defaults' => [
                        'controller' => 'ContinuousDelivery\\V1\\Rest\\ZendGS\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'continuous-delivery.rest.zend-gs',
        ],
    ],
    'zf-rest' => [
        'ContinuousDelivery\\V1\\Rest\\ZendGS\\Controller' => [
            'listener' => \ContinuousDelivery\V1\Rest\ZendGS\ZendGSResource::class,
            'route_name' => 'continuous-delivery.rest.zend-gs',
            'route_identifier_name' => 'zend_gs_id',
            'collection_name' => 'zend_gs',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ContinuousDelivery\V1\Rest\ZendGS\ZendGSEntity::class,
            'collection_class' => \ContinuousDelivery\V1\Rest\ZendGS\ZendGSCollection::class,
            'service_name' => 'ZendGS',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'ContinuousDelivery\\V1\\Rest\\ZendGS\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'ContinuousDelivery\\V1\\Rest\\ZendGS\\Controller' => [
                0 => 'application/vnd.continuous-delivery.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'ContinuousDelivery\\V1\\Rest\\ZendGS\\Controller' => [
                0 => 'application/vnd.continuous-delivery.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \ContinuousDelivery\V1\Rest\ZendGS\ZendGSEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'continuous-delivery.rest.zend-gs',
                'route_identifier_name' => 'zend_gs_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \ContinuousDelivery\V1\Rest\ZendGS\ZendGSCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'continuous-delivery.rest.zend-gs',
                'route_identifier_name' => 'zend_gs_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'ContinuousDelivery\\V1\\Rest\\ZendGS\\Controller' => [
            'input_filter' => 'ContinuousDelivery\\V1\\Rest\\ZendGS\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'ContinuousDelivery\\V1\\Rest\\ZendGS\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alpha::class,
                        'options' => [],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\I18n\Filter\Alpha::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Filter\StringTrim::class,
                        'options' => [],
                    ],
                    2 => [
                        'name' => \Zend\Filter\StripTags::class,
                        'options' => [],
                    ],
                ],
                'name' => 'name',
                'description' => 'The GS member name',
                'field_type' => 'string',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alpha::class,
                        'options' => [],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\I18n\Filter\Alpha::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                        'options' => [],
                    ],
                    2 => [
                        'name' => \Zend\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'surname',
                'description' => 'The GS member family name',
                'field_type' => 'string',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alpha::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'city',
                'description' => 'The city the GS member is located in',
                'field_type' => 'string',
            ],
            3 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alpha::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'country',
                'description' => 'The country the GS member is located in',
            ],
            4 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\EmailAddress::class,
                        'options' => [
                            'useMxCheck' => true,
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'email',
                'description' => 'The GS member email.',
                'field_type' => 'array',
            ],
        ],
    ],
];
