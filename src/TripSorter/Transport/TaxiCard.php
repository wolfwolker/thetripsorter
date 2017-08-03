<?php

namespace TripSorter\Transport;

class TaxiCard extends BaseBoardingCard
{
    /**
     * {@inheritdoc}
     */
    public function getRouteDescription(): string
    {
        return sprintf(
            'From %s to %s, take a taxi',
            $this->getOrigin(),
            $this->getDestiny()
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getRequiredFields(): array
    {
        return [];
    }
}
