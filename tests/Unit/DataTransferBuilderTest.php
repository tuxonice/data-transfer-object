<?php

namespace Tlab\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tlab\Tests\Generated\ProductTransfer;
use Tlab\TransferObjects\DataTransferBuilder;

class DataTransferBuilderTest extends TestCase
{
    public function setUp(): void
    {
        $this->generateTransfers();
        parent::setUp();
    }

    public function tearDown(): void
    {
//        $pattern = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated' . DIRECTORY_SEPARATOR . '*.php';
//        foreach (glob($pattern) as $filename) {
//            unlink($filename);
//        }
        parent::tearDown();
    }

    public function testBuildTransfer(): void
    {
        $pattern = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated' . DIRECTORY_SEPARATOR . '*.php';
        $generatedFiles = glob($pattern);

        $pattern = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Expected' . DIRECTORY_SEPARATOR . '*.php';
        $expectedFiles = glob($pattern);

        self::assertFileEquals($expectedFiles[0], $generatedFiles[0]);
        self::assertFileEquals($expectedFiles[1], $generatedFiles[1]);
        self::assertFileEquals($expectedFiles[2], $generatedFiles[2]);
        self::assertFileEquals($expectedFiles[3], $generatedFiles[3]);
    }

    public function testCanExportTransferClassToArray(): void
    {
        $productTransfer = new ProductTransfer();
        $productTransfer
            ->setName('test-name')
            ->setPrice(10.50)
            ->setSku('ABC123');
        self::assertEquals([
            'name' => 'test-name',
            'price' => 10.50,
            'sku' => 'ABC123',
        ], $productTransfer->toArray());
    }

    public function testCanImportTransferClassFromArray(): void
    {
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

    private function generateTransfers(): void
    {
        $dataTransferBuilder = new DataTransferBuilder(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Data',
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated',
            'Tlab\Tests\Generated'
        );
        $dataTransferBuilder->build();
    }
}
