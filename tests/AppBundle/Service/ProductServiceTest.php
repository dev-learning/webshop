<?php

namespace AppBundle\Service;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductStatus;
use Doctrine\ORM\EntityManager;

class ProductServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EntityManager|\PHPUnit_Framework_MockObject_MockObject
     */
    private $entityManager;

    /**
     * @var ProductService
     */
    private $productService;

    public function setUp()
    {
        $this->entityManager = self::getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['persist', 'flush'])
            ->getMock();
        $this->productService = new ProductService($this->entityManager);
    }

    public function testProductShouldBePersistWhenYouWillStore()
    {
        $product = new Product('test');

        $this->entityManager->expects(self::once())
            ->method('persist')
            ->with($product);

        $this->entityManager->expects(self::once())
            ->method('flush');

        $this->productService->store($product);
    }

    public function testProductShouldBePersistedAndFlushedWhenDeletingTheProduct()
    {
        $product = new Product('test');

        $this->entityManager->expects(self::once())
            ->method('persist')
            ->with($product);

        $this->entityManager->expects(self::once())
            ->method('flush');

        $this->productService->delete($product);
    }

    public function testProductStatusWillBeSetToDeletedWhenProductServiceDeletesProduct()
    {
        $product = new Product('test');
        $this->productService->delete($product);
        self::assertEquals(ProductStatus::DELETED, $product->getStatus());
    }

    public function testProductShouldBePersistedAndFlushedWhenResumingTheProduct()
    {
        $product = new Product('test');

        $this->entityManager->expects(self::once())
            ->method('persist')
            ->with($product);

        $this->entityManager->expects(self::once())
            ->method('flush');

        $this->productService->resume($product);
    }

    public function testProductStatusWillBeSetToOnlineWhenProductServiceResumingProduct()
    {
        $product = new Product('test');
        $this->productService->resume($product);
        self::assertEquals(ProductStatus::ONLINE, $product->getStatus());
    }

    public function testProductShouldBeSuspendedAndFlushedWhenSuspendTheProduct()
    {
        $product = new Product('test');

        $this->entityManager->expects(self::once())
            ->method('persist')
            ->with($product);

        $this->entityManager->expects(self::once())
            ->method('flush');

        $this->productService->suspend($product);
    }

    public function testProductStatusWillBeSetToSuspendedWhenProductServiceSuspendingProduct()
    {
        $product = new Product('test');
        $this->productService->suspend($product);
        self::assertEquals(ProductStatus::SUSPENDED, $product->getStatus());
    }
//
//    /**
//    * Inject $value into a closed $property of $entity, using reflection.
//    *
//    * @param object $entity
//    * @param string $property
//    * @param mixed $value
//    */
//    private function injectPropertyValue($entity, $property, $value)
//    {
//        $reflectionClass = new \ReflectionClass(get_class($entity));
//        $property = $reflectionClass->getProperty($property);
//
//        // Open up the property, change the value en change the accessibility back.
//        // Then run. Hard. Far. Wide. Just go. Don't look back.
//        $property->setAccessible(true);
//        $property->setValue($entity, $value);
//        $property->setAccessible(false);
//    }
}
