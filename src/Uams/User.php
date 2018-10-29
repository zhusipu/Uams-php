<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/10/26
 * Time: 上午9:59
 */
namespace Bmzy\Uams;

class User extends Base {

    const API_GET_USER_INFO = '/resource/user/me';

    public function getUserInfo() {
        return $this->doGet(self::API_GET_USER_INFO);
    }

}