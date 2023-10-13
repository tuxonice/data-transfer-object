<?php

namespace Tlab\Tests\Generated;

use Acme\Environment;
use DateTime;
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
     * @var CategoryTransfer
     */
    private CategoryTransfer $category;

    /**
     * @var string
     */
    private string $firstName;

    /**
     * @var string|null
     */
    private ?string $lastName;

    /**
     * @var DateTime
     */
    private DateTime $birthDate;

    /**
     * @var array<DateTime>
     */
    private array $timeTables = [];

    /**
     * @var Environment|null
     */
    private ?Environment $someOtherField;

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
     * @return CategoryTransfer
     */
    public function getCategory(): CategoryTransfer
    {
        return $this->category;
    }

    /**
     * @param CategoryTransfer $category
     *
     * @return $this
     */
    public function setCategory(CategoryTransfer $category): self
    {
        $this->category = $category;

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
     * @return DateTime
     */
    public function getBirthDate(): DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param DateTime $birthDate
     *
     * @return $this
     */
    public function setBirthDate(DateTime $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return array<DateTime>
     */
    public function getTimeTables(): array
    {
        return $this->timeTables;
    }

    /**
     * @param array<DateTime> $timeTables
     *
     * @return $this
     */
    public function setTimeTables(array $timeTables): self
    {
        $this->timeTables = $timeTables;

        return $this;
    }

    /**
     * @param DateTime $timeTable
     *
     * @return $this
     */
    public function addTimeTable(DateTime $timeTable): self
    {
        $this->timeTables[] = $timeTable;

        return $this;
    }
    /**
     * @return Environment|null
     */
    public function getSomeOtherField(): ?Environment
    {
        return $this->someOtherField;
    }

    /**
     * @param Environment|null $someOtherField
     *
     * @return $this
     */
    public function setSomeOtherField(?Environment $someOtherField): self
    {
        $this->someOtherField = $someOtherField;

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
