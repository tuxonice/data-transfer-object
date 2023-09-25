<?php

namespace TransferObjects\DataTransferObjects;

use TransferObjects\AbstractTransfer;

class Customer extends AbstractTransfer
{
    private string $email;

    private string $firstName;

    private string $lastName;

    private bool $isGuest;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstname(): string
    {
        return $this->firstName;
    }

    public function setFirstname(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastName;
    }

    public function setLastname(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getIsguest(): bool
    {
        return $this->isGuest;
    }

    public function setIsguest(bool $isGuest): self
    {
        $this->isGuest = $isGuest;

        return $this;
    }
}
