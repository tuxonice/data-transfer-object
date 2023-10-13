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
                'className' => 'ProductTransfer',
                'abstractClass' => 'AbstractTransfer',
                'description' => null,
                'deprecationDescription' => null,
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'sku',
                        'nullable' => false,
                        'description' => null,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                        'nullable' => true,
                        'description' => null,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'float',
                        'camelCaseName' => 'price',
                        'nullable' => false,
                        'description' => null,
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'array',
                        'elementsType' => 'CategoryTransfer',
                        'camelCaseName' => 'categories',
                        'camelCaseSingularName' => 'category',
                        'nullable' => false,
                        'description' => null,
                        'deprecationDescription' => null,
                    ],
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'CategoryTransfer',
                'abstractClass' => 'AbstractTransfer',
                'description' => null,
                'deprecationDescription' => null,
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                        'nullable' => false,
                        'description' => null,
                        'deprecationDescription' => null,
                    ],
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'CustomerTransfer',
                'abstractClass' => 'AbstractTransfer',
                'description' => 'DTO description',
                'deprecationDescription' => 'This class is deprecated',
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'email',
                        'nullable' => false,
                        'description' => 'The customer email',
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'firstName',
                        'nullable' => false,
                        'description' => 'The customer first name',
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'lastName',
                        'nullable' => true,
                        'description' => 'The customer last name',
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'bool',
                        'camelCaseName' => 'isGuest',
                        'nullable' => false,
                        'description' => 'Is a guest customer',
                        'deprecationDescription' => 'isGuest property is deprecated',
                    ]
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'SomeOtherDataTransferObjectTransfer',
                'abstractClass' => 'AbstractTransfer',
                'description' => 'DTO description',
                'deprecationDescription' => 'This class is deprecated',
                'properties' => [
                    [
                        'type' => 'int',
                        'camelCaseName' => 'id',
                        'nullable' => false,
                        'description' => 'An integer field',
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                        'nullable' => true,
                        'description' => 'A string field',
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'float',
                        'camelCaseName' => 'price',
                        'nullable' => false,
                        'description' => 'A float field',
                        'deprecationDescription' => null,
                    ],
                    [
                        'type' => 'bool',
                        'camelCaseName' => 'isActive',
                        'nullable' => false,
                        'description' => 'A bool field',
                        'deprecationDescription' => 'isActive property is deprecated',
                    ],
                    [
                        'type' => 'array',
                        'elementsType' => 'string',
                        'camelCaseSingularName' => 'tag',
                        'camelCaseName' => 'tags',
                        'nullable' => false,
                        'description' => null,
                        'deprecationDescription' => null,
                    ]
                ]
            ]
        ], $definitionProvider->provide());
    }
}
