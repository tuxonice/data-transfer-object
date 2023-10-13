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
            [
                'namespace' => 'TestNamespace',
                'className' => 'CustomerTransfer',
                'abstractClass' => 'AbstractTransfer',
                'useNamespaces' => [
                    'Acme\Environment',
                    'DateTime',
                    'Tlab\TransferObjects\AbstractTransfer',
                ],
                'deprecationDescription' => 'This class is deprecated',
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'email',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'CategoryTransfer',
                        'camelCaseName' => 'category',
                        'nullable' => false,
                        'deprecationDescription' => null,
                        'namespace' => '',
                    ],
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
                        'type' => 'DateTime',
                        'camelCaseName' => 'birthDate',
                        'nullable' => false,
                        'deprecationDescription' => null,
                        'namespace' => 'DateTime',
                    ],
                    [
                        'type' => 'array',
                        'camelCaseName' => 'timeTables',
                        'nullable' => false,
                        'deprecationDescription' => null,
                        'namespace' => 'DateTime',
                        'elementsType' => 'DateTime',
                        'camelCaseSingularName' => 'timeTable',
                    ],
                    [
                        'type' => 'Environment',
                        'camelCaseName' => 'someOtherField',
                        'namespace' => 'Acme\Environment',
                        'nullable' => true,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'bool',
                        'camelCaseName' => 'isGuest',
                        'nullable' => false,
                        'deprecationDescription' => 'isGuest property is deprecated',
                    ]
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'SomeOtherDataTransferObjectTransfer',
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
                        'camelCaseSingularName' => 'tag',
                        'camelCaseName' => 'tags',
                        'nullable' => false,
                        'deprecationDescription' => null,
                    ],
                ]
            ]
        ], $definitionProvider->provide());
    }
}
