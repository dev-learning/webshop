<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Service\ProductService;
use AppBundle\ValueObject\ProductFromAdmin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends Controller implements TokenAuthenticatedController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $productData = new ProductFromAdmin();

        $form = $this->createFormBuilder($productData)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Maak product aan'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = Product::instantiateFromAdmin($productData);
            $productService = new ProductService($this->getDoctrine()->getManager());
            $productService->store($product);
        }

        return $this->render('AppBundle:admin:productStore.html.twig', ['form' => $form->createView()]);
    }
}
