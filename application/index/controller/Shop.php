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
class Shop extends Base 
{
    public function index()
    {
        return $this->fetch();
    }
    public function glist()
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
                $islamb = db('lamb')->where(array('uid'=>$v['uid'],'oid'=>$v['id'],'gid'=>$v['gid']))->update(array('status'=>0,'uid'=>0,'oid'=>0,'lambname'=>''));
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
        
//        $where = array(
//            'showtime'=>['<=',$time],
//            'hidetime'=>['>',$time],
//            'status'=>1
//        );
        $where = " (showtime<=$time and hidetime>$time and status=1 and shoptype=1) or (showtime=0 and hidetime = 0 and status=1 and shoptype=1) ";
        $list=Db::name('goods')->where($where)->order('id', 'desc')->paginate(20);
        $this->assign('list', $list);
        $this->assign('time', $time);
        $this->assign('webtitle', '领养');
        return $this->fetch();
    }
    public function gdetails()
    {
        //羊羔详情页
        $id = input('id');
        if($id>=0){
            $details=Db::name('goods')->where("id=$id")->find();
            $this->assign('details', $details);
        }
        //搜索可以用优惠券
        $time = time();
        $uid = $this -> member['id'];
        $iscoupon = db('coupon_data')
                    ->field('cd.*,c.couponname,c.enough,c.deduct,c.backtype,c.islimit,c.stime,c.etime')
                    ->alias('cd')
                    ->join('__COUPON__ c','cd.couponid = c.id','LEFT')
                    ->where(array('cd.uid'=> $this->member['id'],'cd.used'=>0,'c.status'=>1,'c.stime'=>['<=',$time],'c.etime'=>['=',0],))->whereOr("`cd`.`uid` = $uid  and `cd`.`used` = 0  and `c`.`status` = 1  and `c`.`stime` <=$time   and `c`.`etime` >$time" )->where(' (c.islimit=0 or (c.islimit=1 and c.limitid="'.$details['type'].'") or (c.islimit=2 and limitid="'.$id.'")) ')->select();
//        dump($iscoupon);
//        dump(Db::table('coupon_data')->getLastSql());die;
        $couponnum = count($iscoupon);
        $this->assign('iscoupon', $iscoupon);
        $this->assign('couponnum', $couponnum);
        $this->assign('webtitle', '提交订单');
        return $this->fetch();
    }
    public function protocol(){
        $conrract = db('contract_set')->where('id',2)->find();
        $this->assign('conrract', $conrract);
        $this->assign('webtitle', '认购合同');
        return $this->fetch();
    }
    public function protocol1(){
        $conrract = db('contract_set')->where('id',3)->find();
        $this->assign('conrract', $conrract);
        $this->assign('webtitle', '赠送合同');
        return $this->fetch();
    }
    public function income(){
        $this->assign('webtitle', '收益说明');
        return $this->fetch();
    }
    public function autograph(){
        if(Request::instance()->isPost()){
            $autograph = input('post.autograph');
            if(empty($this->member['id'])){
                return array('type'=>2,'msg'=>'尚未登录！');
            }
            $iscontract = db('contract')->insert(array('ordersn'=>'','uid'=> $this->member['id'],'autograph'=>$autograph));
           if(!empty($iscontract)){
               return array('type'=>1,'msg'=>'签名成功！');
           }else{
               return array('type'=>0,'msg'=>'签名失败！');
           }
        }else{
            return array('type'=>0,'msg'=>'请求失败...');
        }
    }
    public function lambsn(){
        $gid = input('gid');
        if(!empty($gid)){
            $list = db('lamb')
                    ->field('l.lambsn,l.creationtime,g.gname,g.img')
                    ->alias('l')
                    ->join('__GOODS__ g','l.gid = g.id','LEFT')
                    ->where(array('l.gid'=>$gid,'l.status'=>0))
                    ->select();
            $this->assign('list', $list);
        }
        $this->assign('webtitle', '耳标列表');
        return $this->fetch();
    }
    //判断是否爱满足满多少优惠卷条件
    public function coupon_enough(){
        $id = input('id');
        $couponid = db("coupon_data") -> where('id',$id)->value('couponid');
        $prices = input('prices');
        $enough = db('coupon') -> where('id',$couponid)->value('enough');
        if($prices >= (float)$enough){
            return array('type'=> $prices);
        }else {
            return array('type'=> 0);
        }
    }
}
