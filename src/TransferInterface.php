<?php

namespace Tlab\TransferObjects;

interface TransferInterface
{
    /**
     * @return array<string,mixed>
     */
    public function toArray(): array;

    /**
     * @param array<string,mixed> $data
     * @return TransferInterface
     */
    public static function fromArray(array $data): TransferInterface;
}
