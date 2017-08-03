<?php

namespace TripSorter;

use TripSorter\Transport\BoardingCardInterface;

/**
 * Class BoardingCardStack.
 */
class BoardingCardStack
{
    /** @var \TripSorter\Transport\BoardingCardInterface[] */
    private $cardStackByOrigin = [];
    /** @var \TripSorter\Transport\BoardingCardInterface[] */
    private $cardStackByDestiny = [];
    /** @var \TripSorter\Transport\BoardingCardInterface[] */
    private $boardingCardsOrderedStack;

    /**
     * Given a boardingCardInterface array it creates a sortable stack.
     *
     * @param array $boardingCards
     *
     * @return \TripSorter\BoardingCardStack
     */
    public static function createFromArray(array $boardingCards): BoardingCardStack
    {
        $instance = new self();
        foreach ($boardingCards as $boardingCard) {
            $instance->addBoardingCard($boardingCard);
        }

        return $instance;
    }

    /**
     * It pushes a boarding card to the unordered stack.
     *
     * @param \TripSorter\Transport\BoardingCardInterface $boardingCard
     */
    public function addBoardingCard(BoardingCardInterface $boardingCard): void
    {
        $this->cardStackByOrigin[$boardingCard->getOrigin()] = $boardingCard;
        $this->cardStackByDestiny[$boardingCard->getDestiny()] = $boardingCard;
        $this->boardingCardsOrderedStack = null;
    }

    /**
     * It sorts the stack.
     *
     * @throws \Exception if it can't find a route
     */
    public function sortBoardingCards(): void
    {
        $this->boardingCardsOrderedStack = [];

        $cards = $this->cardStackByOrigin;
        $current = $this->findNextCard($this->findTripBeginPlace(), $cards);

        while (count($cards)) {
            if (!array_key_exists($current->getDestiny(), $cards)) {
                throw new \Exception('Impossible to find your next stop, please check your boarding cards stack');
            }

            $current = $this->findNextCard($current->getDestiny(), $cards);
        }
    }

    /**
     * It returns the sorted stack.
     *
     * @return BoardingCardInterface[]
     */
    public function getOrderedBoardingCards(): array
    {
        if (!$this->boardingCardsOrderedStack) {
            $this->sortBoardingCards();
        }

        return $this->boardingCardsOrderedStack;
    }

    /**
     * @param string $place
     * @param array  $cardsStack
     *
     * @return \TripSorter\Transport\BoardingCardInterface
     */
    private function findNextCard(string $place, array &$cardsStack): BoardingCardInterface
    {
        $current = $cardsStack[$place];
        $this->boardingCardsOrderedStack[] = $current;
        unset($cardsStack[$place]);

        return $current;
    }

    /**
     * @return string
     *
     * @throws \Exception
     */
    private function findTripBeginPlace(): string
    {
        foreach ($this->cardStackByOrigin as $place => $card) {
            if (!array_key_exists($place, $this->cardStackByDestiny)) {
                return $place;
            }
        }

        throw new \Exception('Impossible to find the beginning of your trip, please check your boarding cards stack');
    }
}
