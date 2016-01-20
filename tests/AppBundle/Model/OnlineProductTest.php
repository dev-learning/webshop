<?php

namespace AppBundle\Model;

class OnlineProductTest extends \PHPUnit_Framework_TestCase
{
    use ProductTest, DeletableProductTest;

    public function setUp()
    {
        $this->productUnderTest = new OnlineProduct();
    }
}
