<?php

namespace AppBundle\Request\ParamConverter;

use AppBundle\ValueObject\ProductFromAdmin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class ProductFromAdminConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testParamConverterDoesNothingWhenNoDataIsAvailable()
    {
        $converter = new ProductFromAdminConverter();
        $request = new Request();

        self::assertFalse($converter->apply($request, new ParamConverter([])));
        self::assertNull($request->get('productFromAdmin'));
    }

    public function testParamConverterAddsProductFromAdminWhenDataIsAvailable()
    {
        $converter = new ProductFromAdminConverter();
        $request = new Request();
        $productName = 'de naam';
        $request->request->set('name', $productName);
        $productFromAdmin = new ProductFromAdmin();
        $productFromAdmin->name = $productName;

        self::assertTrue($converter->apply($request, new ParamConverter([])));
        self::assertEquals($productFromAdmin, $request->get('productFromAdmin'));
    }
}
