<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use TransferObjects\DefinitionProvider;


class DefinitionProviderTest extends TestCase
{
    public function testGenerateTransfer(): void
    {
        $definitionProvider = new DefinitionProvider(dirname(__DIR__).'/Data');
        $definitionProvider->provide();

        self::assertEquals([
            [
                'className' => 'Products',
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
                'className' => 'Category',
                'abstractClass' => 'AbstractTransfer',
                'properties' => [
                    [
                        'type' => 'string',
                        'camelCaseName' => 'name',
                    ],
                ]
            ],
            [
                'className' => 'Customer',
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