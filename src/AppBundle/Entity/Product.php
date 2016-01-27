<?php

namespace AppBundle\Entity;

use AppBundle\ValueObject\ProductFromAdmin;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Product
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=20)
     */
    private $status;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $name;

    /**
     * Product constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->status = ProductStatus::SUSPENDED;
    }

    /**
     * @param ProductFromAdmin $data
     * @return Product
     */
    public static function instantiateFromAdmin(ProductFromAdmin $data)
    {
        return new self($data->name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
        if ($this->getStatus() == ProductStatus::DELETED) {
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
        if ($this->getStatus() == ProductStatus::DELETED) {
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
