<?php

namespace AppBundle\Service;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;

class ProductServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateNewProduct()
    {
        $entityManager = self::getMockBuilder(EntityManager::class)
            ->disableProxyingToOriginalMethods()
            ->disableOriginalConstructor()
            ->getMock();


        $entity = new Product('test');
        $expectedEntity = clone $entity;
        $this->injectPropertyValue($expectedEntity, 'id', '1');

        $productService = new ProductService($entityManager);
        $productService->persist($entity);

        self::assertEquals($expectedEntity, $entity);
    }

    /**
    * Inject $value into a closed $property of $entity, using reflection.
    *
    * @param object $entity
    * @param string $property
    * @param mixed $value
    */
    private function injectPropertyValue($entity, $property, $value)
    {
        $reflectionClass = new \ReflectionClass(get_class($entity));
        $property = $reflectionClass->getProperty($property);

        // Open up the property, change the value en change the accessibility back.
        // Then run. Hard. Far. Wide. Just go. Don't look back.
        $property->setAccessible(true);
        $property->setValue($entity, $value);
        $property->setAccessible(false);
    }
}
