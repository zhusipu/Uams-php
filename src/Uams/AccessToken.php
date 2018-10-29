<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/10/26
 * Time: 上午9:22
 */
namespace Bmzy\Uams;

use Bmzy\Util\HTTPClient;

class AccessToken extends \Bmzy\Base {
    const API_GET_TOKEN = 'oauth/token';

    protected $errorCode;
    protected $errorMsg;


    /**
     * AccessToken constructor.
     * @param $clientId
     * @param $clientSecret
     * @param string $apiPrefix
     */
    public function __construct($config = [])
    {
        $this->initConfig($config);
    }

    public function get($code, $redirectUri) {
        $parmas = [
            'grant_type' =>  'authorization_code',
            'code' =>  $code,
            'redirect_uri'  => $redirectUri
        ];

        $res = $this->request(self::API_GET_TOKEN, $parmas);

        if ($res && !array_key_exists('access_token', $res)) {
            return false;
        }
        return $res;
    }

    public function request($api, $params = array()) {
        $header = [
            0   =>  'authorization:Basic '.base64_encode($this->clientId.':'.$this->clientSecret)
        ];
        return $this->doGet($api, $params, $header);
    }
}