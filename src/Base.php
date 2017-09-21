<?php

namespace Bmzy;

use \Bmzy\Util\HTTPClient;

/**
 * 构造用于访问API的基类
 * @package timecheer.weixin
 */
class Base {

    protected $errorCode = null;
    protected $errorMsg = '';
    protected $errorData = null;

    protected $apiPrefix = '';
    
    protected $accessToken;


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
    public function doPost($api, array $data = array(), array $params = array(),$isSetAppKey = false, $dataJsonEncoded = true) {
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

    /**
     * 设置错误信息
     *
     * @param string $code 错误代码
     * @param string $msg 错误详细信息
     */
    public function setError($code, $msg = '',$data = null) {
        $this->errorCode = $code;
        $this->errorMsg = $msg;
        $this->errorData = $data;
    }

    /**
     * 获取错误代码
     *
     * @return string 错误代码
     */
    public function getErrorCode() {
        return $this->errorCode;
    }

    /**
     * 获取错误信息
     *
     * @return string 错误信息
     */
    public function getErrorMsg() {
        return $this->errorMsg;
    }
    /**
     * 获取错误信息
     *
     * @return string 错误信息
     */
    public function getErrorData() {
        return $this->errorData;
    }

}
