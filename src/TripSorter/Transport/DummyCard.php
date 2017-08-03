<?php

namespace TripSorter\Transport;

class DummyCard extends BaseBoardingCard
{
    /**
     * {@inheritdoc}
     */
    public static function getRequiredFields(): array
    {
        return ['foo'];
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteDescription(): string
    {
        return '';
    }

    /**
     * @return array
     */
    public function getExtraData(): array
    {
        return $this->extraData;
    }
}
