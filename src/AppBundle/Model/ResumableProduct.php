<?php

namespace AppBundle\Model;

trait ResumableProduct
{
    use ProductProperties;

    /**
     * @return OnlineProduct
     */
    public function resume()
    {
        return new OnlineProduct($this->getName());
    }
}
