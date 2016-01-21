<?php

namespace AppBundle\Entity;

class Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
     */
    public function delete()
    {
        $this->status = ProductStatus::DELETED;
        return $this;
    }
}
