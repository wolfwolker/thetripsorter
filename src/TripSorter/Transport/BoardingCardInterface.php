<?php

namespace TripSorter\Transport;

interface BoardingCardInterface
{
    /**
     * @return string
     */
    public function getOrigin(): string;

    /**.
     * @return string
     */
    public function getDestiny(): string;

    /**
     * Retrieves the route human readable description.
     *
     * @return string
     */
    public function getRouteDescription(): string;
}
