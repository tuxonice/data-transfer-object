<?php

namespace TransferObjects;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class DefinitionBuilder
{

    public function getTwigEnvironment(): Environment
    {
        $loader = new FilesystemLoader(__DIR__ . '/Templates');
        return new Environment(
            $loader,
            [
                'cache' => false,
            ]
        );
    }
}