<?php

namespace Test\App;

use PHPUnit\Framework\TestCase;
use App\Service\AppLogger;
use PharIo\Manifest\Application;

require(dirname(__FILE__) . '/../../src/App/Demo.php');
/**
 * Class DemoTest
 */
class DemoTest extends TestCase
{
    public function testGetUserinfo()
    {
        $demo = new \Demo(new AppLogger(), new \HttpRequest());
        var_dump($demo->get_user_info());
    }
}