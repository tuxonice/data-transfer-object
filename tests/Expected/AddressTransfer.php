<?php

namespace Tlab\Tests\Generated;

use Tlab\TransferObjects\AbstractTransfer;

/**
 * !!! THIS TRANSFER CLASS FILE IS AUTO-GENERATED, CHANGES WILL BREAK YOUR PROJECT
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class AddressTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    private string $streetName;

    /**
     * @var string
     */
    private string $city;

    /**
     * @var string
     */
    private string $zipCode;

    /**
     * @var bool
     */
    private bool $isDefaultBillingAddress;

    /**
     * @var bool
     */
    private bool $isDefaultShippingAddress;

    /**
     * @return string
     */
    public function getStreetName(): string
    {
        return $this->streetName;
    }

    /**
     * @param string $streetName
     *
     * @return $this
     */
    public function setStreetName(string $streetName): self
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     *
     * @return $this
     */
    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsDefaultBillingAddress(): bool
    {
        return $this->isDefaultBillingAddress;
    }

    /**
     * @param bool $isDefaultBillingAddress
     *
     * @return $this
     */
    public function setIsDefaultBillingAddress(bool $isDefaultBillingAddress): self
    {
        $this->isDefaultBillingAddress = $isDefaultBillingAddress;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsDefaultShippingAddress(): bool
    {
        return $this->isDefaultShippingAddress;
    }

    /**
     * @param bool $isDefaultShippingAddress
     *
     * @return $this
     */
    public function setIsDefaultShippingAddress(bool $isDefaultShippingAddress): self
    {
        $this->isDefaultShippingAddress = $isDefaultShippingAddress;

        return $this;
    }

}
