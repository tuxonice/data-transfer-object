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

    public function testSchemaValidatorForInvalidPropertyName(): void
    {
        $schemaValidator = new SchemaValidator();

        $definition = $this->loadDefinition();
        $definition['transfers'][0]['properties'][0] = [
            'name' => 'EmailNot-camel-case',
            'type' => 'type-with-dash',
            'nullable' => 'false',
        ];

        $errors = [];
        $result = $schemaValidator->validate(json_encode($definition), $errors);

        self::assertEquals([
            '/transfers/0/properties/0/name' => 'The string should match pattern: ^([a-z])+([A-Z][a-z]+)*$',
            '/transfers/0/properties/0/type' => 'The string should match pattern: ^[A-Za-z]+(\[\])?$',
            '/transfers/0/properties/0/nullable' => 'The data (string) must match the type: boolean',
        ], $errors);
        self::assertFalse($result);
    }

    public function testSchemaValidatorForInvalidNamespace(): void
    {
        $schemaValidator = new SchemaValidator();

        $definition = $this->loadDefinition();
        $definition['transfers'][0]['properties'][0] = [
            'name' => 'email',
            'type' => 'string',
            'namespace' => 'Acme/SomeClass',
        ];

        $errors = [];
        $result = $schemaValidator->validate(json_encode($definition), $errors);

        self::assertEquals([
            '/transfers/0/properties/0/namespace' => 'The string should match pattern: ^(\\\\)?[A-Za-z]+(\\\\[A-Za-z]+)*(\\\\)?$',
        ], $errors);
        self::assertFalse($result);
    }

    public function testSchemaValidatorForArrayType(): void
    {
        $schemaValidator = new SchemaValidator();

        $definition = $this->loadDefinition();
        $definition['transfers'][0]['properties'][0] = [
            'name' => 'tags',
            'type' => 'string[ ]',
            'singular' => 'tag',
        ];

        $errors = [];
        $result = $schemaValidator->validate(json_encode($definition), $errors);

        self::assertEquals([
            '/transfers/0/properties/0/type' => 'The string should match pattern: ^[A-Za-z]+(\[\])?$',
        ], $errors);
        self::assertFalse($result);
    }

    /**
     * @return array<string,mixed>
     */
    private function loadDefinition(): array
    {
        return [
            "transfers" => [
                [
                    "name" => "Customer",
                    "deprecationDescription" => "This class is deprecated",
                    "properties" => [
                        [
                            "name" => "email",
                            "type" => "string",
                            "nullable" => false
                        ],
                    ]
                ]
            ]
        ];
    }
}