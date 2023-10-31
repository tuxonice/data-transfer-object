<?php

namespace Tlab\Tests\Generated;

use Tlab\TransferObjects\AbstractTransfer;

/**
 * !!! THIS TRANSFER CLASS FILE IS AUTO-GENERATED, CHANGES WILL BREAK YOUR PROJECT
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class ProductTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    private string $sku;

    /**
     * @var string|null
     */
    private ?string $name = null;

    /**
     * @var float
     */
    private float $price;

    /**
     * @var array<CategoryTransfer>
     */
    private array $categories = [];

    /**
     * @var array<string>
     */
    private array $tags = [];

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     *
     * @return $this
     */
    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return $this
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return array<CategoryTransfer>
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array<CategoryTransfer> $categories
     *
     * @return $this
     */
    public function setCategories(array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @param CategoryTransfer $category
     *
     * @return $this
     */
    public function addCategory(CategoryTransfer $category): self
    {
        $this->categories[] = $category;

        return $this;
    }
    /**
     * @return array<string>
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array<string> $tags
     *
     * @return $this
     */
    public function setTags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @param string $tag
     *
     * @return $this
     */
    public function addTag(string $tag): self
    {
        $this->tags[] = $tag;

        return $this;
    }
}
