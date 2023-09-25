<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use TransferObjects\DataTransferBuilder;

class DataTransferBuilderTest extends TestCase
{
    public function setUp(): void
    {
        $pattern = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated'. DIRECTORY_SEPARATOR . '*.php';
        foreach (glob($pattern) as $filename) {
            unlink($filename);
        }
    }

    public function testBuildTransfer(): void
    {
        $dataTransferBuilder = new DataTransferBuilder(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Data',
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated',
        );
        $dataTransferBuilder->build();

        $pattern = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated'. DIRECTORY_SEPARATOR . '*.php';
        $generatedFiles = glob($pattern);

        $pattern = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Expected'. DIRECTORY_SEPARATOR . '*.php';
        $expectedFiles = glob($pattern);

        self::assertFileEquals($expectedFiles[0], $generatedFiles[0]);
        self::assertFileEquals($expectedFiles[1], $generatedFiles[1]);
        self::assertFileEquals($expectedFiles[2], $generatedFiles[2]);
    }
}