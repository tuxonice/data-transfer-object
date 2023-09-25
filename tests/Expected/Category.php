<?php

namespace TransferObjects\DataTransferObjects;

use TransferObjects\AbstractTransfer;

class Category extends AbstractTransfer
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
