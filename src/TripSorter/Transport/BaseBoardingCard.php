<?php

namespace TripSorter\Transport;

abstract class BaseBoardingCard implements BoardingCardInterface
{
    /** @var string */
    private $destiny;
    /** @var string */
    private $origin;
    /** @var array */
    protected $extraData;

    /**
     * BaseBoardingCard constructor.
     *
     * @param string $origin
     * @param string $destiny
     * @param array  $extraData
     */
    public function __construct(string $origin, string $destiny, array $extraData = [])
    {
        $this->validateExtraData($extraData);

        $this->destiny = $destiny;
        $this->origin = $origin;
        $this->extraData = $extraData;
    }

    /**
     * Looks for required fields in extra data.
     *
     * @param array $data
     */
    private function validateExtraData(array $data): void
    {
        foreach (static::getRequiredFields() as $field) {
            if (empty($data[$field])) {
                throw new \InvalidArgumentException("field {$field} is required for transport ".__CLASS__);
            }
        }
    }

    /**
     * Retrieves the required fields.
     *
     * @return array
     */
    abstract public static function getRequiredFields(): array;

    /**
     * {@inheritdoc}
     */
    public function getOrigin(): string
    {
        return $this->origin;
    }

    /**
     * {@inheritdoc}
     */
    public function getDestiny(): string
    {
        return $this->destiny;
    }
}
