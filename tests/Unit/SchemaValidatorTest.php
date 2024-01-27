<?php

namespace Tlab\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tlab\TransferObjects\SchemaValidator;

class SchemaValidatorTest extends TestCase
{
    public function testSchemaValidator(): void
    {
        $schemaValidator = new SchemaValidator();

        $definitionFile = dirname(__DIR__) . '/Data/customer.json';
        $definition = file_get_contents($definitionFile);

        $errors = [];
        $result = $schemaValidator->validate($definition, $errors);

        self::assertEquals([], $errors);
        self::assertTrue($result);
    }

    /**
     * @dataProvider dataProvider
     * @param array $requestDefinition
     * @param array $expectedErrors
     * @param bool $isValid
     *
     * @return void
     */
    public function testSchemaPropertiesValidation(array $requestDefinition, array $expectedErrors, bool $isValid): void
    {
        $schemaValidator = new SchemaValidator();
        $definition = [
            "transfers" => [
                $requestDefinition
            ]
        ];

        $errors = [];
        $result = $schemaValidator->validate(json_encode($definition), $errors);

        self::assertEquals($expectedErrors, $errors);
        self::assertEquals($isValid, $result);
    }

    public static function dataProvider(): array
    {
        return [
            'Invalid Property Name Should Fail' => [
                [
                    "name" => "Customer",
                    "deprecationDescription" => "This class is deprecated",
                    "properties" => [
                        [
                            'name' => 'EmailNot-camel-case',
                            'type' => 'type-with-dash',
                            'nullable' => 'false',
                        ],
                    ]
                ],
                [
                    '/transfers/0/properties/0/name' => 'The string should match pattern: ^([a-z])+([A-Z][a-z]+)*$',
                    '/transfers/0/properties/0/type' => 'The string should match pattern: ^[A-Za-z]+(\[\])?$',
                    '/transfers/0/properties/0/nullable' => 'The data (string) must match the type: boolean',
                ],
                false,
            ],
            'Invalid Namespace Should Fail' => [
                [
                    "name" => "Customer",
                    "deprecationDescription" => "This class is deprecated",
                    "properties" => [
                        [
                            'name' => 'email',
                            'type' => 'SomeClass[]',
                            'namespace' => 'Acme/SomeClass',
                        ],
                    ]
                ],
                [
                    '/transfers/0/properties/0/namespace' => 'The string should match pattern: ^(\\\\)?[A-Za-z]+(\\\\[A-Za-z]+)*(\\\\)?$',
                ],
                false,
            ],
            'Array Type With Space Between Brackets Should Fail' => [
                [
                    "name" => "Customer",
                    "deprecationDescription" => "This class is deprecated",
                    "properties" => [
                        [
                            'name' => 'tags',
                            'type' => 'string[ ]',
                            'singular' => 'tag',
                        ],
                    ]
                ],
                [
                    '/transfers/0/properties/0/type' => 'The string should match pattern: ^[A-Za-z]+(\[\])?$',
                ],
                false,
            ],
            'Array Type With Missing Singular Property Should Fail' => [
                [
                    "name" => "Customer",
                    "deprecationDescription" => "This class is deprecated",
                    "properties" => [
                        [
                            'name' => 'tags',
                            'type' => 'string[]',
                        ],
                    ]
                ],
                [
                    '/transfers/0/properties/0' => 'The required properties (singular) are missing',
                ],
                false,
            ],
            'Array Of DateTime Without Namespace Should Fail' => [
                [
                    "name" => "Customer",
                    "deprecationDescription" => "This class is deprecated",
                    "properties" => [
                        [
                            'name' => 'dates',
                            'type' => 'DateTime[]',
                            'singular' => 'date'
                        ],
                    ]
                ],
                [
                    '/transfers/0/properties/0' => 'The required properties (namespace) are missing',
                ],
                false,
            ],
            'Array Of Transfers Without Namespace Should Not Fail' => [
                [
                    "name" => "Customer",
                    "properties" => [
                        [
                            'name' => 'products',
                            'type' => 'ProductTransfer[]',
                            'singular' => 'product'
                        ],
                    ]
                ],
                [],
                true,
            ]
        ];
    }
}