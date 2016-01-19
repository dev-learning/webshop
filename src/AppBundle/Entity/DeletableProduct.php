<?php

namespace AppBundle\Entity;

trait DeletableProduct
{
    use ProductProperties;

    /**
     * @return DeletedProduct
     */
    public function delete()
    {
        return new DeletedProduct($this->name);
    }
}