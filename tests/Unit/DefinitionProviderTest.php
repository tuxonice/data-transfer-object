<?php

namespace Tlab\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tlab\TransferObjects\DefinitionProvider;
use Tlab\TransferObjects\Exceptions\ArrayTypeNullableException;
use Tlab\TransferObjects\Exceptions\DefinitionException;

class DefinitionProviderTest extends TestCase
{
    public function testProvide(): void
    {
        $definitionProvider = new DefinitionProvider(
            dirname(__DIR__) . '/Data',
            'TestNamespace'
        );

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
        $definitionProvider = new DefinitionProvider(
            dirname(__DIR__) . '/Data/Empty',
            'TestNamespace'
        );
        $definitionProvider->provide();
    }

    public function testProvideShouldThrowExceptionForSchemaWithNullablePropertyOnArray(): void
    {
        $this->expectException(ArrayTypeNullableException::class);
        $this->expectExceptionMessage('Invalid nullable property for array types');
        $definitionProvider = new DefinitionProvider(
            dirname(__DIR__) . '/Data/Invalid-nullable-array',
            'TestNamespace'
        );
        $definitionProvider->provide();
    }

    public function testDeeplyNestedTransfers(): void
    {
        $definitionProvider = new DefinitionProvider(
            dirname(__DIR__) . '/Data',
            'TestNamespace'
        );

        $transfers = $definitionProvider->provide();
        
        // Find the Order transfer
        $orderTransfer = null;
        foreach ($transfers as $transfer) {
            if ($transfer['className'] === 'OrderTransfer') {
                $orderTransfer = $transfer;
                break;
            }
        }

        self::assertNotNull($orderTransfer, 'Order transfer not found');
        
        // Verify nested structure
        $customerProperty = null;
        $itemsProperty = null;
        foreach ($orderTransfer['properties'] as $property) {
            if ($property['camelCaseName'] === 'customer') {
                $customerProperty = $property;
            } elseif ($property['camelCaseName'] === 'items') {
                $itemsProperty = $property;
            }
        }

        // Check customer property
        self::assertNotNull($customerProperty, 'Customer property not found');
        self::assertEquals('CustomerTransfer', $customerProperty['type']);
        self::assertTrue($customerProperty['nullable']);

        // Check items property
        self::assertNotNull($itemsProperty, 'Items property not found');
        self::assertEquals('array', $itemsProperty['type']);
        self::assertEquals('OrderItemTransfer', $itemsProperty['elementsType']);
        self::assertEquals('item', $itemsProperty['camelCaseSingularName']);
    }

    public function testCircularReferences(): void
    {
        $definitionProvider = new DefinitionProvider(
            dirname(__DIR__) . '/Data',
            'TestNamespace'
        );

        $transfers = $definitionProvider->provide();
        
        // Find the Category transfer
        $categoryTransfer = null;
        foreach ($transfers as $transfer) {
            if ($transfer['className'] === 'CategoryTransfer') {
                $categoryTransfer = $transfer;
                break;
            }
        }

        self::assertNotNull($categoryTransfer, 'Category transfer not found');
        
        // Verify self-referencing property
        $parentProperty = null;
        foreach ($categoryTransfer['properties'] as $property) {
            if ($property['camelCaseName'] === 'parentCategory') {
                $parentProperty = $property;
                break;
            }
        }

        self::assertNotNull($parentProperty, 'Parent category property not found');
        self::assertEquals('CategoryTransfer', $parentProperty['type']);
        self::assertTrue($parentProperty['nullable'], 'Circular reference should be nullable to prevent infinite loops');
    }

    public function testSpecialCharactersInProperties(): void
    {
        $definitionProvider = new DefinitionProvider(
            dirname(__DIR__) . '/Data',
            'TestNamespace'
        );

        $transfers = $definitionProvider->provide();
        
        // Find the SpecialCharacters transfer
        $specialTransfer = null;
        foreach ($transfers as $transfer) {
            if ($transfer['className'] === 'SpecialCharactersTransfer') {
                $specialTransfer = $transfer;
                break;
            }
        }

        self::assertNotNull($specialTransfer, 'SpecialCharacters transfer not found');
        
        // Test various special case properties
        $foundProperties = [
            'camelCaseWithNumbers123' => false,
            'withUnicode' => false,
            'veryLongPropertyNameThatMightCauseIssuesWithCodeGenerationAndFormatting' => false,
            'arrayWithMaxItems' => false
        ];

        foreach ($specialTransfer['properties'] as $property) {
            if (isset($foundProperties[$property['camelCaseName']])) {
                $foundProperties[$property['camelCaseName']] = true;
            }
        }

        foreach ($foundProperties as $propertyName => $found) {
            self::assertTrue($found, sprintf('Property %s not found', $propertyName));
        }
    }

    /**
     * @dataProvider errorCasesProvider
     */
    public function testErrorCases(string $directory, string $expectedExceptionClass, string $expectedMessage): void
    {
        $this->expectException($expectedExceptionClass);
        $this->expectExceptionMessage($expectedMessage);

        $definitionProvider = new DefinitionProvider(
            $directory,
            'TestNamespace'
        );

        $definitionProvider->provide();
    }

    public static function errorCasesProvider(): array
    {
        return [
            'Non-existent directory' => [
                '/non/existent/directory',
                DefinitionException::class,
                'No definition files found on /non/existent/directory'
            ],
            'Non-readable directory' => [
                '/root/protected',
                DefinitionException::class,
                'No definition files found on /root/protected'
            ],
            'Empty directory' => [
                sys_get_temp_dir(),
                DefinitionException::class,
                'No definition files found on ' . sys_get_temp_dir()
            ]
        ];
    }

    public function testMalformedNamespaces(): void
    {
        $definitionProvider = new DefinitionProvider(
            dirname(__DIR__) . '/Data',
            'TestNamespace'
        );

        $transfers = $definitionProvider->provide();
        
        // Find the MalformedNamespace transfer
        $malformedTransfer = null;
        foreach ($transfers as $transfer) {
            if ($transfer['className'] === 'MalformedNamespaceTransfer') {
                $malformedTransfer = $transfer;
                break;
            }
        }

        self::assertNotNull($malformedTransfer, 'MalformedNamespace transfer not found');
        
        // Test namespace handling
        $invalidNamespaceProperty = null;
        $doubleBackslashProperty = null;
        foreach ($malformedTransfer['properties'] as $property) {
            if ($property['camelCaseName'] === 'invalidNamespace') {
                $invalidNamespaceProperty = $property;
            } elseif ($property['camelCaseName'] === 'doubleBackslash') {
                $doubleBackslashProperty = $property;
            }
        }

        self::assertNotNull($invalidNamespaceProperty, 'Invalid namespace property not found');
        self::assertNotNull($doubleBackslashProperty, 'Double backslash property not found');

        // Verify namespace normalization
        self::assertEquals('Invalid\\Namespace', $invalidNamespaceProperty['namespace']);
        self::assertEquals('Double\\Backslash', $doubleBackslashProperty['namespace']);
    }

    public function testSchemaValidatorPerformance(): void
    {
        $definitionProvider = new DefinitionProvider(
            dirname(__DIR__) . '/Data',
            'TestNamespace'
        );

        // First call to cache the schema
        $startTime = microtime(true);
        $definitionProvider->provide();
        $firstCallTime = microtime(true) - $startTime;

        // Second call should be faster due to caching
        $startTime = microtime(true);
        $definitionProvider->provide();
        $secondCallTime = microtime(true) - $startTime;

        // The second call should be significantly faster (at least 20% faster)
        // due to schema caching
        self::assertLessThan(
            $firstCallTime * 0.8,
            $secondCallTime,
            'Second call was not significantly faster than first call, caching might not be working'
        );
    }

    public function testLargeFileHandling(): void
    {
        // Create a large definition file in memory
        $largeDefinition = [
            'transfers' => []
        ];

        // Add 1000 transfer objects with 10 properties each
        for ($i = 0; $i < 1000; $i++) {
            $transfer = [
                'name' => 'LargeTransfer' . $i,
                'properties' => []
            ];

            for ($j = 0; $j < 10; $j++) {
                $transfer['properties'][] = [
                    'name' => 'property' . $j,
                    'type' => 'string'
                ];
            }

            $largeDefinition['transfers'][] = $transfer;
        }

        // Create temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'large_definition');
        file_put_contents($tempFile, json_encode($largeDefinition));

        try {
            $tempDir = dirname($tempFile);
            $definitionProvider = new DefinitionProvider($tempDir, 'TestNamespace');

            // This should not cause memory issues
            $transfers = $definitionProvider->provide();

            self::assertCount(1000, $transfers, 'Not all transfers were processed');

            // Check memory usage
            $memoryUsage = memory_get_peak_usage(true);
            // Should not exceed 100MB for processing
            self::assertLessThan(
                100 * 1024 * 1024,
                $memoryUsage,
                'Memory usage exceeded 100MB while processing large file'
            );
        } finally {
            unlink($tempFile);
        }
    }
}
