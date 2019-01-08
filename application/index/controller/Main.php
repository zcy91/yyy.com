<?php
namespace app\back\controller;
use think\Controller;
use think\Session;
use think\Url;
use think\Config;
use think\Page;
use think\Verify;
use think\Image;
use think\Db;
use think\Request;
use mikkle\tp_wechat;
use tool;
use wxsdk\wxpay\example;
use think\helper\Time;
class Index extends Base {
    public function index(){
        $power = $this->power;
        $admininfo = $this->admininfo;
        $this->assign('power', $power);
        $this->assign('admininfo', $admininfo);
        return $this->fetch();
    }
    public function main(){
        //统计用户数量
        $usernum = db('member')->where('id>0')->count();
        //今天注册数
        list($start, $end) = Time::today();
        $onedaynum = db('member')->where('reg_time','>',$start)->count();
        //Article
        //统计文章数量
        $articlenum = db('article')->where('id','>','0')->count();
        //未审核
        $statusnum = db('article')->where('status',0)->count();
        //最新文章
        $articlenew = db('article')->field('id,title,hits,createtime')->where('id','>','0')->order('id','dasc')->limit(10)->select();
        $this->assign("usernum", $usernum);
        $this->assign("onedaynum", $onedaynum);
        $this->assign("articlenum", $articlenum);
        $this->assign("statusnum", $statusnum);
        $this->assign("articlenew", $articlenew);
        $this->assign("server", $_SERVER);
        return $this->fetch();
    }
}