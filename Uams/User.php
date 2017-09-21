<?php
/**
 * Created by PhpStorm.
 * User: TT
 * Date: 2017/3/31
 * Time: 10:48
 */
namespace Bmzy\Uams;

use Bmzy\Uams\Base;

class User extends Base{
    const API_LOGIN = 'homev1/api/ucUserLogin';
    const API_UPDATEPASSWORD = 'homev1/Platform/updatePassword';
    const API_WPERSON = 'homev1/api/getWPerson';
    const API_WDEPT = 'homev1/api/getWDept';

    
    public function login($username,$password,$isuid = 0){
        $data = [
            'username'  =>  $username,
            'password'  =>  $password,
            'isuid' =>  $isuid
        ];
        return $this->doPost(self::API_LOGIN, $data,[],false);
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