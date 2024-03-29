<?php

namespace Tlab\TransferObjects;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class OutputBuilder
{
    /**
     * @param string $outputPath
     * @param array<int,array<string, mixed>> $definitions
     */
    public function __construct(
        private readonly string $outputPath,
        private readonly array $definitions,
    ) {
    }

    public function save(): void
    {
        $template = $this->getTwigEnvironment()->load('class.twig');

        foreach ($this->definitions as $definition) {
            $classContent = $template->render($definition);
            $filename = $this->outputPath . '/' . $definition['className'] . '.php';
            file_put_contents($filename, $classContent);
            chmod($filename, 0777);
        }
    }

    private function getTwigEnvironment(): Environment
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
