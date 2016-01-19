<?php

namespace AppBundle\Entity;

class SuspendedProduct extends Product
{
    use DeletableProduct;

    /**
     * @return OnlineProduct
     */
    public function resume()
    {
        return new OnlineProduct($this->getName());
    }
}
