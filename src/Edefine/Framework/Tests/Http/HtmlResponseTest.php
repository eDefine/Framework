<?php

namespace Edefine\Framework\Tests\Http;

use Edefine\Framework\Http\HtmlResponse;

class HtmlResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testContentTypeHeaderIsPresent()
    {
        $response = new HtmlResponse('foo');
        $response->addHeader('bar');

        $this->assertEquals(['Content-type: text/html; charset=utf-8', 'bar'], $response->getHeaders());
    }
}