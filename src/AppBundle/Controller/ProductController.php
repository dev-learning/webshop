<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param Product $product
     */
    public function createAction(Product $product)
    {
        $this->productService->store($product);
    }
}