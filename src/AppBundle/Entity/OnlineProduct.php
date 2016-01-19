<?php

namespace AppBundle\Entity;

class OnlineProduct extends Product
{
    use DeletableProduct;

    /**
     * @return SuspendedProduct
     */
    public function suspend()
    {
        return new SuspendedProduct($this->getName());
    }
}
