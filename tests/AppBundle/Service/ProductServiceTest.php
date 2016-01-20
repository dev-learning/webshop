<?php

namespace AppBundle\Service;

class ProductServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testNewProductsAreSuspended()
    {
        self::assertEquals('suspended', (new ProductService())->getStatus());
    }

    public function testSuspendedProductsCanBeResumed()
    {
        $suspendedProduct = new ProductService();
        self::assertEquals('online', $suspendedProduct->resume()->getStatus());
    }

    public function testOnlineProductsCanBeSuspended()
    {
        $onlineProduct = (new ProductService())->resume();
        self::assertEquals('suspended', $onlineProduct->suspend()->getStatus());
    }

    public function testSuspendedProductsCanBeDeleted()
    {
        $suspendedProduct = new ProductService();
        self::assertEquals('deleted', $suspendedProduct->delete()->getStatus());
    }

    public function testOnlineProductsCanBeDeleted()
    {
        $onlineProduct = (new ProductService())->resume();
        self::assertEquals('deleted', $onlineProduct->delete()->getStatus());
    }

    public function testDeletedProductsCannotBeResumed()
    {
        self::setExpectedException(\Exception::class, 'A deleted product cannot be resumed');
        $deletedProduct = (new ProductService())->delete();
        $deletedProduct->resume();
    }

    public function testDeletedProductsCannotBeSuspended()
    {
        self::setExpectedException(\Exception::class, 'A deleted product cannot be suspended');
        $deletedProduct = (new ProductService())->delete();
        $deletedProduct->suspend();
    }
}
