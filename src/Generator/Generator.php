<?php

namespace TransferObjects\Generator;

use TransferObjects\DefinitionBuilder;
use TransferObjects\OutputBuilder;

class Generator
{

    public function __construct(
        private readonly DefinitionBuilder $definitionBuilder,
        private readonly OutputBuilder $outputBuilder
    )
    {}

    public function generate(): bool
    {
        $template = $this->definitionBuilder->getTwigEnvironment()->load('class.twig');

        $classContent = $template->render(
            [
                'className' => 'Customer',
                'abstractClass' => 'AbstractTransfer',
                'properties' => [
                    [
                        'visibility' => 'private',
                        'type' => 'string',
                        'camelCaseName' => 'email',
                        'getPrefix' => 'get',
                    ],
                    [
                        'visibility' => 'private',
                        'type' => 'string',
                        'camelCaseName' => 'firstName',
                        'getPrefix' => 'get',
                    ],
                    [
                        'visibility' => 'private',
                        'type' => 'string',
                        'camelCaseName' => 'lastName',
                        'getPrefix' => 'get',
                    ],
                    [
                        'visibility' => 'private',
                        'type' => 'bool',
                        'camelCaseName' => 'isGuest',
                        'getPrefix' => 'is',
                    ]
                ],
            ]
        );

        $outputPath = $this->outputBuilder->getOutputPath();
        $this->outputBuilder->save($classContent, 'Customer');

        return true;
    }
}