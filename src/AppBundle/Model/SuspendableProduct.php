<?php

namespace AppBundle\Model;

trait SuspendableProduct
{
    use ProductProperties;

    /**
     * @return SuspendedProduct
     */
    public function suspend()
    {
        return new SuspendedProduct($this->getName());
    }
}
