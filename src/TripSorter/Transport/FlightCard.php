<?php

namespace TripSorter\Transport;

class FlightCard extends BaseBoardingCard
{
    /**
     * {@inheritdoc}
     */
    public function getRouteDescription(): string
    {
        return sprintf(
            'From %s, take flight %s to %s. Gate %s, seat %s. %s',
            $this->getOrigin(),
            $this->extraData['name'],
            $this->getDestiny(),
            $this->extraData['gate'],
            $this->extraData['seat'],
            ($this->extraData['baggageTransfer'] ?? false) ?
                'Baggage will we automatically transferred from your last leg.' :
                ''
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getRequiredFields(): array
    {
        return ['name', 'seat', 'gate'];
    }
}
