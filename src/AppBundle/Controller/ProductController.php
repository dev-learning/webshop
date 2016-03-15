<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Service\ProductService;
use AppBundle\ValueObject\ProductFromAdmin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @var EngineInterface
     */
    private $templateEngine;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     * @param EngineInterface $templateEngine
     */
    public function __construct(ProductService $productService, EngineInterface $templateEngine)
    {
        $this->productService = $productService;
        $this->templateEngine = $templateEngine;
    }

    public function showAction()
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncode()]);
        $data = $this->productService->getAll();
        $jsonData = $serializer->serialize($data, 'json');

        return $this->templateEngine->renderResponse(
            'AppBundle:admin:productList.html.twig',
            array('products' => $jsonData)
        );
    }

    public function createAction()
    {
        $productFromAdmin = new ProductFromAdmin();
        $productData = Product::instantiateFromAdmin($productFromAdmin);
//        $productData = new ProductFromAdmin();
//        $productData->name = 'Wat NU?';

        return $this->templateEngine->renderResponse(
            'AppBundle:admin:productStore.html.twig',
            array('product' => $productData)
        );
    }
}
