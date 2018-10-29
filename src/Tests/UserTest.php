<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/10/23
 * Time: 上午11:28
 */

namespace Bmzy\Tests;

use Bmzy\Uams\User;

class UserTest extends BaseTest
{
    public function testGetUserInfo() {
        $config = $this->getConfig();
        $user = new User(
            "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX25hbWUiOiIxIiwic2NvcGUiOlsiYWxsIl0sImNvbXBhbnkiOiJibXp5bXRyIiwiZXhwIjoxNTQwNTU1NTQyLCJhdXRob3JpdGllcyI6WyJhYWEiLCJST0xFX1VTRVIiXSwianRpIjoiYWU3ZGYwMDQtNjYxMC00YzQ3LTk5OTUtMjhjZjU4NTI5YmE4IiwiY2xpZW50X2lkIjoiYm16eW10ciJ9.eWcUQPf25HeGx5w4X6xABHZEXYFQfCiK8I05oJDOYJg",
            $config);
//
//        var_dump($user->getUserInfo());
//        var_dump($user->getErrorMsg());
    }
}