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

    protected $clientId;

    protected $clientSecret;

    public function initConfig($config = []) {

        if (array_key_exists('clientId', $config)) {
            $this->clientId = $config['clientId'];
        }
        if (array_key_exists('clientSecret', $config)) {
            $this->clientSecret = $config['clientSecret'];
        }
        if (array_key_exists('apiPrefix', $config)) {
            $this->apiPrefix = $config['apiPrefix'];
        }
    }
    /**
     * 接口请求方法，具体接口都调用此方法进行请求
     * @param strin $api
     * @param array $params
     * @return string
     */
    public function doGet($api, array $params = array(), $header = [])
    {
        if ($this->accessToken) {
            $header[] = 'authorization:bearer ' . $this->accessToken;
        }
        $res = HTTPClient::get($this->apiPrefix . $api,
            $params,
            $header
        );
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
    public function doPost($api, array $data = array(), array $params = array(), $header = [], $dataJsonEncoded = true)
    {

        if (!$this->accessToken) {
            $header[] = 'authorization:bearer ' . $this->accessToken;
        }
        $url = $this->apiPrefix . $api . '?' . http_build_query($params);
        $res = HTTPClient::post($url, $data, $dataJsonEncoded, $header);

        if (false === $res) {
            $this->setError(HTTPClient::getErrorCode(), HTTPClient::getErrorMsg(), HTTPClient::getErrorData());
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
