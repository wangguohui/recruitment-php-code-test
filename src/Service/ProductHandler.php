<?php

namespace App\Service;

class ProductHandler
{
    private $products;

    public function __construct(Array $products)
    {
        $this->products = $products;
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            if ($product['price'] > 0) {
                $totalPrice += $product['price'];
            }
        }

        return $totalPrice;
    }

    public function sortByPrice($type = '')
    {
        $products = $prices = [];

        if ($type != '') {
            $type = strtolower($type);
            foreach ($this->products as $product) {
                if ($type == strtolower($product['type'])) {
                    $products[] = $product;
                }
            }
        } else {
            $products = $this->products;
        }

        $prices = array_column($products, 'price');
        array_multisort($prices, SORT_DESC, $products);

        return $products;
    }

    public function transTimestamp()
    {
        foreach ($this->products as $k => $product) {
            $this->products[$k]['create_at'] = strtotime($product['create_at']);
        }
    }

}