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
        $this->cleanupOutputFolder();

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

    private function cleanupOutputFolder(): void
    {
        $filesToRemove = [];
        $dataTransferFiles = glob($this->outputPath . DIRECTORY_SEPARATOR . '*Transfer.php');
        $immutableDataTransferFiles = glob($this->outputPath . DIRECTORY_SEPARATOR . '*TransferImmutable.php');
        if ($dataTransferFiles !== false) {
            $filesToRemove = array_merge($filesToRemove, $dataTransferFiles);
        }
        if ($immutableDataTransferFiles !== false) {
            $filesToRemove = array_merge($filesToRemove, $immutableDataTransferFiles);
        }

        foreach ($filesToRemove as $filename) {
            if (is_file($filename) && is_writable($filename)) {
                unlink($filename);
            }
        }
    }
}
