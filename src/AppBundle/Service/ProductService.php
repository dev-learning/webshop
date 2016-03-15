<?php

namespace AppBundle\Service;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class ProductService
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * ProductService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository('AppBundle\Entity\Product');
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    /**
     * @param Product $product
     */
    public function store(Product $product)
    {
        $this->save($product);
    }

    /**
     * @param Product $product
     */
    public function delete(Product $product)
    {
        $product->delete();
        $this->save($product);
    }

    /**
     * @param Product $product
     * @throws \Exception
     */
    public function resume(Product $product)
    {
        $product->resume();
        $this->save($product);
    }

    /**
     * @param Product $product
     * @throws \Exception
     */
    public function suspend(Product $product)
    {
        $product->suspend();
        $this->save($product);
    }

    /**
     * @param Product $product
     */
    private function save(Product $product)
    {
        $this->em->persist($product);
        $this->em->flush();
    }
}
