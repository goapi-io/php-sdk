# GOAPI.IO | PHP SDK

[![Test](https://github.com/goapi-io/php-sdk/actions/workflows/tests.yml/badge.svg)](https://github.com/goapi-io/php-sdk/actions/workflows/tests.yml)

This is the official GOAPI.IO SDK for PHP. It provides a set of functions and classes to interact with the Goapi API.

## Installation

You can install the SDK using Composer. Run the following command in your project directory:

```bash
composer require goapi-io/php-sdk
```

## Usage

To use the SDK, you need to include the autoloader and create an instance of the main class. Here is an example:

```php
require 'vendor/autoload.php';

$client = new GOAPI\IO\Client(['api_key' => 'your_api_key']);

$stockIDX = $client->createStockIDX();

// Use the client to call various API endpoints
$response = $client->getCompanies();
```

## Requirements

- PHP 8.1 or higher
- GuzzleHttp library

## Contributing

If you find any issues or have suggestions for improvement, please open an issue or submit a pull request on GitHub.
