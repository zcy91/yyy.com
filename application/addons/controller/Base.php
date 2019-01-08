<?php
namespace app\addons\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Input;
use clt\Leftnav;
use think\Request;

class Base extends Controller {
    public $member;
    function _initialize() {
        
        if(Session::has('user')){
            $this->member = db('member')->where('id',Session::get('user')['user_id'])->find();
        }
    }
         
}