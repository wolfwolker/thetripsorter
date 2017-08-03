<?php

namespace TripSorter;

use TripSorter\Transport\BoardingCardInterface;
use TripSorter\Transport\BusCard;
use TripSorter\Transport\FlightCard;
use TripSorter\Transport\TaxiCard;
use TripSorter\Transport\TrainCard;

class TripSorter
{
    const DESTINATION_ARRIVAL_MESSAGE = 'You have arrived at your final destination.';

    /**
     * Given some cards info, it creates all needed scaffold, sorts the data and return it back as a readable array.
     *
     * @param array $boardingCardsInfo
     *
     * @return array
     */
    public function sort(array $boardingCardsInfo): array
    {
        $stack = new BoardingCardStack();

        foreach ($boardingCardsInfo as $cardData) {
            $stack->addBoardingCard($this->createBoardingCard($cardData));
        }

        return $this->getOutput($stack->getOrderedBoardingCards());
    }

    /**
     * @param array $boardingCards
     *
     * @return array
     */
    private function getOutput(array $boardingCards): array
    {
        $output = [];

        foreach ($boardingCards as $card) {
            $output[] = $card->getRouteDescription();
        }

        $output[] = self::DESTINATION_ARRIVAL_MESSAGE;

        return $output;
    }

    /**
     * @param array $cardData
     *
     * @return \TripSorter\Transport\BoardingCardInterface
     */
    private function createBoardingCard(array $cardData): BoardingCardInterface
    {
        $this->validateCardData($cardData);

        switch ($cardData['type']) {
            case 'train':
                return new TrainCard($cardData['origin'], $cardData['destiny'], $cardData);
            case 'bus':
                return new BusCard($cardData['origin'], $cardData['destiny'], $cardData);
            case 'taxi':
                return new TaxiCard($cardData['origin'], $cardData['destiny'], $cardData);
            case 'flight':
                return new FlightCard($cardData['origin'], $cardData['destiny'], $cardData);
        }

        throw new \InvalidArgumentException("boarding card type {$cardData['type']} is not valid");
    }

    /**
     * @param array $cardData
     */
    private function validateCardData(array $cardData): void
    {
        foreach (['type', 'origin', 'destiny'] as $item) {
            if (empty($cardData[$item])) {
                throw new \InvalidArgumentException("field {$item} is required on every boarding card");
            }
        }
    }
}
