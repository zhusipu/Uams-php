<?php

namespace Bmzy\Uams;

use \Bmzy\Util\HTTPClient;

/**
 * 构造用于访问API的基类
 * @package timecheer.weixin
 */
class Base extends \Bmzy\Base
{

    protected $errorCode = null;
    protected $errorMsg = '';


    /**
     * 构造函数、配置相关参数
     * @param string $accessToken 访问接口的$accessToken
     */
    public function __construct($accessToken = '', $config = [])
    {
        if ($accessToken) {
            $this->accessToken = $accessToken;
        }
        $this->initConfig($config);
        if (array_key_exists('resourceApiPrefix', $config)) {
            $this->apiPrefix = $config['resourceApiPrefix'];
        }
    }


}
