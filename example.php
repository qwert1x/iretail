<?php

require_once('vendor/autoload.php');

$item1 = new \AlexeyMakarov\IRetail\Item('Пополнение баланса', 10.00 , 1);

$product = new \AlexeyMakarov\IRetail\Product();
$product->addItem($item1);

$number = time();

$cash = new \AlexeyMakarov\IRetail\CashReceipt('API_HERE', 'LOGIN_HERE', $number, '2019-02-25 18:00:00', $product);
$cash->setMode(\AlexeyMakarov\IRetail\CashReceipt::MODE_EMAIL)
    ->setType(\AlexeyMakarov\IRetail\CashReceipt::TYPE_PAYMENT)
    ->setCustomerEmail('cust@localhost');

// $number = '1551169884';

// $cash = new \AlexeyMakarov\IRetail\CashReceipt('API_HERE', 'LOGIN_HERE', $number, '2019-02-25 18:00:00', $product);
// $cash->setMode(\AlexeyMakarov\IRetail\CashReceipt::MODE_EMAIL)
//     ->setType(\AlexeyMakarov\IRetail\CashReceipt::TYPE_REFUND)
//     ->setCustomerEmail('cust@localhost');

$api = new \AlexeyMakarov\IRetail\ApiClient();

var_dump($api->makeRequest($cash));
