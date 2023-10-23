# Bare simple data transfer object

![Tests](https://github.com/tuxonice/data-transfer-object/actions/workflows/pipeline.yml/badge.svg)


## Installation

You can install the package via composer:

```bash
composer require tuxonice/data-transfer-object
```

## Setup

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
4. For Laravel projects:

```bash
php artisan make:command GenerateTransfer
```

```php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use Tlab\TransferObjects\DataTransferBuilder;
 
class GenerateTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:generate';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate data transfer objects';
 
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $dataTransferBuilder = new DataTransferBuilder(
            dirname(__DIR__) . '/dto-definitions/',
            dirname(__DIR__) . '/DataTransferObjects/',
            'Acme\\DataTransferObjects',
        );
        $dataTransferBuilder->build();
    }
}

```

5. Define the dto through the definition files

```src/dto-definitions/customer.json```

```json
{
  "transfers": [
    {
      "name": "Customer",
      "properties": [
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
          "name": "email",
          "type": "string",
          "nullable": false
        },
        {
          "name": "birthDate",
          "type": "DateTime",
          "namespace": "DateTime"
        },
        {
          "name": "isActive",
          "type": "bool"
        }
      ]
    }
  ]
}

```

This definition will generate the following transfer classes:

```php

namespace Acme\DataTransferObjects;

use DateTime;
use Tlab\TransferObjects\AbstractTransfer;

/**
 * !!! THIS TRANSFER CLASS FILE IS AUTO-GENERATED, CHANGES WILL BREAK YOUR PROJECT
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class CustomerTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    private string $firstName;

    /**
     * @var string|null
     */
    private ?string $lastName;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var DateTime
     */
    private DateTime $birthDate;

    /**
     * @var bool
     */
    private bool $isActive;

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
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     *
     * @return $this
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}

```



## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
