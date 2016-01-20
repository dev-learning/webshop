<?php

namespace AppBundle\Model;

use \PHPUnit_Framework_Assert as PHPUnit;

trait DeletableProductTest
{
    use ProductTest;

    public function testDeletedProductHasTypeDeletedProduct()
    {
        PHPUnit::assertInstanceOf(DeletableProduct::class, $this->productUnderTest->delete());
    }
}
