<?php

namespace AlexeyMakarov\IRetail;

class Item implements \JsonSerializable
{
    const VAT_NONE = null;
    const VAT_0 = 0;
    const VAT_10 = 0.1;
    const VAT_18 = 0.18;

    const UNIT_PIECE = 'piece';
    const UNIT_KG = 'kg';
    const UNIT_G = 'g';
    const UNIT_L = 'L';
    const UNIT_ML = 'ml';

    private $name;
    private $price;
    private $quantity;
    private $vat;
    private $unit;
    private $discount;

    /**
     * Item constructor.
     * @param string $name Наименование позиции
     * @param string $price Цена за единицу
     * @param string $quantity Количество товаров в позиции
     * @param float $vat Налог на позицию
     * @param string|null $unit Единица измерения
     * @param Discount|null $discount Скидка на позицию
     */
    public function __construct(string $name, string $price, string $quantity, ?float $vat = self::VAT_NONE, ?string $unit = null, ?Discount $discount = null)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setQuantity($quantity);
        $this->setVat($vat);
        $this->setUnit($unit);
        $this->setDiscount($discount);
    }

    public function jsonSerialize() : array
    {
        $result = [];
        $result['name'] = $this->getName();
        $result['price'] = $this->getPrice();
        $result['quantity'] = $this->getQuantity();
        if ($this->getVat() != null) {
            $result['vat'] = $this->getVat();
        }
        if ($this->getUnit() != null) {
            $result['unit'] = $this->getUnit();
        }
        if ($this->getDiscount() != null) {
            $result['discount'] = $this->getDiscount();
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name Наименование позиции
     * @return Item
     */
    public function setName(string $name) : Item
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice() : float
    {
        return (float)$this->price;
    }

    /**
     * @param float $price Цена за единицу
     * @return Item
     */
    public function setPrice(float $price) : Item
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity() : float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity Количество товаров в позиции
     * @return Item
     */
    public function setQuantity(float $quantity) : Item
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVat() : ?float
    {
        return $this->vat;
    }

    /**
     * @param mixed $vat Налог на позицию
     * @return Item
     */
    public function setVat(?float $vat) : Item
    {
        $this->vat = $vat;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit() : ?string
    {
        return $this->unit;
    }

    /**
     * @param string $unit Единица измерения
     * @return Item
     */
    public function setUnit(?string $unit) : Item
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount Скидка на позицию
     * @return Item
     */
    public function setDiscount(?Discount $discount) : Item
    {
        $this->discount = $discount;
        return $this;
    }
}
