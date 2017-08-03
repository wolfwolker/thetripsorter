# Trip sorter

this package allows to sort some transport boardings cards in order to get your trip route.

## Requirements

- php7
- composer

## Installation

1. clone the repository or add it to your project main composer.json file
1. run composer install to get the dependencies

## Usage

- You can use the trip sorter with \TripSorter\TripSorter class (arrays as input/output)
- You can use also \TripSorter\BoardingCardsStack directly (BoardingCardInterface as input/output)

In both cases you only need to instantiate the object and call the method sort or getOrderedBoardingCards
(first method if you use TripSorter or second one if you use BoardingCardsStack)

## Extending the model

The package provides two abstractions to allow you to create new transport methods: BoardingCardInterface and BaseBoardingCard,
use whatever you want.

## QA

- run `php vendor/bin/phpunit` to run the unit tests
- run `php vendor/bin/php-cs-fixer fix --dry-run` to check all code standards are met

## TODO

- The first thing I would improve is to create a factory to instantiate BoardingCards, this would be very useful if
you include this library in a project with dependency injection.
- Second thing I would do is to ad a dockerfile and a docker-compose file to manage the dev environment.
- Third thing would be to improve the tests.