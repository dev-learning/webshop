<?php

namespace AppBundle\Request\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class productPostDataToProductConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testConvertorAddsProductToRequestWhenDataAvailableAndRequestIsPost()
    {
        $converter = new productPostDataToProductConverter();
        $request = new Request();
        $request->setMethod(Request::METHOD_POST);
        $request->request = new ParameterBag(['name' => 'testProduct']);
        $result = $converter->apply($request, new ParamConverter([]));

        self::assertTrue($result);
        self::assertEquals('testProduct', $request->get('product')->getName());
    }

    public function testConverterIgnoresGetRequests()
    {
        $converter = new productPostDataToProductConverter();
        $request = new Request();
        $request->setMethod(Request::METHOD_GET);

        $request->request = new ParameterBag(['name' => 'testProduct']);
        $result = $converter->apply($request, new ParamConverter([]));

        self::assertFalse($result);
        self::setExpectedException(\Exception::class, 'You have requested a non-existent parameter "product".');

        $request->get('product');
    }

    public function testConverterIgnoresRequestsWithoutTheCorrectParameters()
    {
        $converter = new productPostDataToProductConverter();
        $request = new Request();
        $request->setMethod(Request::METHOD_POST);

        $request->request = new ParameterBag(['productName' => 'testProduct']);
        $result = $converter->apply($request, new ParamConverter([]));

        self::assertFalse($result);
        self::setExpectedException(\Exception::class, 'You have requested a non-existent parameter "product".');

        $request->get('product');
    }
}
