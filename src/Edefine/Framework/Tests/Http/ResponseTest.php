<?php

namespace Edefine\Framework\Tests\Http;

use Edefine\Framework\Http\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testGetContent()
    {
        $response = new Response('foo');

        $this->assertEquals('foo', $response->getContent());
    }

    public function testGetHeaders()
    {
        $response = new Response('foo');

        $response->addHeader('bar');
        $response->addHeader('baz');

        $this->assertEquals(['bar', 'baz'], $response->getHeaders());
    }
}