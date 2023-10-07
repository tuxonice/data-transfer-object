# Bare simple data transfer object

![Tests](https://github.com/tuxonice/data-transfer-object/actions/workflows/pipeline.yml/badge.svg)


## Installation

You can install the package via composer:

```bash
composer require tuxonice/data-transfer-object
```

## Usage

The goal of this package is to create data transfer objects from json definitions as easy as possible. 

1. In your project create a folder to hold on the definition files

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
      "description": "DTO description",
      "properties": [
        {
          "name": "email",
          "type": "string",
          "nullable": false,
          "description": "The customer email"
        },
        {
          "name": "firstName",
          "type": "string",
          "nullable": false,
          "description": "The customer first name"
        },
        {
          "name": "lastName",
          "type": "string",
          "nullable": true,
          "description": "The customer last name"
        },
        {
          "name": "isGuest",
          "type": "bool",
          "description": "Is a guest customer",
          "deprecationDescription": "isGuest property is deprecated"
        }
      ]
    },
    {
      "name": "SomeOtherDataTransferObject",
      "description": "DTO description",
      "deprecationDescription": "This class is deprecated",
      "properties": [
        {
          "name": "id",
          "type": "int",
          "nullable": false,
          "description": "An integer field"
        },
        {
          "name": "name",
          "type": "string",
          "nullable": true,
          "description": "A string field"
        },
        {
          "name": "price",
          "type": "float",
          "description": "A float field"
        },
        {
          "name": "isActive",
          "type": "bool",
          "description": "A bool field",
          "deprecationDescription": "isActive property is deprecated"
        },
        {
          "name": "tags",
          "type": "string"
        }
      ]
    }
  ]
}
```

This definition will generate the following transfer classes:

```php
<?php

namespace Acme\DataTransferObjects;

use Tlab\TransferObjects\AbstractTransfer;

/**
 * !!! THIS TRANSFER CLASS FILE IS AUTO-GENERATED, CHANGES WILL BREAK YOUR PROJECT
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class CustomerTransfer extends AbstractTransfer
{
    private string $email;

    private string $firstName;

    private ?string $lastName;

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

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /** @deprecated isGuest property is deprecated */
    public function getIsGuest(): bool
    {
        return $this->isGuest;
    }

    /** @deprecated isGuest property is deprecated */
    public function setIsGuest(bool $isGuest): self
    {
        $this->isGuest = $isGuest;

        return $this;
    }
}
```

```php

namespace Acme\DataTransferObjects;

use Tlab\TransferObjects\AbstractTransfer;

/**
 * !!! THIS TRANSFER CLASS FILE IS AUTO-GENERATED, CHANGES WILL BREAK YOUR PROJECT
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 *
 * @deprecated This class is deprecated
 */
class SomeOtherDataTransferObjectTransfer extends AbstractTransfer
{
    private int $id;

    private ?string $name;

    private float $price;

    private bool $isActive;

    private string $tags;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /** @deprecated isActive property is deprecated */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /** @deprecated isActive property is deprecated */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getTags(): string
    {
        return $this->tags;
    }

    public function setTags(string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
