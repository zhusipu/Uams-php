<?php
/**
 * Created by PhpStorm.
 * User: TT
 * Date: 2017/3/31
 * Time: 10:48
 */
namespace Bmzy\Uams;

class Oauth extends \Bmzy\Base {



    const API_AUTHORIZE_URL = 'oauth/authorize';

    protected $apiPrefix = '';

    /**
     * Oauth constructor.
     */
    public function __construct($config = [])
    {
        $this->initConfig($config);
    }

    public function authorizeUrl($redirectUri = '') {
        return $this->apiPrefix.self::API_AUTHORIZE_URL."?response_type=code&client_id=".$this->clientId."&scope=all&redirect_uri=".urlencode($redirectUri);
    }

}