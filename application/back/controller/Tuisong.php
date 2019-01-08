<?php

namespace app\back\controller;
use app\back\model\Getui;
use think\Request;

class Tuisong extends Base {
    public function index(){
        $get = new Getui();
        $transmission_content = [
			'title' => '12312321321321321321312',
            'content' => '22222222222t范德萨范德萨范德萨反倒萨芬est',
            'playload' => '范德萨范德萨123123'
        ];
        $transmission_content = json_encode($transmission_content);
         $res=$get->sendToClient('e61b6220133d6b2c30077fe106e9d637','滴答滴答滴答滴答的','啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊',$transmission_content);
        // $res=$get->sendToAllTransmission($transmission_content);
       // $res = $get->sendToAllNotification('123123','啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊',$transmission_content);
        //dump($res);
    }
    public function tongzhi (){
	    if(Request::instance()->isPost()){
		    $data = input('post.');
		    if(!empty($data['title']) && !empty($data['content'])){
			    $get = new Getui();
			    if(!empty($data['touchuan_title']) && !empty($data['touchuan_content']) && !empty($data['playload'])){
				    $transmission_content = [
						'title' => $data['touchuan_title'],
		            	'content' => $data['touchuan_content'],
		            	'data' => ['type'=>'tongzhi','url'=>$data['playload']]
		        	];
			    }else{
				    $transmission_content = null;
			    }
	        	
		        $transmission_content = json_encode($transmission_content);
		        $res = $get->sendToAllNotification($data['title'],$data['content'],$transmission_content);
		        if($res['result'] == 'ok'){
			        $this->success("推送通知已下发",url("/back/tuisong/tongzhi"));
		        }
		    }
	    	
    	}
        return $this->fetch();
    }
    public function touchuan (){
	    if(Request::instance()->isPost()){
		    $data = input('post.');
		    if(!empty($data['touchuan_title']) && !empty($data['touchuan_content']) && !empty($data['playload'])){
				$get = new Getui();
        		$transmission_content = [
					'title' => $data['touchuan_title'],
            		'content' => $data['touchuan_content'],
            		'data' => ['type'=>'touchuan','url'=>$data['playload']]
        		];
        		$transmission_content = json_encode($transmission_content);
        		$res = $get->sendToAllTransmission($transmission_content);
		    		if($res['result'] == 'ok'){
			    		$this->success("透传消息已下发",url("/back/tuisong/touchuan"));
		    		}
			}
		}
		return $this->fetch();
    }
}