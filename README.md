# GOAPI.IO | PHP SDK

[![Test](https://github.com/goapi-io/php-sdk/actions/workflows/tests.yml/badge.svg)](https://github.com/goapi-io/php-sdk/actions/workflows/tests.yml)

This is the official GOAPI.IO SDK for PHP. It provides a set of functions and classes to interact with the Goapi API.

## Requirements

- PHP 8.1 or higher
- GuzzleHttp library

## Installation

You can install the SDK using Composer. Run the following command in your project directory:

```bash
composer require goapi-io/php-sdk
```

## Stock Market Data (IDX)

### Create Instance

To use the SDK, you need to include the autoloader and create an instance of the main class. Here is an example:

```php
require 'vendor/autoload.php';

$client = new GOAPI\IO\Client(['api_key' => 'your_api_key']);

$marketDataIDX = $client->createStockIDX();
```

### Get all listed companies

```php
$companies = $marketDataIDX->getCompanies();
```

The `$companies` response is a [`Collection`](src/Collection.php) with [`GOAPI\IO\Resources\Stock\Company`](src/Resources/Stock/Company.php) items data.

### Get Detail Company Profile

```php
$profile = $marketDataIDX->getProfile('BBCA');
```

### Get price by symbols

```php
$prices = $marketDataIDX->getStockPrices(['AALI','BBCA']);
```

The `$prices` is a [`Collection`](src/Collection.php) with [`StockPrice`](src/Resources/Stock/StockPrice.php) items data.

### Get historical price by symbol

```php
// maximum date range (from-to) is 1 year.
$historicalPrice = $marketDataIDX->getHistoricalData('BBCA', '2023-10-01', '2023-10-20');
```

The `$historicalPrice` is a [`Collection`](src/Collection.php) with [`StockPrice`](src/Resources/Stock/StockPrice.php) items data.

### Get trending, top loser, top gainer

```php
$trending = $marketDataIDX->getTrendingStocks();
$gainer = $marketDataIDX->getTopGainerStocks();
$loser = $marketDataIDX->getTopLoserStocks();
```

The `$trending`,`$gainer`, `$loser` is a [`Collection`](src/Collection.php) with [`StockPriceChange`](src/Resources/Stock/StockPriceChange.php) items data.

### Get Broker Summary

```php
$brokerSum = $marketDataIDX->getBrokerSummary('BBCA', '2023-10-30');
```

The `$brokerSum` is a [`Collection`](src/Collection.php) with [`BrokerSummary`](src/Resources/Stock/BrokerSummary.php) items data.

### Get stock indicators

```php
$indicators = $marketDataIDX->getStockIndicators(page: 1, date: '2023-10-30');
```

The `$indicators` is a [`Collection`](src/Collection.php) with [`StockIndicator`](src/Resources/Stock/StockIndicator.php) items data.

## Contributing

If you find any issues or have suggestions for improvement, please open an issue or submit a pull request on GitHub.
