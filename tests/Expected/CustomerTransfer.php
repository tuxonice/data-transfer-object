<?php

namespace Tlab\Tests\Generated;

use Tlab\TransferObjects\AbstractTransfer;

/**
 * !!! THIS TRANSFER CLASS FILE IS AUTO-GENERATED, CHANGES WILL BREAK YOUR PROJECT
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 *
 * @deprecated This class is deprecated
 */
class CustomerTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $firstName;

    /**
     * @var string|null
     */
    private ?string $lastName;

    /**
     * @var bool
     */
    private bool $isGuest;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     *
     * @return $this
     */
    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return bool
     *
     * @deprecated isGuest property is deprecated
     */
    public function getIsGuest(): bool
    {
        return $this->isGuest;
    }

    /**
     * @param bool $isGuest
     *
     * @return $this
     *
     * @deprecated isGuest property is deprecated
     */
    public function setIsGuest(bool $isGuest): self
    {
        $this->isGuest = $isGuest;

        return $this;
    }

}
