<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use TransferObjects\DefinitionBuilder;
use TransferObjects\Generator\Generator;
use TransferObjects\OutputBuilder;

class GenerateTransferTest extends TestCase
{

    public function testGenerateTransfer(): void
    {
        $definitionBuilder = new DefinitionBuilder();

        $outputBuilderMock = $this->createMock(OutputBuilder::class);
        $outputBuilderMock->expects(self::once())
            ->method('getOutputPath')
            ->willReturn(dirname(__DIR__).'/Expected');

        $generator = new Generator($definitionBuilder, $outputBuilderMock);

        self::assertTrue($generator->generate());



    }
}