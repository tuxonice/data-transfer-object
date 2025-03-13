<?php

namespace Tlab\TransferObjects;

use Opis\JsonSchema\Validator;
use Opis\JsonSchema\Errors\ErrorFormatter;

class SchemaValidator
{
    private const SCHEMA_PATH = __DIR__ . '/Schema/schema.json';
    private const MAX_ERRORS = 5;

    private ?string $cachedSchema = null;
    private ?Validator $validator = null;

    /**
     * @param string $data
     * @param array<string,string> $errors
     *
     * @return bool
     * @throws DefinitionException
     */
    public function validate(string $data, array &$errors): bool
    {
        $schema = $this->getSchema();
        $decodedData = $this->decodeJson($data);

        $result = $this->getValidator()->validate($decodedData, $schema);

        if ($result->isValid()) {
            return true;
        }

        $error = $result->error();
        $formatter = new ErrorFormatter();
        $errors = $formatter->format($error, false);

        return false;
    }

    /**
     * @return string
     * @throws DefinitionException
     */
    private function getSchema(): string
    {
        if ($this->cachedSchema === null) {
            $schema = @file_get_contents(self::SCHEMA_PATH);
            if ($schema === false) {
                throw new DefinitionException(sprintf('Could not read schema file: %s', self::SCHEMA_PATH));
            }
            $this->cachedSchema = $schema;
        }

        return $this->cachedSchema;
    }

    private function getValidator(): Validator
    {
        if ($this->validator === null) {
            $this->validator = new Validator();
            $this->validator->setMaxErrors(self::MAX_ERRORS);
        }

        return $this->validator;
    }

    /**
     * @param string $data
     * @return object
     * @throws DefinitionException
     */
    private function decodeJson(string $data): object
    {
        $decoded = json_decode($data);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new DefinitionException(sprintf('Invalid JSON data: %s', json_last_error_msg()));
        }

        return $decoded;
    }
}
