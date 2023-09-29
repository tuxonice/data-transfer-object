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

```src/dto-definitions/products.json```

```json
{
  "transfers": [
    {
      "name": "Product",
      "properties": [
        {
          "name": "sku",
          "type": "string",
          "nullable": false
        },
        {
          "name": "name",
          "type": "string",
          "nullable": true
        },
        {
          "name": "price",
          "type": "float",
          "nullable": false
        }
      ]
    },
    {
      "name": "Category",
      "properties": [
        {
          "name": "name",
          "type": "string",
          "nullable": false
        }
      ]
    }
  ]
}
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
