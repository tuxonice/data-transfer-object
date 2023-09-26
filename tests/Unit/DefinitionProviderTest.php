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
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                    ],
                    [
                        'type' => 'float',
                        'camelCaseName' => 'price',
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
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'firstName',
                    ],
                    [
                        'type' => 'string',
                        'camelCaseName' => 'lastName',
                    ],
                    [
                        'type' => 'bool',
                        'camelCaseName' => 'isGuest',
                    ]
                ]
            ],
        ], $definitionProvider->provide());
    }
}