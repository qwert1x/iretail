<?php

require_once('vendor/autoload.php');

$item1 = new \AlexeyMakarov\IRetail\Item('Пополнение баланса', 600.00 , 1);

$product = new \AlexeyMakarov\IRetail\Product();
$product->addItem($item1);

$number = time();

$cash = new \AlexeyMakarov\IRetail\CashReceipt('API_HERE', 'LOGIN_HERE', $number, '2018-10-01 10:00:00', $product);
$cash->setMode(\AlexeyMakarov\IRetail\CashReceipt::MODE_EMAIL)
    ->setType(\AlexeyMakarov\IRetail\CashReceipt::TYPE_PAYMENT)
    ->setCustomerEmail('customer@localhost');

// $number = 'E-18-0123-012300-00001-00001';
//
// $cash = new \AlexeyMakarov\IRetail\CashReceipt('API_HERE', 'LOGIN_HERE', $number, '2018-05-08 15:00:00', $product);
// $cash->setMode(\AlexeyMakarov\IRetail\CashReceipt::MODE_EMAIL)
//     ->setType(\AlexeyMakarov\IRetail\CashReceipt::TYPE_REFUND)
//     ->setCustomerEmail('customer@localhost');

$api = new \AlexeyMakarov\IRetail\ApiClient();

var_dump($api->makeRequest($cash));
