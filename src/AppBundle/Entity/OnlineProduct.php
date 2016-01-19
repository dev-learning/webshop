<?php

namespace AppBundle\Entity;

class OnlineProduct extends Product
{
    use DeletableProduct;

    public function __construct()
    {
        $this->status = ProductStatus::ONLINE;
    }

    /**
     * @return SuspendedProduct
     */
    public function suspend()
    {
        return new SuspendedProduct();
    }
}
