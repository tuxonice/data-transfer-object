<?php

namespace TransferObjects;

abstract class AbstractTransfer implements TransferInterface
{
    public function toArray(bool $isRecursive = true, bool $camelCasedKeys = false): array
    {
        return [];
    }

    public function fromArray(array $data, bool $ignoreMissingProperty = false): TransferInterface
    {
        return $this;
    }
}
