<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/10/23
 * Time: 上午11:28
 */

namespace Bmzy\Tests;

use Bmzy\Uams\AccessToken;
use Bmzy\Uams\Oauth;

class OauthTest extends BaseTest
{

    public function testGetUrl() {
        $config = $this->getConfig();
        $oauth = new Oauth($config);
        $url = $oauth->authorizeUrl("http://tool.chinaz.com/tools/urlencode.aspx");
        echo $url;
        $this->assertNotEquals($url, null);
    }
    /**
     * @assert
     */
    public function testOauthToken() {
        $config = $this->getConfig();
        $accessToken = new AccessToken($config);
        $result = $accessToken->get("TnvL8N", "http://tool.chinaz.com/tools/urlencode.aspx");
        var_dump($result);
        var_dump($accessToken->getErrorMsg());
        //$this->assertNotEmpty($result, false);
    }

}