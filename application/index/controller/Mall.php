<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Url;
use think\Config;
use think\Page;
use think\Verify;
use think\Image;
use think\Db;
use think\Request;
use think\Cookie;
class Mall extends Base
{
    public function index()
    {
        return $this->fetch();
    }
    public function mall()
    {
        $time = time();
        //获取商品信息之前要先获取一下用户一小时没有完成支付的订单
        $expirytime = $time - 3600;
        $expiryorder = db('order')
                    ->field('o.*,og.gid,og.num')
                    ->alias('o')
                    ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
                    ->where(array('o.creationtime'=>['<',$expirytime],'o.status'=>0))->select();
        if(!empty($expiryorder)){
            $expiryarr = array();
            foreach ($expiryorder as $v){
                if(empty($expiryarr[$v['gid']])){
                    $expiryarr[$v['gid']] = 0;
                }
                $expiryarr[$v['gid']]+=$v['num'];
                //羊羔恢复未购买状态
                //$islamb = db('lamb')->where(array('uid'=>$v['uid'],'oid'=>$v['id'],'gid'=>$v['gid']))->update(array('status'=>0,'uid'=>0,'oid'=>0,'lambname'=>''));
            }
            //改成关闭状态
            $isorder = db('order')->where(array('creationtime'=>['<',$expirytime],'status'=>0))->update(array('status'=>4));
            if($isorder){
                //添加对应的库存
                foreach ($expiryarr as $s=>$v){
                    Db::name('goods')->where('id', $s)->setInc('stock', $v);
                }
            }
        }
        $where = " (showtime<=$time and hidetime>$time and status=1 and shoptype=2) or (showtime=0 and hidetime = 0 and status=1 and shoptype=2) ";
        $order_bay = input('order'); 
        if(!empty('order') && $order_bay == 1){
            $order_sort = array('id'=>'desc');
        }else if(!empty('order') && $order_bay == 2){
            $order_sort = array('price2'=>'desc');
        }else if(!empty('order') && $order_bay == 3){
            $order_sort = array('price2'=>'asc');
        } else {
            $order_sort = array('id'=>'desc');
        }
        $list=Db::name('goods')->field('id,gname,img,price2,creationtime,stock,sold')->where($where)->order($order_sort)->paginate(20);
        $this->assign('list', $list);
        $this->assign('order_bay', $order_bay);
        $this->assign('time', $time);
        $this->assign('webtitle', '积分商城');
        return $this->fetch();
    }
    public function malldetail(){
        //详情页
        $id = input('gid');
        if($id>0){
            $details=Db::name('goods')->where("id=$id")->find();
            $this->assign('details', $details);
        }
        //搜索可以用优惠券
        $time = time();
        $iscoupon = db('coupon_data')
                    ->field('cd.*,c.couponname,c.enough,c.deduct,c.backtype,c.islimit,c.stime,c.etime')
                    ->alias('cd')
                    ->join('__COUPON__ c','cd.couponid = c.id','LEFT')
                    ->where(array('cd.uid'=> $this->member['id'],'cd.used'=>0,'c.status'=>1,'c.stime'=>['<=',$time],'c.etime'=>['>',$time],))->where(' (c.islimit=0 or (c.islimit=1 and c.limitid="'.$details['type'].'") or (c.islimit=2 and limitid="'.$id.'")) ')->select();
        //print_r($iscoupon);
        $couponnum = count($iscoupon);
        $memberid = $this->member['id'];
        $this->assign('memberid', $memberid);
        $this->assign('iscoupon', $iscoupon);
        $this->assign('couponnum', $couponnum);
        $this->assign('webtitle', '商品详情');
        return $this->fetch();
    }
    //设置购物车
    public function setshopcart(){
        if(Request::instance()->isPost()){
            $gid = input('post.gid');
            $num = input('post.num');
            // 初始化
            cookie(['prefix' => 'shopcart_', 'expire' => 3600*24*7]);
            $scarr = cookie('mall');
            
            // 设置
            if(!empty($scarr)){
               $hearr = array($gid=>$num)+$scarr;
            }else{
               $hearr = array($gid=>$num);
            }
            cookie('mall', $hearr);
            // 获取
            $ismall = cookie('mall');
            // 删除
            //cookie('mall', null);
            
            if(!empty($ismall)){
                return array('type'=>1,'msg'=>'加入购物车成功');
            }else{
                return array('type'=>0,'msg'=>'加入购物车失败');
            }
        } else {
            return array('type'=>0,'msg'=>'请求错误');
        }
    }
    public function shopcart(){
        // 初始化
        cookie(['prefix' => 'shopcart_', 'expire' => 3600*24]);
        $scarr = cookie('mall');
        $shopcartarr = array();
        $total = 0;
        foreach ((array)$scarr as $s => $v){
            $list=Db::name('goods')->field('id,gname,img,price2,creationtime,stock,sold')->where(array('id'=>$s))->find();
            $list['price2s'] = sprintf('%.2f',$list['price2'] * $v);
            $list['num'] = $v;
            $shopcartarr[] = $list;
            $total+=$list['price2s'];
        }
        $this->assign('list', $shopcartarr);
        $this->assign('total', sprintf('%.2f',$total));
        $memberid = $this->member['id'];
        $this->assign('memberid', $memberid);
        return $this->fetch();
    }
    public function delcookie(){
        if(Request::instance()->isPost()){
            $id = input('post.id');
            // 初始化
            cookie(['prefix' => 'shopcart_', 'expire' => 3600*24]);
            $scarr = cookie('mall');
            if(!empty($id)){
                unset($scarr[$id]);
            }else{
                return array('type'=>0,'msg'=>'删除失败','arr'=>$scarr);
            }
            cookie('mall', $scarr);
            return array('type'=>1,'msg'=>'删除成功','arr'=>$scarr);
        }
        
    }
}

