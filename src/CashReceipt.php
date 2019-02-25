<?php

namespace AlexeyMakarov\IRetail;

class CashReceipt implements \JsonSerializable
{
    const MODE_PRINT = 'print';
    const MODE_EMAIL = 'email';
    const MODE_PRINT_EMAIL = 'print_email';

    const TYPE_PAYMENT = 'payment';
    const TYPE_REFUND = 'refund';

    private $api_key;
    private $login;
    private $external_order_id;
    private $external_order_time;
    private $mode;
    private $type;
    private $customer_phone;
    private $customer_email;
    private $purchase;
    private $card_amount;
    private $cash_amount;
    private $mc_amount;

    public function __construct(
        string $api_key,
        string $login,
        string $external_order_id,
        string $external_order_time,
        Product $purchase
    ) {
        $this->setApiKey($api_key);
        $this->setLogin($login);
        $this->setExternalOrderId($external_order_id);
        $this->setExternalOrderTime($external_order_time);
        $this->setPurchase($purchase);
    }

    public function jsonSerialize()
    {
        $result = [];
        $result['api_key'] = $this->getApiKey();
        $result['login'] = $this->getLogin();
        $result['external_order_id'] = $this->getExternalOrderId();
        $result['external_date_time'] = $this->getExternalOrderTime();
        $result['date_time'] = $this->getExternalOrderTime();
        $result['purchase']['products'] = $this->getPurchase();
        $result['card_amount'] = $this->getTotalSum();

        if ($this->getMode() != null) {
            $result['mode'] = $this->getMode();
        }

        if ($this->getType() != null) {
            $result['type'] = $this->getType();
        }

        if ($this->getCustomerPhone() != null) {
            $result['customer_phone'] = $this->getCustomerPhone();
        }

        if ($this->getCustomerEmail() != null) {
            $result['customer_email'] = $this->getCustomerEmail();
        }

        if ($this->getCashAmount() != null) {
            $result['cash_amount'] = $this->getCashAmount();
        }

        if ($this->getCardAmount() != null) {
            $result['card_amount'] = $this->getCardAmount();
        }

        if ($this->getMcAmount() != null) {
            $result['mc_amount'] = $this->getMcAmount();
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getApiKey() : string
    {
        return $this->api_key;
    }

    /**
     * @param mixed $api_key
     * @return CashReceipt
     */
    public function setApiKey(string $api_key) : CashReceipt
    {
        $this->api_key = $api_key;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin() : string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return CashReceipt
     * @throws \Exception
     */
    public function setLogin(string $login) : CashReceipt
    {
        if (preg_match('/^(7)[\d]{10}$/', $login)) {
            $this->login = $login;
        } else {
            throw new \Exception('Incorrect login format');
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getExternalOrderId() : string
    {
        return $this->external_order_id;
    }

    /**
     * @param mixed $external_order_id
     * @return CashReceipt
     */
    public function setExternalOrderId(string $external_order_id) : CashReceipt
    {
        $this->external_order_id = $external_order_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalOrderTime() : string
    {
        return $this->external_order_time;
    }

    /**
     * @param mixed $external_order_time
     * @return CashReceipt
     * @throws \Exception
     */
    public function setExternalOrderTime(string $external_order_time) : CashReceipt
    {
        if (\DateTime::createFromFormat('Y-m-d H:i:s', $external_order_time) !== false) {
            $this->external_order_time = $external_order_time;
        } else {
            throw new \Exception('DateFormat must be in "Y-m-d H:i:s" format');
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMode() : ?string
    {
        return $this->mode;
    }

    /**
     * @param mixed $mode
     * @return CashReceipt
     */
    public function setMode(?string $mode) : CashReceipt
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType() : ?string
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return CashReceipt
     */
    public function setType(?string $type) : CashReceipt
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerPhone() : ?string
    {
        return $this->customer_phone;
    }

    /**
     * @param mixed $customer_phone
     * @return CashReceipt
     * @throws \Exception
     */
    public function setCustomerPhone(?string $customer_phone) : CashReceipt
    {
        if ($customer_phone != null) {
            if (preg_match('/^(7)[\d]{10}$/', $customer_phone)) {
                $this->customer_phone = $customer_phone;
            } else {
                throw new \Exception('Incorrect login format');
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerEmail() : ?string
    {
        return $this->customer_email;
    }

    /**
     * @param mixed $customer_email
     * @return CashReceipt
     * @throws \Exception
     */
    public function setCustomerEmail(?string $customer_email) : CashReceipt
    {
        if ($customer_email != null) {
            if (filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
                $this->customer_email = $customer_email;
            } else {
                //throw new \Exception('Incorrent email format');
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPurchase() : Product
    {
        return $this->purchase;
    }

    /**
     * @param Product $products
     * @return CashReceipt
     */
    public function setPurchase(Product $products) : CashReceipt
    {
        $this->purchase = $products;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardAmount() : ?float
    {
        return $this->card_amount;
    }

    /**
     * @param mixed $card_amount
     * @return CashReceipt
     */
    public function setCardAmount(?float $card_amount) : CashReceipt
    {
        $this->card_amount = $card_amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCashAmount() : ?float
    {
        return $this->cash_amount;
    }

    /**
     * @param mixed $cash_amount
     * @return CashReceipt
     */
    public function setCashAmount(?float $cash_amount) : CashReceipt
    {
        $this->cash_amount = $cash_amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMcAmount() : ?float
    {
        return $this->mc_amount;
    }

    /**
     * @param mixed $mc_amount
     * @return CashReceipt
     */
    public function setMcAmount(?float $mc_amount) : CashReceipt
    {
        $this->mc_amount = $mc_amount;
        return $this;
    }

    private function getTotalSum()
    {
        $items = ($this->getPurchase())->getItems();

        $sum = 0;
        foreach ($items as $item) {
            $sum += $item->getPrice() * $item->getQuantity();
        }

        return $sum;
    }
}
