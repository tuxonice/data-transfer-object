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
composer require tuxonice/transfer-objects
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

5. Define the dto through the definition file

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

This definition will generate the following transfer class:

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

## Usage

### Creating and set data

```php
$customerTransfer = new CustomerTransfer();
$customerTransfer
    ->setFirstName('John')
    ->setLastName('Smith')
    ->setEmail('user@example.com')
    ->setBirthDate(new DateTime('2000-01-01'))
    ->setIsActive(true);
```

### Get data

```php
$firstName = $customerTransfer->getFirstName(); // John
$lastName = $customerTransfer->getLastName(); // Smith
```

### Creating from array

When creating from array its possible to use both **camelCase** or **snake_case** as array keys

```php
$data = [
    'first_name' => 'John',
    'last_name' => 'Smith',
    'email' => 'user@example.com',
    'birth_date' => new DateTime('2000-01-01'),
    'is_active' => true),
];
$customerTransfer = CustomerTransfer::fromArray($data);

$data = [
    'streetName' => 'test street name',
    'city' => 'test-city',
    'zipCode' => '1999',
    'isDefaultBillingAddress' => true,
    'isDefaultShippingAddress' => false,
];
$addressTransfer = AddressTransfer::fromArray($data);
```

### Export to array

```php
$customerTransfer = new CustomerTransfer();
$customerTransfer
    ->setFirstName('John')
    ->setLastName('Smith')
    ->setEmail('user@example.com')
    ->setBirthDate(new DateTime('2000-01-01'))
    ->setIsActive(true);
    
$data = $customerTransfer->toArray();
```

will return:

```php
[
    'firstName' => 'John',
    'lastName' => 'Smith',
    'email' => 'user@example.com',
    'birthDate' => new DateTime('2000-01-01'),
    'isActive' => true,
]
```

The ``toArray()`` method has two parameters

```php
public function toArray(bool $isRecursive = false, bool $snakeCaseKeys = false): array
```

- ``isRecursive`` when true will also export child transfer objects to an array

```php
$customerTransfer = new CustomerTransfer();
$customerTransfer
    ->setEmail('user@example.com')
    ->setBirthDate(new DateTime('2000-01-01'))
    ->setFirstName('John')
    ->setLastName('Smith')
    ->setIsActive(true);

$orderItemTransfer1 = new OrderItemTransfer();
$orderItemTransfer1
    ->setName('Chips')
    ->setPrice(5.99)
    ->setQuantity(1)
    ->setId(1);

$orderItemTransfer2 = new OrderItemTransfer();
$orderItemTransfer2
    ->setName('Juice')
    ->setPrice(3.45)
    ->setQuantity(2)
    ->setId(2);

$orderTransfer = new OrderTransfer();
$orderTransfer
    ->setId(1)
    ->setCustomer($customerTransfer)
    ->setTotal(10.00)
    ->setOrderItems([
        $orderItemTransfer1,
        $orderItemTransfer2
    ])
    ->setCreatedAt(new DateTime('2023-10-01'));

$data = $orderTransfer->toArray(true);
```

will return:

```php
[
    'id' => 1,
    'customer' => [
        'firstName' => 'John',
        'lastName' => 'Smith',
        'email' => 'user@example.com',
        'birthDate' => new DateTime('2000-01-01'),
        'isActive' => true,
    ],
    'total' => 10.0,
    'orderItems' => [
        [
            'id' => 1,
            'name' => 'Chips',
            'price' => 5.99,
            'quantity' => 1,
        ],
        [
            'id' => 2,
            'name' => 'Juice',
            'price' => 3.45,
            'quantity' => 2,
        ],
    ],
    'createdAt' => new DateTime('2023-10-01'),
]
```

- ``snakeCaseKeys`` when true will also export array with *snake_case* keys (by default is *camelCase*)

```php
$customerTransfer = new CustomerTransfer();
$customerTransfer
    ->setFirstName('John')
    ->setLastName('Smith')
    ->setEmail('user@example.com')
    ->setBirthDate(new DateTime('2000-01-01'))
    ->setIsActive(true);
    
$data = $customerTransfer->toArray(false, true);
```

will return:

```php
[
    'first_name' => 'John',
    'last_name' => 'Smith',
    'email' => 'user@example.com',
    'birth_date' => new DateTime('2000-01-01'),
    'is_active' => true,
]
```

## Create definition file(s)

You can define one or more transfer objects definitions for each json file.
Start by creating a json object that will contain your definitions:

```json
{
  "transfers": [
  ]
}
```

and inside the ``transfers`` array define your transfer:

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

### Available fields

- Class

| Field                  | Type   | Required | Default | Description                                                                                                           |
|------------------------|--------|----------|---------|-----------------------------------------------------------------------------------------------------------------------|
| name                   | string | yes      | --      | The transfer object name. The result class name will be this name concatenated with "Transfer". E.g. CustomerTransfer |
| properties             | array  | yes      | --      | An array of objects with definition of each class property                                                            |
| immutable              | bool   | no       | false   | Remove setters from the class. In this case the class name will end with "TransferImmutable"                          |
| deprecationDescription | string | no       | ""      | If present and not empty, will add an annotation with @deprecated, to mark this class as deprecated                   |

- Class properties

| Field                  | Type   | Required                         | Default | Description                                                                                                                                       |
|------------------------|--------|----------------------------------|---------|---------------------------------------------------------------------------------------------------------------------------------------------------|
| name                   | string | yes                              | --      | field name in camelCase                                                                                                                           |
| type                   | string | yes                              | --      | The field type. Can be a native type (string, int, float, bool), or any other class. If the type ends with [], will mark the property as an array |
| deprecationDescription | string | no                               | ""      | If present and with a text, will add an annotation with @deprecated, to mark this field as deprecated                                             |
| nullable               | bool   | no                               | false   | Set if the property can be null. Can not be set to true when the type is an array                                                                 |
| namespace              | string | yes if the type is another class | --      | Namespace for the class in case the property type is another class (except another transfer object)                                               |
| singular               | string | yes if the type is an array      | --      | Singular form of the property if the type is an array                                                                                             |

### Example of property definitions

- integer

```json lines
{
  "name": "id",
  "type": "int"
}
```

- nullable string

```json lines
{
  "name": "firstName",
  "type": "string",
  "nullable": true
}
```

- another transfer object as property

```json lines
{
  "name": "customer",
  "type": "CustomerTransfer"
}
```

- DateTime property

```json lines
{
  "name": "createdAt",
  "type": "DateTime",
  "namespace": "DateTime"
}
```

- Array of strings

```json lines
{
  "name": "tags",
  "type": "string[]",
  "singular": "tag"
}
```

- Array of transfer objects

```json lines
{
  "name": "categories",
  "type": "CategoryTransfer[]",
  "singular": "category"
}
```

- Symfony Response

```json lines
{
  "name": "response",
  "type": "Response",
  "namespace": "\\Symfony\\Component\\HttpFoundation\\Response"
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
