<?php

namespace app\back\model;

use think\Cache;
use think\Config;
use think\Model;

class Getui extends Model{

    /**
     * 获取authtoken,从缓存中获取
     * 有效时间是1天，如果超时则重新获取
     * 为了保险起见，保存时间为23小时，超时刷新
     */
    public function getAuthToken(){
		// 从缓存中获取 [缓存中保存的字段标识是：getui_auth_token]
        $authToken=Cache::get('getui_auth_token');
        // 如果存在token参数,则说明没有过期
        if($authToken){
            // 返回auth_token
            return $authToken;
        }else{
            // 刷新token，会返回数组格式
            $res=$this->refreshAuthToken();
            // 返回的数组中 result=ok 代表获取成功
            if($res['result']=='ok'){
                // 向缓存中存储 token,有效时间是23小时
                Cache::set('getui_auth_token',$res['auth_token'],82800);
                return $res['auth_token'];
            }
            return false;
        }
    }
     /**
     * 刷新或者初次获取 authtoken
     * 通过 restAPI刷新
     * protected 方法
     */
    protected function refreshAuthToken(){
        // 从配置中获取相关的数据
        $appKey=Config::get('getui.appkey');
        $appId=Config::get('getui.appid');
        $masterSecret=Config::get('getui.mastersecret');
        // 获取毫秒数 秒数*1000
        $timestamp=time()*1000;
        // 构建sign
        $sign=strtolower(hash('sha256',$appKey.$timestamp.$masterSecret,false));
        // 构建需要发送的数据
        $dataArr=[
            'sign'=>$sign,
            'timestamp'=>$timestamp,
            'appkey'=>$appKey,
        ];
        // 个推所有的api发送的数据都是json格式，因此不能发送函数，需要发送json
        $content=json_encode($dataArr);
        // 构建header
        $header=array(
            'Content-Type: application/json',
        );
        $url='https://restapi.getui.com/v1/'.$appId.'/auth_sign';
        // 发送http post请求
        $res=$this->postjson($url,$header,$content);
        $res=json_decode($res,true);
        // 返回数组格式,如果res.result是ok，说明没问题
        return $res;
    }
    /**
     * 关闭鉴权
     */
    public function closeAuthToken(){
        $appId=Config::get('getui.appid');
        // 获取auth_token,调用函数获取，如果超时则会自动刷新
        $authToken=$this->getAuthToken();
        if(!$authToken){
            return false;
        }
         // 构建header
        $header=[
            'Content-Type: application/json',
            'authtoken:'.$authToken
        ];
        $url='https://restapi.getui.com/v1/'.$appId.'/auth_close';
        $res=$this->postjson($url,$header);
        $res=json_decode($res,true);
        // 返回数组格式,如果res.result是ok，说明没问题
        return $res;
    }
    /**
     *   向某个用户推送消息
     *  cid = fd98882bf6f1bade6bffc85574436db
     */
    public function sendToClient($clientID,$title='',$text='',$transmission_content=''){
        $appKey=Config::get('getui.appkey');
        $authToken=$this->getAuthToken();
        $appId=Config::get('getui.appid');
        $content=array(
            'message'=>[
                "appkey"=>$appKey,
                "is_offline"=>true,
                "offline_expire_time" => 7200000,
                "msgtype"=>"notification"
            ],
            'notification'=>[
                'style'=>[
                    'type'=>0,
                    'text'=>$text,
                    'title'=>$title
                ],
                "transmission_type"=> true,
                "transmission_content"=> $transmission_content
            ],
            "cid"=>$clientID,
            "requestid"=> "".time()
        );
        $content=json_encode($content);
        $header=array(
            'Content-Type: application/json',
            'authtoken:'.$authToken
        );
        $url='https://restapi.getui.com/v1/'.$appId.'/push_single';
        //
        $res=$this->postjson($url,$header,$content);
        $res=json_decode($res,true);
        return $res;
    }
     /**
     * 群发消息
     * - 向所有的app发送透传消息
     */
    public function sendToAllTransmission($message){
        $appKey=Config::get('getui.appkey');
        $authToken=$this->getAuthToken();
        $appId=Config::get('getui.appid');
        $content=[
            'message'=>[
                "appkey"=>$appKey,
                "is_offline"=>true,
                "offline_expire_time" => 7200000,
                "msgtype"=>"transmission"
            ],
            'transmission'=>[
                "transmission_type"=>false,
                "transmission_content"=>$message,
            ],
            'requestid'=>"".time(),
        ];
        $content=json_encode($content);
        $header=[
            'Content-Type: application/json',
            'authtoken:'.$authToken
        ];
        $url='https://restapi.getui.com/v1/'.$appId.'/push_app';
        //
        $res=$this->postjson($url,$header,$content);
        $res=json_decode($res,true);
        return $res;
    }
     /**
     * 群发消息
     * - 向所有的app发送notification消息
     */
    public function sendToAllNotification($title='',$text='',$transmission_content=''){
        $appKey=Config::get('getui.appkey');
        $authToken=$this->getAuthToken();
        $appId=Config::get('getui.appid');
        $content=[
            'message'=>[
                "appkey"=>$appKey,
                "is_offline"=>true,
                "offline_expire_time" => 7200000,
                "msgtype"=>"notification"
            ],
            'notification'=>[
                'style'=>[
                    'type'=>0,
                    'text'=>$text,
                    'title'=>$title,
                    'is_vibrate' => true,
                    //'is_float' => true,
                    'is_ring' => true
                ],
                "transmission_type"=>true,
                "transmission_content"=>$transmission_content
            ],
            'requestid'=>"".time(),
        ];
        $content=json_encode($content);
        $header=[
            'Content-Type: application/json',
            'authtoken:'.$authToken
        ];
        $url='https://restapi.getui.com/v1/'.$appId.'/push_app';
        //
        $res=$this->postjson($url,$header,$content);
        $res=json_decode($res,true);
        return $res;
    }
    
    public function postjson($url, $header, $data){
	    return httpRequest($url, 'POST', $data, $header);
    }

}