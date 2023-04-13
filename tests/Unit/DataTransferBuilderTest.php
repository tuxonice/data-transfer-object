<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use TransferObjects\DataTransferBuilder;

class DataTransferBuilderTest extends TestCase
{

    public function testBuildTransfer(): void
    {
        $this->markTestSkipped();

        $dataTransferBuilder = new DataTransferBuilder(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Data',
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Expected',
        );
        $dataTransferBuilder->build();
    }
}