<?php
/**
 * Created by PhpStorm.
 * User: TT
 * Date: 2017/3/31
 * Time: 10:48
 */
namespace Bmzy\Uams\Apiv1;


class User extends Base{
    const API_LOGIN = 'homev1/api/ucUserLogin';
    const API_UPDATEPASSWORD = 'homev1/Platform/updatePassword';
    const API_RESETPASSWORD  = 'homev1/Platform/resetPassword';
    const API_WPERSON = 'homev1/api/getWPerson';
    const API_WDEPT = 'homev1/api/getWDept';

    public function login($username,$password,$isuid = 0, $getcookie = 0, $ua = "", $ipaddress = ""){
        $data = [
            'username'  =>  $username,
            'password'  =>  $password,
            'isuid' =>  $isuid,
            'getcookie' =>  $getcookie,
            'ua'    =>  $ua,
            'ipaddress' =>  $ipaddress
        ];
        return $this->doPost(self::API_LOGIN, $data,[],false, true);
    }

    /**
     * 用户重置密码
     * @param string $returnUrl  密码修改成功后的返回地址
     * @param string $personid  用户personId
     * @return string 用户要跳转的地址
     * @author lu
     */
    public function getResetPassword($returnUrl = '', $personid)
    {
        $data = array(
            'appNo'     =>  $this->appNo,
            'returnUrl' =>  urlencode($returnUrl),
            'personid'  =>  $personid,
            'sign'      =>  md5($this->appNo . $this->appKey . $returnUrl . $personid)
        );
        $str = '';
        foreach ($data as $k => $v)
            $str .= $k . '=' . $v . '&';
        $param = rtrim($str, '&');
        return $this->apiPrefix . self::API_RESETPASSWORD . '?' . $param;
    }

    public function getUpdatePassword($returnUrl='',$personid,$password){
        $data = [
            'appNo' =>  $this->appNo,
            'returnUrl' =>  urlencode($returnUrl),
            'personid'  =>  $personid,
            'password'  =>  $password,
            'sign'  =>  md5($this->appNo.$this->appKey.$returnUrl.$personid.$password)
        ];
        $str = '';
        foreach($data as $k=>$v){
            $str .= $k.'='.$v.'&';
        }
        return $this->apiPrefix.self::API_UPDATEPASSWORD.'?'.$str;
    }
	
	public function getWPerson($page=1,$rowNum=1000){
		$data = [
            'page'  =>  $page,
            'rowNum'  =>  $rowNum
        ];
        return $this->doPost(self::API_WPERSON, $data,[],false);
	}
	
	public function getWDept($page=1,$rowNum=1000){
		$data = [
            'page'  =>  $page,
            'rowNum'  =>  $rowNum
        ];
        return $this->doPost(self::API_WDEPT, $data,[],false);
	}
}