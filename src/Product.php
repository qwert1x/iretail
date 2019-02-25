<?php

namespace AlexeyMakarov\IRetail;

class Product implements \JsonSerializable
{
    private $items;

    /**
     * @param Item $item
     * @return Product
     */
    public function addItem(Item $item) : Product
    {
        $this->items[] = $item;

        return $this;
    }

    public function getItems() : array
    {
        return $this->items;
    }

    public function jsonSerialize()
    {
        return $this->items;
    }
}
