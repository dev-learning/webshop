<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Product
{
    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
        $this->status = ProductStatus::SUSPENDED;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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
