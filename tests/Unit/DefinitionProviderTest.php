<?php

namespace Tlab\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tlab\TransferObjects\DefinitionProvider;

class DefinitionProviderTest extends TestCase
{
    public function testProvide(): void
    {
        $definitionProvider = new DefinitionProvider(dirname(__DIR__) . '/Data', 'TestNamespace');
        $definitionProvider->provide();

        self::assertEquals([
            [
                'namespace' => 'TestNamespace',
                'className' => 'CustomerTransfer',
                'abstractClass' => 'AbstractTransfer',
                'useNamespaces' => [
                    'DateTime',
                    'Tlab\TransferObjects\AbstractTransfer',
                ],
                'deprecationDescription' => null,
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'firstName',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'lastName',
                        'nullable' => true,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'email',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'DateTime',
                        'camelCaseName' => 'birthDate',
                        'nullable' => false,
                        'deprecationDescription' => null,
                        'namespace' => 'DateTime',
                    ],
                    [
                        'type' => 'bool',
                        'camelCaseName' => 'isActive',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'DeprecatedClassTransfer',
                'abstractClass' => 'AbstractTransfer',
                'useNamespaces' => [
                    'Tlab\TransferObjects\AbstractTransfer',
                ],
                'deprecationDescription' => 'This class is deprecated',
                'properties' => [
                    [
                        'type' => 'int',
                        'camelCaseName' => 'id',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                        'nullable' => true,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'float',
                        'camelCaseName' => 'price',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'array',
                        'elementsType' => 'string',
                        'camelCaseName' => 'tags',
                        'camelCaseSingularName' => 'tag',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'DeprecatedPropertyTransfer',
                'abstractClass' => 'AbstractTransfer',
                'useNamespaces' => [
                    'Tlab\TransferObjects\AbstractTransfer',
                ],
                'deprecationDescription' => null,
                'properties' => [
                    [
                        'type' => 'int',
                        'camelCaseName' => 'id',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                        'nullable' => true,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'float',
                        'camelCaseName' => 'price',
                        'nullable' => false,
                        'deprecationDescription' => 'This field is deprecated',
                    ],
                    [
                        'type' => 'array',
                        'elementsType' => 'string',
                        'camelCaseName' => 'tags',
                        'camelCaseSingularName' => 'tag',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'OrderTransfer',
                'abstractClass' => 'AbstractTransfer',
                'useNamespaces' => [
                    'DateTime',
                    'Tlab\TransferObjects\AbstractTransfer',
                ],
                'deprecationDescription' => null,
                'properties' => [
                    [
                        'type' => 'int',
                        'camelCaseName' => 'id',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'CustomerTransfer',
                        'camelCaseName' => 'customer',
                        'nullable' => false,
                        'deprecationDescription' => null,
                        'namespace' => null,
                    ],
                    [
                        'type' => 'float',
                        'camelCaseName' => 'total',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'array',
                        'elementsType' => 'orderItemTransfer',
                        'camelCaseName' => 'orderItems',
                        'camelCaseSingularName' => 'orderItem',
                        'nullable' => false,
                        'deprecationDescription' => null,
                        'namespace' => null,
                    ],
                    [
                        'type' => 'DateTime',
                        'camelCaseName' => 'createdAt',
                        'namespace' => 'DateTime',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'OrderItemTransfer',
                'abstractClass' => 'AbstractTransfer',
                'useNamespaces' => [
                    'Tlab\TransferObjects\AbstractTransfer',
                ],
                'deprecationDescription' => null,
                'properties' => [
                    [
                        'type' => 'int',
                        'camelCaseName' => 'id',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'float',
                        'camelCaseName' => 'price',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'int',
                        'camelCaseName' => 'quantity',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'useNamespaces' => [
                    'Tlab\TransferObjects\AbstractTransfer',
                ],
                'className' => 'ProductTransfer',
                'abstractClass' => 'AbstractTransfer',
                'deprecationDescription' => null,
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'sku',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                        'nullable' => true,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'float',
                        'camelCaseName' => 'price',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'array',
                        'elementsType' => 'CategoryTransfer',
                        'camelCaseName' => 'categories',
                        'camelCaseSingularName' => 'category',
                        'namespace' => '',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'CategoryTransfer',
                'useNamespaces' => [
                    'Tlab\TransferObjects\AbstractTransfer',
                ],
                'abstractClass' => 'AbstractTransfer',
                'deprecationDescription' => null,
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                ]
            ],
        ], $definitionProvider->provide());
    }
}
