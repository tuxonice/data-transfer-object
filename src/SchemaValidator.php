<?php

namespace Tlab\TransferObjects;

use Opis\JsonSchema\Validator;
use Opis\JsonSchema\Errors\ErrorFormatter;

class SchemaValidator
{
    /**
     * @param string $data
     * @param array<string,string> $errors
     *
     * @return bool
     */
    public function validate(string $data, array &$errors): bool
    {
        $schema = file_get_contents(__DIR__ . '/Schema/schema.json');

        $data = json_decode($data);

        $validator = new Validator();
        $validator->setMaxErrors(5);

        $result = $validator->validate($data, $schema);

        if ($result->isValid()) {
            return true;
        }

        $error = $result->error();
        $formatter = new ErrorFormatter();

        $errors = $formatter->format($error, false);

        return false;
    }
}
