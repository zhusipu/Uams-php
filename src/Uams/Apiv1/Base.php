<?php

namespace Bmzy\Uams\Apiv1;

use \Bmzy\Util\HTTPClient;

/**
 * 构造用于访问API的基类
 * @package timecheer.weixin
 */
class Base extends \Bmzy\Base{

    protected $errorCode = null;
    protected $errorMsg = '';
    
    protected $apiPrefix = '';

    protected $oauthPrefix = '';

    protected $appNo;
    protected $appKey;

    /**
     * 构造函数、配置相关参数
     * @param string $accessToken   访问接口的$accessToken
     */
    public function __construct($options = []) {
		
        if (isset($options['apiPrefix'])) {
            $this->apiPrefix = $options['apiPrefix'];
        }
        if (isset($options['appNo'])) {
            $this->initAppNo($options['appNo']);
        }
        if(isset($options['appKey'])){
            $this->initAppKey($options['appKey']);
        }
        if(isset($options['oauthPrefix'])){
            $this->oauthPrefix = $options['oauthPrefix'];
        }
    }

    /**
     * 配置参数
     *
     * @param string $accessToken   访问接口的$accessToken
     */
    public function initAppNo($appNo) {
        $this->appNo = $appNo;
    }
    public function initAppKey($appKey) {
        $this->appKey = $appKey;
    }


    /**
     * 接口请求方法，具体接口都调用此方法进行请求
     * @param strin $api
     * @param array $params
     * @return string
     */
    public function doGet($api, array $params = array(),$isSetAppKey = false) {
        $auth = [
            'appNo' => $this->appNo
        ];
        if($isSetAppKey){
            $auth['appKey'] =  $this->appKey;
        }
        $res = HTTPClient::get($this->apiPrefix . $api, array_merge(
            $params,$auth
        ));
        if (false === $res) {
            $this->setError(-10, HTTPClient::getErrorMsg());
            return false;
        }

        return $res;
    }

    /**
     * 接口请求方法，具体接口都调用此方法进行请求
     * @param strin $api
     * @param array $data post的数据
     * @param array $params url中构造的参数
     * @param bool $dataJsonEncoded post发出数据的格式是否需要json编码 默认为false表示常规,true json
     * @return string
     */
    public function doPost($api, array $data = array(), array $params = array(), $dataJsonEncoded = true,$isSetAppKey = false) {
        $auth = [
            'appNo' => $this->appNo
        ];
        if($isSetAppKey){
            $auth['appKey'] =  $this->appKey;
        }
        $url = $this->apiPrefix . $api . '?' . http_build_query(array_merge(
                $params,$auth
            ));
        $res = HTTPClient::post($url, $data, $dataJsonEncoded);

        if (false === $res) {
            $this->setError( HTTPClient::getErrorCode(), HTTPClient::getErrorMsg(), HTTPClient::getErrorData());
            return false;
        }

        return $res;
    }
}
