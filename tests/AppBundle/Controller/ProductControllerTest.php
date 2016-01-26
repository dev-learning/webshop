<?php

namespace Tests\AppBundle\Controller;


use AppBundle\Controller\ProductController;
use AppBundle\Entity\Product;
use AppBundle\Service\ProductService;

class ProductControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingProductStoresProduct()
    {
        $service = self::getMockBuilder(ProductService::class)
            ->disableOriginalConstructor()
            ->setMethods(['store'])
            ->getMock();

        $controller = new ProductController($service);
        $controller->createAction(new Product('test'));
    }
}
