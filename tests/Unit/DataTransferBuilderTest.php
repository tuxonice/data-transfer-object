<?php

namespace Tlab\Tests\Unit;


use PHPUnit\Framework\TestCase;
use Tlab\Tests\Generated\CategoryTransfer;
use Tlab\Tests\Generated\ProductTransfer;
use Tlab\TransferObjects\DataTransferBuilder;

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
        list($generatedFiles, $expectedFiles) = $this->generateTransfers();

        self::assertFileEquals($expectedFiles[0], $generatedFiles[0]);
        self::assertFileEquals($expectedFiles[1], $generatedFiles[1]);
        self::assertFileEquals($expectedFiles[2], $generatedFiles[2]);
    }

    public function testCanExportTransferClassToArray(): void
    {
        $this->markTestSkipped();
        $this->generateTransfers();

        $category = new CategoryTransfer();
        $category->setName('test-name');
        self::assertEquals([], $category->toArray());
    }

    public function testCanImportTransferClassFromArray(): void
    {
        $this->generateTransfers();

        $data = [
            'name' => 'test-product-name',
            'sku' => 'test-sku',
            'price' => 10.50,
        ];

        $productTransfer = ProductTransfer::fromArray($data);
        self::assertEquals($productTransfer->getName(), 'test-product-name');
        self::assertEquals($productTransfer->getSku(), 'test-sku');
        self::assertEquals($productTransfer->getPrice(), 10.50);
    }

    private function generateTransfers(): array
    {
        $dataTransferBuilder = new DataTransferBuilder(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Data',
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated',
            'Tlab\Tests\Generated'
        );
        $dataTransferBuilder->build();

        $pattern = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated' . DIRECTORY_SEPARATOR . '*.php';
        $generatedFiles = glob($pattern);

        $pattern = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Expected' . DIRECTORY_SEPARATOR . '*.php';
        $expectedFiles = glob($pattern);
        return array($generatedFiles, $expectedFiles);
    }
}