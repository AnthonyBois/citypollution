<?php

namespace Formation\Test;

use Formation\Response;

class SyntaxeTest extends \PHPUnit\Framework\TestCase
{

    private function getResponseClass()
    {
        return new \ReflectionClass(Response::class);
    }

    private function getResponse()
    {
        return $this->getResponseClass()->newInstanceArgs([]);
    }
    
    /**
     * @covers \Formation\Response::__construct
     */
    public function testStatus200()
    {
        $attr = $this
        ->getResponseClass()
        ->getProperty("status");
        $attr->setAccessible(true);
        $value = $attr->getValue($this->getResponse());
        $this->assertTrue(200 === $value);
    }

    /**
     * @covers \Formation\Response::__construct
     * @expectedException \TypeError
     */
    public function testTypeError()
    {
      $response = $this->getResponse();
      $response->setBody([]);
    }

}
