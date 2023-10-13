<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use Tlab\Tests\Generated\CategoryTransfer;
use Tlab\Tests\Generated\ProductTransfer;
use Tlab\TransferObjects\DataTransferBuilder;

class DataTransferArrayTest extends TestCase
{
    public function setUp(): void
    {
        $this->generateTransfers();
        parent::setUp();
    }

    public function tearDown(): void
    {
        $pattern = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated' . DIRECTORY_SEPARATOR . '*.php';
        foreach (glob($pattern) as $filename) {
            unlink($filename);
        }
        parent::tearDown();
    }

    public function testCanAddArrayElement(): void
    {
        $productTransfer = new ProductTransfer();
        $productTransfer
            ->setName('test-name')
            ->setPrice(10.50)
            ->setSku('ABC123')
            ->addCategory((new CategoryTransfer())->setName('test-category-1'))
            ->addCategory((new CategoryTransfer())->setName('test-category-2'));
        self::assertEquals(
            [
                'name' => 'test-name',
                'price' => 10.50,
                'sku' => 'ABC123',
                'categories' => [
                    (new CategoryTransfer())->setName('test-category-1'),
                    (new CategoryTransfer())->setName('test-category-2'),
                ],
            ], $productTransfer->toArray()
        );
    }

    public function testCanSetArrayElement(): void
    {
        $categories = [
            (new CategoryTransfer())->setName('test-category-1'),
            (new CategoryTransfer())->setName('test-category-2'),
        ];

        $productTransfer = new ProductTransfer();
        $productTransfer
            ->setName('test-name')
            ->setPrice(10.50)
            ->setSku('ABC123')
            ->setCategories($categories);
        self::assertEquals(
            [
                'name' => 'test-name',
                'price' => 10.50,
                'sku' => 'ABC123',
                'categories' => [
                    (new CategoryTransfer())->setName('test-category-1'),
                    (new CategoryTransfer())->setName('test-category-2'),
                ],
            ],
            $productTransfer->toArray()
        );
    }

    public function testCanGetArrayElement(): void
    {
        $categories = [
            (new CategoryTransfer())->setName('test-category-1'),
            (new CategoryTransfer())->setName('test-category-2'),
        ];

        $productTransfer = new ProductTransfer();
        $productTransfer
            ->setName('test-name')
            ->setPrice(10.50)
            ->setSku('ABC123')
            ->setCategories($categories);
        self::assertEquals(
            [
                (new CategoryTransfer())->setName('test-category-1'),
                (new CategoryTransfer())->setName('test-category-2'),
            ],
            $productTransfer->getCategories()
        );
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
