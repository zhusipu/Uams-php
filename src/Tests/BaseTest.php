<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/10/23
 * Time: 上午11:34
 */

namespace Bmzy\Tests;
require_once __DIR__ . '/../../vendor/autoload.php';


use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{

    /**
     * @assert
     */
    public function testIndex(){
        $this->assertEquals(true, true);
    }

    public function getConfig() {
        return [
            'clientId' =>  'bmzymtr',
            'clientSecret'    =>  'bmzymtrSecret',
            'resourceApiPrefix' =>  'http://127.0.0.1:8080/index/',
            'apiPrefix'   =>  'http://127.0.0.1:8082/'
        ];
    }

}