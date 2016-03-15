<?php

namespace AppBundle\Request\ParamConverter;

use AppBundle\ValueObject\ProductFromAdmin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductFromAdminConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration)
    {
        if (!$request->request->has('name')) {
            return false;
        }

        $productFromAdmin = new ProductFromAdmin();
        $productFromAdmin->name = $request->request->get('name');
        $request->request->set('productFromAdmin', $productFromAdmin);
        return true;
    }


    public function supports(ParamConverter $configuration)
    {
        return true;
    }

}
