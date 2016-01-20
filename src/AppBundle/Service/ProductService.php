<?php

namespace AppBundle\Service;

use AppBundle\Entity\ProductStatus;

class ProductService
{
    /**
     * @var string
     */
    private $status;

    public function __construct()
    {
        $this->status = ProductStatus::SUSPENDED;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return ProductService
     * @throws \Exception
     */
    public function resume()
    {
        if ($this->status == ProductStatus::DELETED) {
            throw new \Exception('A deleted product cannot be resumed');
        }

        $this->status = ProductStatus::ONLINE;
        return $this;
    }

    /**
     * @return ProductService
     * @throws \Exception
     */
    public function suspend()
    {
        if ($this->status == ProductStatus::DELETED) {
            throw new \Exception('A deleted product cannot be suspended');
        }

        $this->status = ProductStatus::SUSPENDED;
        return $this;
    }

    /**
     * @return ProductService
     */
    public function delete()
    {
        $this->status = ProductStatus::DELETED;
        return $this;
    }
}
