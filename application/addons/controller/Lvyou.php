<?php
namespace app\addons\controller;
use think\Controller;
use think\Session;
use think\Url;
use think\Config;
use think\Verify;
use think\Db;
use think\Request;

class Lvyou extends Base 
{
    public function index(){
        if(!Session::has('user')){
            header("Location: ".url('/index/login/login'));
            exit();
        }
        if(Request::instance()->isGet()){
            $id = input('get.id');
            if(!empty($id)){
                $res = Db::name('lvyou')->where("id=$id")->find();
                $isbaoming = Db::name('lvyou_baoming')->where("userid=".Session::get('user')['user_id'])->find();
            }else{
                echo '活动不存在或活动已结束！';
                die();
            }
        }else{
            echo '活动不存在或活动已结束！';
            die();
        }
        $this->assign('res',$res);
        $this->assign('isbaoming',$isbaoming);
        return $this->fetch();
    }
    public function baoming ()
    {
	    if(Request::instance()->isPost()){
		    $res = Db::name('lvyou_baoming')->insert(['lyid'=>input('post.id'),'userid'=>Session::get('user')['user_id'],'time'=>time()]);
		    $msg = $res ? ['code'=>1,'msg'=>'报名成功'] : ['code'=>0,'msg'=>'报名失败'];
		    return $msg;
	    }
    	
    }

}