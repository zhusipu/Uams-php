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
            'appNo' =>  'portal-xz',
            'appKey'    =>  'YJO1Cyl4DcM67811',
            'apiPrefix' =>  'http://172.16.10.197:8080/index/'
        ];
    }

}