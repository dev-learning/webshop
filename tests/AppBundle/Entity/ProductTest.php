<?php

namespace AppBundle\Entity;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    public function testIfPriceReturnsATrueFormattedPrice()
    {
        $price = (new Product())->setPrice(4)->getPrice();
        self::assertEquals(4.00, $price);

        $price = (new Product())->setPrice('4,54')->getPrice();
        self::assertEquals(4.54, $price);

        $price = (new Product())->setPrice('4.54')->getPrice();
        self::assertEquals(4.54, $price);
    }

    public function testIfSalePriceReturnsATrueFormattedSalePrice()
    {
        $price = (new Product())->setSalePrice(4)->getSalePrice();
        self::assertEquals(4.00, $price);

        $price = (new Product())->setSalePrice('4,54')->getSalePrice();
        self::assertEquals(4.54, $price);

        $price = (new Product())->setSalePrice('4.54')->getSalePrice();
        self::assertEquals(4.54, $price);
    }

    public function testIfSalePriceIsBiggerThanNullAndSmallerOrEqualsPrice()
    {
        $normalPrice = (new Product())->setPrice(4.95)->getPrice();
        $salePrice = (new Product())->setSalePrice(4.95)->getSalePrice();
        self::assertEquals($normalPrice, $salePrice);

        $salePrice = (new Product())->setSalePrice(4.95)->getSalePrice();
        self::assertFalse($salePrice);

        $normalPrice = (new Product())->setPrice(4.94)->getPrice();
        $salePrice = (new Product())->setSalePrice(4.95)->getSalePrice();
        self::assertGreaterThanOrEqual($normalPrice, $salePrice);
    }
}