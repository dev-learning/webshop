<?php

namespace AppBundle\Entity;

trait DeletableProduct
{
    /**
     * @return DeletedProduct
     */
    public function delete()
    {
        return new DeletedProduct($this->name);
    }
}