<?php

namespace TripSorter\Transport;

class TrainCard extends BaseBoardingCard
{
    /**
     * {@inheritdoc}
     */
    public function getRouteDescription(): string
    {
        return sprintf(
            'Take train %s from %s to %s. Sit in seat %s',
            $this->extraData['name'],
            $this->getOrigin(),
            $this->getDestiny(),
            $this->extraData['seat']
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getRequiredFields(): array
    {
        return ['name', 'seat'];
    }
}
