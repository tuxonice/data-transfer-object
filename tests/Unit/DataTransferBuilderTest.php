<?php

namespace Tlab\Tests\Unit;

use DateTime;
use PHPUnit\Framework\TestCase;
use Tlab\Tests\Generated\CategoryTransfer;
use Tlab\Tests\Generated\CustomerTransfer;
use Tlab\Tests\Generated\OrderItemTransfer;
use Tlab\Tests\Generated\OrderTransfer;
use Tlab\Tests\Generated\ProductTransfer;
use Tlab\TransferObjects\DataTransferBuilder;
use Tlab\TransferObjects\Exceptions\DefinitionException;

class DataTransferBuilderTest extends TestCase
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
        self::assertFileEquals($expectedFiles[4], $generatedFiles[4]);
        self::assertFileEquals($expectedFiles[5], $generatedFiles[5]);
        self::assertFileEquals($expectedFiles[6], $generatedFiles[6]);
        self::assertFileEquals($expectedFiles[7], $generatedFiles[7]);
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
            'categories' => [],
            'tags' => [],
        ], $productTransfer->toArray());
    }

    public function testCanExportTransferClassToArrayRecursivelyWithArrayOfStrings(): void
    {
        $productTransfer = new ProductTransfer();
        $productTransfer
            ->setName('test-name')
            ->setPrice(10.50)
            ->setSku('ABC123')
            ->setTags(['tag1', 'tag2']);
        self::assertEquals([
            'name' => 'test-name',
            'price' => 10.50,
            'sku' => 'ABC123',
            'categories' => [],
            'tags' => [
                'tag1',
                'tag2'
            ],
        ], $productTransfer->toArray(true));
    }

    public function testCanExportTransferClassToArrayRecursively(): void
    {
        $customerTransfer = new CustomerTransfer();
        $customerTransfer->setEmail('user@example.com')
            ->setBirthDate(new DateTime('2000-01-01'))
            ->setFirstName('Jonh')
            ->setLastName('Smith')
            ->setIsActive(true);

        $orderItemTransfer1 = new OrderItemTransfer();
        $orderItemTransfer1->setName('Chips')
            ->setPrice(5.99)
            ->setQuantity(1)
            ->setId(1);

        $orderItemTransfer2 = new OrderItemTransfer();
        $orderItemTransfer2->setName('Juice')
            ->setPrice(3.45)
            ->setQuantity(2)
            ->setId(2);

        $orderTransfer = new OrderTransfer();
        $orderTransfer->setCustomer($customerTransfer)
            ->setId(1)
            ->setCreatedAt(new DateTime('2023-10-01'))
            ->setTotal(10.00)
            ->setOrderItems([
                $orderItemTransfer1,
                $orderItemTransfer2
            ]);


        self::assertEquals([
            'id' => 1,
            'customer' => [
                'firstName' => 'Jonh',
                'lastName' => 'Smith',
                'email' => 'user@example.com',
                'birthDate' => new DateTime('2000-01-01'),
                'isActive' => true,
            ],
            'total' => 10.0,
            'orderItems' => [
                [
                    'id' => 1,
                    'name' => 'Chips',
                    'price' => 5.99,
                    'quantity' => 1,
                ],
                [
                    'id' => 2,
                    'name' => 'Juice',
                    'price' => 3.45,
                    'quantity' => 2,
                ],
            ],
            'createdAt' => new DateTime('2023-10-01'),
        ], $orderTransfer->toArray(true));
    }

    public function testCanExportTransferClassToArrayNonRecursively(): void
    {
        $customerTransfer = new CustomerTransfer();
        $customerTransfer->setEmail('user@example.com')
            ->setBirthDate(new DateTime('2000-01-01'))
            ->setFirstName('Jonh')
            ->setLastName('Smith')
            ->setIsActive(true);

        $orderItemTransfer1 = new OrderItemTransfer();
        $orderItemTransfer1->setName('Chips')
            ->setPrice(5.99)
            ->setQuantity(1)
            ->setId(1);

        $orderItemTransfer2 = new OrderItemTransfer();
        $orderItemTransfer2->setName('Juice')
            ->setPrice(3.45)
            ->setQuantity(2)
            ->setId(2);

        $orderTransfer = new OrderTransfer();
        $orderTransfer->setCustomer($customerTransfer)
            ->setId(1)
            ->setCreatedAt(new DateTime('2023-10-01'))
            ->setTotal(10.00)
            ->setOrderItems([
                $orderItemTransfer1,
                $orderItemTransfer2
            ]);


        self::assertEquals([
            'id' => 1,
            'customer' => (new CustomerTransfer())
                ->setFirstName('Jonh')
                ->setLastName('Smith')
                ->setEmail('user@example.com')
                ->setBirthDate(new DateTime('2000-01-01'))
                ->setIsActive(true),
            'total' => 10.0,
            'orderItems' => [
                (new OrderItemTransfer())
                    ->setId(1)
                    ->setName('Chips')
                    ->setPrice(5.99)
                    ->setQuantity(1),
                (new OrderItemTransfer())
                    ->setId(2)
                    ->setName('Juice')
                    ->setPrice(3.45)
                    ->setQuantity(2),
            ],
            'createdAt' => new DateTime('2023-10-01'),
        ], $orderTransfer->toArray(false));
    }

    public function testCanImportTransferClassFromArray(): void
    {
        $data = [
            'name' => 'test-product-name',
            'sku' => 'test-sku',
            'price' => 10.50,
            'categories' => [
                (new CategoryTransfer())->setName('test-category')
            ]
        ];

        $productTransfer = ProductTransfer::fromArray($data);
        self::assertEquals('test-product-name', $productTransfer->getName());
        self::assertEquals('test-sku', $productTransfer->getSku());
        self::assertEquals(10.50, $productTransfer->getPrice());
        self::assertEquals([
            (new CategoryTransfer())->setName('test-category')
        ], $productTransfer->getCategories());
    }

    public function testConvertToArrayFromArray(): void
    {
        $productTransfer1 = new ProductTransfer();
        $productTransfer1->setName('test-product-name')
            ->setSku('test-sku')
            ->setPrice(10.50)
            ->setTags(['red', 'small'])
            ->setCategories([
                (new CategoryTransfer())->setName('test-category-1'),
                (new CategoryTransfer())->setName('test-category-2'),
            ]);

        $productTransfer2 = ProductTransfer::fromArray($productTransfer1->toArray());
        self::assertEquals('test-product-name', $productTransfer2->getName());
        self::assertEquals('test-sku', $productTransfer2->getSku());
        self::assertEquals(10.50, $productTransfer2->getPrice());
        self::assertEquals(['red','small'], $productTransfer2->getTags());
        self::assertEquals([
            (new CategoryTransfer())->setName('test-category-1'),
            (new CategoryTransfer())->setName('test-category-2'),
        ], $productTransfer2->getCategories());
    }

    public function testCanImportTransferClassFromArrayWithUnknownField(): void
    {
        $data = [
            'name' => 'test-product-name',
            'sku' => 'test-sku',
            'brand' => 'test-brand',
            'price' => 10.50,
            'categories' => [
                (new CategoryTransfer())->setName('test-category')
            ]
        ];

        $productTransfer = ProductTransfer::fromArray($data);
        self::assertEquals('test-product-name', $productTransfer->getName());
        self::assertEquals('test-sku', $productTransfer->getSku());
        self::assertEquals(10.50, $productTransfer->getPrice());
        self::assertEquals([
            (new CategoryTransfer())->setName('test-category')
        ], $productTransfer->getCategories());
    }

    public function testNullablePropertyReturnNullValueIfNotSet(): void
    {
        $data = [
            'firstName' => 'Mary',
            'email' => 'user@example.com',
            'birthDate' => new DateTime('2000-03-14'),
            'isActive' => true,
        ];

        $customerTransfer = CustomerTransfer::fromArray($data);
        self::assertEquals('Mary', $customerTransfer->getFirstName());
        self::assertNull($customerTransfer->getLastName());
        self::assertEquals('user@example.com', $customerTransfer->getEmail());
        self::assertTrue($customerTransfer->getIsActive());
    }

    public function testBuildTransferWithInvalidDefinitionWillThrowException(): void
    {
        $this->expectException(DefinitionException::class);
        $this->expectExceptionMessage('Invalid definition file: '.dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Data/Invalid/invalid-definition.json');
        $dataTransferBuilder = new DataTransferBuilder(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Data/Invalid',
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated',
            'Tlab\Tests\Generated'
        );
        $dataTransferBuilder->build();
    }

    public function testBuildTransferWithMissingNamespaceWillThrowException(): void
    {
        $this->expectException(DefinitionException::class);
        $this->expectExceptionMessage('Namespace is missing');
        $dataTransferBuilder = new DataTransferBuilder(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Data',
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated',
            ''
        );
        $dataTransferBuilder->build();
    }

    public function testBuildTransferWithInvalidDefinitionPathWillThrowException(): void
    {
        $this->expectException(DefinitionException::class);
        $this->expectExceptionMessage('The definition path is missing or is not readable');
        $dataTransferBuilder = new DataTransferBuilder(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'not-valid',
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated',
            'Tlab\Tests\Generated'
        );
        $dataTransferBuilder->build();
    }

    public function testBuildTransferWithInvalidOutputPathWillThrowException(): void
    {
        $this->expectException(DefinitionException::class);
        $this->expectExceptionMessage('The output path is missing or is not writable');
        $dataTransferBuilder = new DataTransferBuilder(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Data',
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'not-valid',
            'Tlab\Tests\Generated'
        );
        $dataTransferBuilder->build();
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
