<?php

namespace AppBundle\Request\ParamConverter;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class productPostDataToProductConverter implements ParamConverterInterface
{
    /**
     * Stores the object in the request.
     *
     * @param Request $request The request
     * @param ParamConverter $configuration Contains the name, class and options of the object
     *
     * @return bool True if the object has been successfully set, else false
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        if (!$request->isMethod(Request::METHOD_POST)) {
            return false;
        }

        if (!$request->request->has('name')) {
            return false;
        }

        $name = $request->request->get('name');
        $request->attributes->set('product', new Product($name));
        return true;
    }

    /**
     * Checks if the object is supported.
     * @codeCoverageIgnore
     * @param ParamConverter $configuration Should be an instance of ParamConverter
     *
     * @return bool True if the object is supported, else false
     */
    public function supports(ParamConverter $configuration)
    {
        return true;
    }
}