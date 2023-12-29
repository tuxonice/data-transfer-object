# Bare simple data transfer object

![Tests](https://github.com/tuxonice/data-transfer-object/actions/workflows/pipeline.yml/badge.svg)

In the ever-evolving landscape of software development, efficient and structured data communication is paramount.
DTO package is designed to streamline and enhance the way data is transferred between different layers of your
application,
promoting clarity, maintainability, and robustness.

Whether you're building a RESTful API, a microservices architecture, or a traditional web application,
Data Transfer Objects package empowers you to manage data flow with elegance and precision.
Elevate your code quality and simplify your data handling processes with our intuitive and developer-friendly DTO
solution.

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

6. Create definition file(s)

You can define one or more transfer objects definitions for each json file.
Start by creating a json object that will contain your definitions:

```json
{
  "transfers": [
  ]
}
```

and inside the transfers array define your transfer:

```json
{
  "name": "Customer",
  "properties": [
    {
      "name": "firstName",
      "type": "string"
    },
    {
      "name": "lastName",
      "type": "string"
    },
    {
      "name": "isActive",
      "type": "bool"
    }
  ]
}
```

- transfer class

| field                  | type   | required | Description                                                                                                           |
|------------------------|--------|----------|-----------------------------------------------------------------------------------------------------------------------|
| name                   | string | yes      | The transfer object name. The result class name will be this name concatenated with "Transfer". E.g. CustomerTransfer |
| properties             | array  | yes      | An array of objects with definition of each class property                                                            |
| immutable              | bool   | no       | Remove setters from the class. In this case the class name will end with "TransferImmutable"                          |
| deprecationDescription | string | no       | If present and not empty, will add an annotation with @deprecated, to mark this class as deprecated                   |

- class properties

| field                  | type   | required                         | Description                                                                                           |
|------------------------|--------|----------------------------------|-------------------------------------------------------------------------------------------------------|
| name                   | string | yes                              | field name in camelCase                                                                               |
| type                   | string | yes                              | The field type. Can be a native type (string, int, float, bool), or any other class                   |
| deprecationDescription | string | no                               | If present and with a text, will add an annotation with @deprecated, to mark this field as deprecated |
| nullable               | bool   | no                               | Set if the property can be null                                                                       |
| namespace              | string | yes if the type is another class | Namespace for the class in case the property type is another class                                    |
| singular               | string | yes if the type is an array      | Singular form of the property if the type is an array                                                 |

## Example of property definitions

- integer

```
...
{
  "name": "id",
  "type": "int"
}
...
```

- nullable string

```
...
{
  "name": "firstName",
  "type": "string",
  "nullable": true
}
...
```

- another transfer object as property

```
...
{
  "name": "customer",
  "type": "CustomerTransfer"
}
...
```

- DateTime property

```
...
{
  "name": "createdAt",
  "type": "DateTime",
  "namespace": "DateTime"
}
...
```

- Array of strings

```
...
{
  "name": "tags",
  "type": "string[]",
  "singular": "tag"
}
...
```

- Array of transfer objects

```
...
{
  "name": "categories",
  "type": "CategoryTransfer[]",
  "singular": "category"
},
...
```

- Symfony Response

```
...
{
  "name": "response",
  "type": "Response",
  "namespace": "\\Symfony\\Component\\HttpFoundation\\Response"
},
...
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
