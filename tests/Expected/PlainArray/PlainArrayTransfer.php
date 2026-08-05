<?php

namespace Tlab\Tests\Generated;

use Tlab\TransferObjects\AbstractTransfer;

/**
 * !!! THIS TRANSFER CLASS FILE IS AUTO-GENERATED, CHANGES WILL BREAK YOUR PROJECT
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class PlainArrayTransfer extends AbstractTransfer
{
    /**
     * @var array<mixed>
     */
    private array $meta = [];

    /**
     * @var array<mixed>|null
     */
    private ?array $payload = null;

    /**
     * @return array<mixed>
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @param array<mixed> $meta
     *
     * @return $this
     */
    public function setMeta(array $meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * @return array<mixed>|null
     */
    public function getPayload(): ?array
    {
        return $this->payload;
    }

    /**
     * @param array<mixed>|null $payload
     *
     * @return $this
     */
    public function setPayload(?array $payload): self
    {
        $this->payload = $payload;

        return $this;
    }

}
