<?php

namespace AppBundle\Service;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;

class ProductService
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * ProductService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Product $product
     */
    public function store(Product $product)
    {
        $this->em->persist($product);
        $this->em->flush();
    }

    /**
     * @param Product $product
     */
    public function delete(Product $product)
    {
        $product->delete();
        $this->em->persist($product);
        $this->em->flush();
    }

    /**
     * @param Product $product
     * @throws \Exception
     */
    public function resume(Product $product)
    {
        $product->resume();
        $this->em->persist($product);
        $this->em->flush();
    }

    /**
     * @param Product $product
     * @throws \Exception
     */
    public function suspend(Product $product)
    {
        $product->suspend();
        $this->em->persist($product);
        $this->em->flush();
    }

}