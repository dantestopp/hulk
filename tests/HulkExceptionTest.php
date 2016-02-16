<?php

require_once __DIR__.'/../vendor/autoload.php';

class HulkExceptionTest extends PHPUnit_Framework_TestCase{

    public static function setUpBeforeClass()
    {
        Hulk\Hulk::smash();
    }
    /**
    * @expectedException     \ErrorException
    */
    public function testErrorException(){
        throw new Hulk\Core\HulkException();
    }

    /**
     * @expectedException Hulk\Core\HulkException
     * @expectedExceptionMessage failed
     * @expectedExceptionCode 200
     */
    public function testHulkException(){
        throw new Hulk\Core\HulkException('failed', 200);
    }
}
