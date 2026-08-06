<?php

namespace Tlab\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tlab\TransferObjects\OutputBuilder;

class OutputBuilderTest extends TestCase
{
    private string $outputPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->outputPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid('dto-output-', true);
        mkdir($this->outputPath);
    }

    protected function tearDown(): void
    {
        foreach ((array)glob($this->outputPath . DIRECTORY_SEPARATOR . '*') as $filename) {
            unlink((string)$filename);
        }
        rmdir($this->outputPath);

        parent::tearDown();
    }

    /**
     * Cleanup runs before the classes are written, so this also guards against
     * the cleanup removing what the same run just generated.
     */
    public function testSaveGeneratesTheDefinedTransferClass(): void
    {
        $outputBuilder = new OutputBuilder($this->outputPath, [$this->categoryDefinition()]);

        $outputBuilder->save();

        self::assertFileExists($this->outputPath . DIRECTORY_SEPARATOR . 'CategoryTransfer.php');
    }

    public function testSaveRemovesTransferFilesThatAreNoLongerDefined(): void
    {
        $staleFile = $this->outputPath . DIRECTORY_SEPARATOR . 'RemovedTransfer.php';
        file_put_contents($staleFile, '<?php // generated from a definition that no longer exists');

        $outputBuilder = new OutputBuilder($this->outputPath, [$this->categoryDefinition()]);
        $outputBuilder->save();

        self::assertFileDoesNotExist($staleFile);
    }

    public function testSaveRemovesImmutableTransferFilesThatAreNoLongerDefined(): void
    {
        $staleFile = $this->outputPath . DIRECTORY_SEPARATOR . 'RemovedTransferImmutable.php';
        file_put_contents($staleFile, '<?php // generated from a definition that no longer exists');

        $outputBuilder = new OutputBuilder($this->outputPath, [$this->categoryDefinition()]);
        $outputBuilder->save();

        self::assertFileDoesNotExist($staleFile);
    }

    public function testSaveKeepsFilesThatAreNotGeneratedTransfers(): void
    {
        $unrelatedFile = $this->outputPath . DIRECTORY_SEPARATOR . 'Helper.php';
        file_put_contents($unrelatedFile, '<?php // hand written, not generated');

        $outputBuilder = new OutputBuilder($this->outputPath, [$this->categoryDefinition()]);
        $outputBuilder->save();

        self::assertFileExists($unrelatedFile);
    }

    /**
     * @return array<string,mixed>
     */
    private function categoryDefinition(): array
    {
        return [
            'namespace' => 'Tlab\Tests\Generated',
            'className' => 'CategoryTransfer',
            'abstractClass' => 'AbstractTransfer',
            'useNamespaces' => [
                'Tlab\TransferObjects\AbstractTransfer',
            ],
            'deprecationDescription' => null,
            'immutable' => false,
            'properties' => [
                [
                    'type' => 'string',
                    'camelCaseName' => 'name',
                    'nullable' => false,
                    'deprecationDescription' => null,
                ],
            ],
        ];
    }
}