<?php

namespace AppBundle\Entity;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    public function testNewProductsAreSuspended()
    {
        self::assertEquals('suspended', (new Product())->getStatus());
    }

    public function testSuspendedProductsCanBeResumed()
    {
        $suspendedProduct = new Product();
        self::assertEquals('online', $suspendedProduct->resume()->getStatus());
    }

    public function testOnlineProductsCanBeSuspended()
    {
        $onlineProduct = (new Product())->resume();
        self::assertEquals('suspended', $onlineProduct->suspend()->getStatus());
    }

    public function testSuspendedProductsCanBeDeleted()
    {
        $suspendedProduct = new Product();
        self::assertEquals('deleted', $suspendedProduct->delete()->getStatus());
    }

    public function testOnlineProductsCanBeDeleted()
    {
        $onlineProduct = (new Product())->resume();
        self::assertEquals('deleted', $onlineProduct->delete()->getStatus());
    }

    public function testDeletedProductsCannotBeResumed()
    {
        self::setExpectedException(\Exception::class, 'A deleted product cannot be resumed');
        $deletedProduct = (new Product())->delete();
        $deletedProduct->resume();
    }

    public function testDeletedProductsCannotBeSuspended()
    {
        self::setExpectedException(\Exception::class, 'A deleted product cannot be suspended');
        $deletedProduct = (new Product())->delete();
        $deletedProduct->suspend();
    }
}
