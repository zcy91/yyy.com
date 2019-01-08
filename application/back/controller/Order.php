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
class Order extends Base {
    public function index(){
        return $this->fetch();
    }
    public function Orderlist(){
        $get = Request::instance()->param();
        $mohu = ['id','ordersn','uid'];
        $timename = 'creationtime';
        $getwhere = getwhere('o.',$get,$mohu,$timename);
        $list=Db::name('order')
                ->field('o.*,og.gid,og.num,g.img,g.gname,m.username,m.realname,m.mobile,m.agentid,s.realname as agent_realname,s.username as agent_username')
                ->alias('o')
                ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
                ->join('__MEMBER__ m','o.uid = m.id','LEFT')
                ->join('__GOODS__ g','og.gid = g.id','LEFT')
                ->join('__MEMBER__ s','m.agentid = s.id','LEFT')
                ->order('o.id', 'desc')
                ->group("o.ordersn")
                ->where($getwhere['where'])
                ->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
//确认发货
    public function order_edit(){
        if(Request::instance()->isPost()){
            $data = Request::instance()->param();
            $data['shipping_time'] = time();
            $data['status'] = 2;
            $res = db('order')->where('ordersn',$data['ordersn'])->update($data);
            if($res){
                $this->success('发货成功');
            }else{
                $this->error('发货失败');
            }
        }else{
            $list=Db::name('order')
                ->field('o.*,og.gid,og.num,g.img,g.gname,g.price2,g.stock,m.username,m.realname,m.mobile,m.agentid,s.realname as agent_realname,s.username as agent_username')
                ->alias('o')
                ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
                ->join('__MEMBER__ m','o.uid = m.id','LEFT')
                ->join('__GOODS__ g','og.gid = g.id','LEFT')
                ->join('__MEMBER__ s','m.agentid = s.id','LEFT')
                ->where('o.id',$_GET['id'])
                ->order('o.id', 'desc')
                ->select();
            $this -> assign('list',$list);
            // dump($list);die;
            return $this->fetch();
        }

    }
//确认收货
    public function order_com(){
        if(Request::instance()->isPost()){
            $data = Request::instance()->param();
            $data['shipping_com_time'] = time();
            $data['status'] = 3;
            $res = db('order')->where('ordersn',$data['ordersn'])->update($data);
            if($res){
                $this->success('确认收货成功');
            }else{
                $this->error('收货失败');
            }
        }else{
            $list=Db::name('order')
                ->field('o.*,og.gid,og.num,g.img,g.gname,g.price2,g.stock,m.username,m.realname,m.mobile,m.agentid,s.realname as agent_realname,s.username as agent_username')
                ->alias('o')
                ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
                ->join('__MEMBER__ m','o.uid = m.id','LEFT')
                ->join('__GOODS__ g','og.gid = g.id','LEFT')
                ->join('__MEMBER__ s','m.agentid = s.id','LEFT')
                ->where('o.id',$_GET['id'])
                ->order('o.id', 'desc')
                ->select();
            $this -> assign('list',$list);
            // dump($list);die;
            return $this->fetch();
        }

    }

    //编辑订单
    public function order_editor(){
        if(Request::instance()->isPost()){
            $data = Request::instance()->param();
            $res = db('order')->where('ordersn',$data['ordersn'])->update($data);
            if($res){
                $this->success('编辑成功');
            }else{
                $this->error('编辑失败');
            }
        }else{
            $list=Db::name('order')
                ->field('o.*,og.gid,og.num,g.img,g.gname,g.price2,g.stock,m.username,m.realname,m.mobile,m.agentid,s.realname as agent_realname,s.username as agent_username')
                ->alias('o')
                ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
                ->join('__MEMBER__ m','o.uid = m.id','LEFT')
                ->join('__GOODS__ g','og.gid = g.id','LEFT')
                ->join('__MEMBER__ s','m.agentid = s.id','LEFT')
                ->where('o.id',$_GET['id'])
                ->order('o.id', 'desc')
                ->select();
            $this -> assign('list',$list);
            // dump($list);die;
            return $this->fetch();
        }
    }


}