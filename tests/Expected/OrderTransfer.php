<?php

namespace Tlab\Tests\Generated;

use DateTime;
use Tlab\TransferObjects\AbstractTransfer;

/**
 * !!! THIS TRANSFER CLASS FILE IS AUTO-GENERATED, CHANGES WILL BREAK YOUR PROJECT
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class OrderTransfer extends AbstractTransfer
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var CustomerTransfer
     */
    private CustomerTransfer $customer;

    /**
     * @var float
     */
    private float $total;

    /**
     * @var array<orderItemTransfer>
     */
    private array $orderItems = [];

    /**
     * @var DateTime
     */
    private DateTime $createdAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return CustomerTransfer
     */
    public function getCustomer(): CustomerTransfer
    {
        return $this->customer;
    }

    /**
     * @param CustomerTransfer $customer
     *
     * @return $this
     */
    public function setCustomer(CustomerTransfer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     *
     * @return $this
     */
    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return array<orderItemTransfer>
     */
    public function getOrderItems(): array
    {
        return $this->orderItems;
    }

    /**
     * @param array<orderItemTransfer> $orderItems
     *
     * @return $this
     */
    public function setOrderItems(array $orderItems): self
    {
        $this->orderItems = $orderItems;

        return $this;
    }

    /**
     * @param orderItemTransfer $orderItem
     *
     * @return $this
     */
    public function addOrderItem(orderItemTransfer $orderItem): self
    {
        $this->orderItems[] = $orderItem;

        return $this;
    }
    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

}
