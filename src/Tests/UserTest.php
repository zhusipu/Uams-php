<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/10/23
 * Time: 上午11:28
 */

namespace Bmzy\Tests;

class UserTest extends BaseTest
{
    /**
     * @assert
     */
    public function testLogin() {
        $config = $this->getConfig();
        $user = new \Bmzy\Uams\User($config);
        $result = $user->login("15010430507", "123456", 0, 1, "", "");
        $this->assertNotEmpty($result, false);
    }

}