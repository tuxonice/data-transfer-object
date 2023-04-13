<?php

namespace TransferObjects;

interface TransferInterface
{
    public function toArray(bool $isRecursive = true): array;

    public function fromArray(array $data, bool $ignoreMissingProperty = false): TransferInterface;
}
