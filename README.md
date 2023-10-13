# Bare simple data transfer object

![Tests](https://github.com/tuxonice/data-transfer-object/actions/workflows/pipeline.yml/badge.svg)


## Installation

You can install the package via composer:

```bash
composer require tuxonice/data-transfer-object
```

## Usage

The goal of this package is to create data transfer objects from json definitions as easy as possible. 

1. In your project create a folder to hold on the definition files.

```bash
mkdir "src/dto-definitions"
```

2. Create a folder to hold on the generated data transfer objects

```bash
mkdir "src/DataTransferObjects"
```

3. Create a command to generate the DTO's. If you are using symfony console could be something like:

```php
namespace Acme\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tlab\TransferObjects\DataTransferBuilder;

class GenerateTransferCommand extends Command
{
    protected static $defaultName = 'transfer:generate';

    protected function configure(): void
    {
        $this
            ->setDescription('Generate transfer objects')
            ->setHelp('Generate transfer objects');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dataTransferBuilder = new DataTransferBuilder(
            dirname(__DIR__) . '/dto-definitions/',
            dirname(__DIR__) . '/DataTransferObjects/',
            'Acme\\DataTransferObjects',
        );
        $dataTransferBuilder->build();

        return Command::SUCCESS;
    }
}
```
4. Define the dto through the definition files

```src/dto-definitions/customer.json```

```json
{
  "transfers": [
    {
      "name": "Customer",
      "properties": [
        {
          "name": "email",
          "type": "string",
          "nullable": false
        },
        {
          "name": "category",
          "type": "CategoryTransfer"
        },
        {
          "name": "firstName",
          "type": "string"
        },
        {
          "name": "lastName",
          "type": "string",
          "nullable": true
        },
        {
          "name": "birthDate",
          "type": "DateTime",
          "namespace": "DateTime"
        },
        {
          "name": "timeTables",
          "type": "DateTime[]",
          "singular": "timeTable",
          "namespace": "DateTime"
        },
        {
          "name": "someOtherField",
          "type": "Environment",
          "namespace": "\\Acme\\Environment\\",
          "nullable": true
        },
        {
          "name": "isGuest",
          "type": "bool",
          "deprecationDescription": "isGuest property is deprecated"
        }
      ]
    },
    {
      "name": "SomeOtherDataTransferObject",
      "deprecationDescription": "This class is deprecated",
      "properties": [
        {
          "name": "id",
          "type": "int"
        },
        {
          "name": "name",
          "type": "string",
          "nullable": true
        },
        {
          "name": "price",
          "type": "float"
        },
        {
          "name": "tags",
          "type": "string[]",
          "singular": "tag"
        }
      ]
    }
  ]
}

```

This definition will generate the following transfer classes:

```php

namespace Tlab\Tests\Generated;

use Acme\Environment;
use DateTime;
use Tlab\TransferObjects\AbstractTransfer;

/**
 * !!! THIS TRANSFER CLASS FILE IS AUTO-GENERATED, CHANGES WILL BREAK YOUR PROJECT
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 *
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

```

```php

namespace Tlab\Tests\Generated;

use Tlab\TransferObjects\AbstractTransfer;

/**
 * !!! THIS TRANSFER CLASS FILE IS AUTO-GENERATED, CHANGES WILL BREAK YOUR PROJECT
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 *
 * @deprecated This class is deprecated
 */
class SomeOtherDataTransferObjectTransfer extends AbstractTransfer
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string|null
     */
    private ?string $name;

    /**
     * @var float
     */
    private float $price;

    /**
     * @var array<string>
     */
    private array $tags = [];

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

```



## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
