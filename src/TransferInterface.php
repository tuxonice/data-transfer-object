<?php

namespace Tlab\TransferObjects;

interface TransferInterface
{
    public function toArray(bool $isRecursive = true): array;

    public static function fromArray(array $data, bool $ignoreMissingProperty = false): TransferInterface;
}
