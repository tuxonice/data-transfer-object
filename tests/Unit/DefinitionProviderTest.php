<?php

namespace Tlab\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tlab\TransferObjects\DefinitionProvider;
use Tlab\TransferObjects\Exceptions\DefinitionException;

class DefinitionProviderTest extends TestCase
{
    public function testProvide(): void
    {
        $definitionProvider = new DefinitionProvider(dirname(__DIR__) . '/Data', 'TestNamespace');

        self::assertEquals([
            [
                'namespace' => 'TestNamespace',
                'className' => 'AddressTransfer',
                'abstractClass' => 'AbstractTransfer',
                'useNamespaces' => [
                    'Tlab\TransferObjects\AbstractTransfer',
                ],
                'deprecationDescription' => null,
                'immutable' => false,
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'streetName',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'city',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'zipCode',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'bool',
                        'camelCaseName' => 'isDefaultBillingAddress',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'bool',
                        'camelCaseName' => 'isDefaultShippingAddress',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'CustomerTransfer',
                'abstractClass' => 'AbstractTransfer',
                'useNamespaces' => [
                    'DateTime',
                    'Tlab\TransferObjects\AbstractTransfer',
                ],
                'deprecationDescription' => null,
                'immutable' => false,
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
                'immutable' => false,
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
                'immutable' => false,
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
                'className' => 'BicycleTransferImmutable',
                'abstractClass' => 'AbstractTransfer',
                'useNamespaces' => [
                    'Tlab\TransferObjects\AbstractTransfer',
                ],
                'deprecationDescription' => null,
                'immutable' => true,
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'brand',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'size',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'float',
                        'camelCaseName' => 'price',
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
                'immutable' => false,
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
                'immutable' => false,
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
                'immutable' => false,
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
                'className' => 'CategoryTransfer',
                'useNamespaces' => [
                    'Tlab\TransferObjects\AbstractTransfer',
                ],
                'abstractClass' => 'AbstractTransfer',
                'deprecationDescription' => null,
                'immutable' => false,
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'SampleTransfer',
                'abstractClass' => 'AbstractTransfer',
                'deprecationDescription' => null,
                'useNamespaces' => [
                    'Symfony\Component\HttpFoundation\Response',
                    'Tlab\TransferObjects\AbstractTransfer'
                ],
                'immutable' => false,
                'properties' => [
                    [
                        'type' => 'Response',
                        'camelCaseName' => 'response',
                        'namespace' => 'Symfony\Component\HttpFoundation\Response',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ]
                ],
            ],
        ], $definitionProvider->provide());
    }

    public function testProvideThrowExceptionWhenNoDefinitionFilesFound(): void
    {
        $this->expectException(DefinitionException::class);
        $this->expectExceptionMessage('No definition files found on '.dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Data/Empty');
        $definitionProvider = new DefinitionProvider(dirname(__DIR__) . '/Data/Empty', 'TestNamespace');
        $definitionProvider->provide();
    }
}
