<?php

namespace TripSorter\Transport;

class BusCard extends BaseBoardingCard
{
    /**
     * {@inheritdoc}
     */
    public function getRouteDescription(): string
    {
        $seat = empty($this->extraData['seat']) ? 'No seat assignment' : "Sit in seat {$this->extraData['seat']}";

        return sprintf(
            'Take the %s bus from %s to %s. Sit in seat %s',
            $this->extraData['name'],
            $this->getOrigin(),
            $this->getDestiny(),
            $seat
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getRequiredFields(): array
    {
        return ['name'];
    }
}
