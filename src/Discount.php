<?php

namespace AlexeyMakarov\IRetail;

class Discount implements \JsonSerializable
{
    const TYPE_AMOUNT = 'amount';
    const TYPE_PERCENT = 'percent';

    /**
     * @var string
     */
    private $type;

    /**
     * @var float
     */
    private $value;

    /**
     * Discount constructor.
     * @param string $type Тип скидки
     * @param float $value Значение скидки
     */
    public function __construct(string $type, float $value)
    {
        $this->setType($type);
        $this->setValue($value);
    }

    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
            'value' => $this->getValue(),
        ];
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Discount
     */
    public function setType(string $type) : Discount
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return Discount
     */
    public function setValue(float $value) : Discount
    {
        $this->value = $value;
        return $this;
    }
}
