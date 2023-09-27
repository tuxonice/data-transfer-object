<?php

namespace Tlab\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tlab\TransferObjects\DefinitionProvider;


class DefinitionProviderTest extends TestCase
{
    public function testProvide(): void
    {
        $definitionProvider = new DefinitionProvider(dirname(__DIR__).'/Data', 'TestNamespace');
        $definitionProvider->provide();

        self::assertEquals([
            [
                'namespace' => 'TestNamespace',
                'className' => 'ProductTransfer',
                'abstractClass' => 'AbstractTransfer',
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'sku',
                        'nullable' => false,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                        'nullable' => true,
                    ],
                    [
                        'type' => 'float',
                        'camelCaseName' => 'price',
                        'nullable' => false,
                    ],
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'CategoryTransfer',
                'abstractClass' => 'AbstractTransfer',
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                        'nullable' => false,
                    ],
                ]
            ],
            [
                'namespace' => 'TestNamespace',
                'className' => 'CustomerTransfer',
                'abstractClass' => 'AbstractTransfer',
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'email',
                        'nullable' => false,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'firstName',
                        'nullable' => false,
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'lastName',
                        'nullable' => false,
                    ],
                    [
                        'type' => 'bool',
                        'camelCaseName' => 'isGuest',
                        'nullable' => false,
                    ]
                ]
            ],
        ], $definitionProvider->provide());
    }
}