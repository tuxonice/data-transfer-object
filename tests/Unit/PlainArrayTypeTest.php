<?php

namespace Tlab\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tlab\TransferObjects\DataTransferBuilder;

/**
 * A property declared as `array` carries no element type, unlike `string[]` or
 * `FooTransfer[]`. These cover the resulting class being valid PHP.
 */
class PlainArrayTypeTest extends TestCase
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

    public function testGeneratedClassIsValidPhp(): void
    {
        $filename = $this->generatedFile();

        exec(escapeshellarg(PHP_BINARY) . ' -l ' . escapeshellarg($filename) . ' 2>&1', $output, $exitCode);

        self::assertSame(0, $exitCode, implode(PHP_EOL, $output) . PHP_EOL . file_get_contents($filename));
    }

    public function testArrayPropertyDefaultsToAnEmptyArray(): void
    {
        self::assertStringContainsString('private array $meta = [];', $this->generatedSource());
    }

    public function testNullableArrayPropertyDefaultsToNull(): void
    {
        self::assertStringContainsString('private ?array $payload = null;', $this->generatedSource());
    }

    public function testNullableArrayPropertyHasASingleInitialiser(): void
    {
        self::assertStringNotContainsString('= [] = null', $this->generatedSource());
    }

    public function testNoAddMethodIsGeneratedWithoutAnElementType(): void
    {
        self::assertStringNotContainsString('public function add(', $this->generatedSource());
    }

    public function testDocBlocksDeclareAValidGeneric(): void
    {
        $source = $this->generatedSource();

        self::assertStringNotContainsString('array<>', $source);
        self::assertStringNotContainsString('array|null<>', $source);
        self::assertStringContainsString('@var array<mixed>', $source);
        self::assertStringContainsString('@var array<mixed>|null', $source);
    }

    public function testGetterAndSetterKeepTheNullableArrayType(): void
    {
        $source = $this->generatedSource();

        self::assertStringContainsString('public function getPayload(): ?array', $source);
        self::assertStringContainsString('public function setPayload(?array $payload): self', $source);
    }

    private function generatedFile(): string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated' . DIRECTORY_SEPARATOR . 'PlainArrayTransfer.php';
    }

    private function generatedSource(): string
    {
        return (string)file_get_contents($this->generatedFile());
    }

    public function testGeneratedClassMatchesTheExpectedOutput(): void
    {
        self::assertFileEquals(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Expected' . DIRECTORY_SEPARATOR
            . 'PlainArray' . DIRECTORY_SEPARATOR . 'PlainArrayTransfer.php',
            $this->generatedFile()
        );
    }

    private function generateTransfers(): void
    {
        $dataTransferBuilder = new DataTransferBuilder(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Data' . DIRECTORY_SEPARATOR . 'PlainArray',
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Generated',
            'Tlab\Tests\Generated'
        );
        $dataTransferBuilder->build();
    }
}
