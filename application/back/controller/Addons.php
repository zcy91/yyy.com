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
class Addons extends Base {
    public function index(){
        return $this->fetch();
    }
    public function prize(){
        $get = Request::instance()->param();
        $mohu = ['id','title'];
        $timename = 'stime';
        $getwhere = getwhere('',$get,$mohu,$timename);
        $list=Db::name('activity')
                ->order('id', 'desc')
                ->where($getwhere['where'])
                ->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function prizeadd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                $data ['prizesn'] = 'PR'.date('Ymd') .strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99)); 
                $stime = input('post.stime');
                $etime = input('post.etime');
                if(!empty($stime)){
                    $data['stime'] = strtotime($stime);
                }else{
                    $data['stime'] = 0;
                }
                if(!empty($etime)){
                    $data['etime'] = strtotime($etime);
                }else{
                    $data['etime'] = 0;
                }
                db('activity')->insert($data);
                //添加奖品奖励
                $prizearr = Request::instance()->param()['prize'];
                $type = input('post.type');
                $isprize = db('activity')->where(array('prizesn'=>$data ['prizesn']))->find();
                foreach ($prizearr as $s=>$v){
                    if($v['weight']<=$type){
                        $prizedata['aid']    = $isprize['id']; 
                        $prizedata['weight'] = $v['weight']; 
                        $prizedata['name']   = $v['name']; 
                        $prizedata['img']    = $v['img']; 
                        $prizedata['total']  = $v['total']; 
                        $prizedata['remain'] = $v['remain']; 
                        $prizedata['chance'] = $v['chance']; 
                        $prizedata['status'] = 1; 
                        db('activity_prize')->insert($prizedata);
                    }
                }
                return array('type'=>1,'msg'=>'添加成功！');
            }else{
                $data = input('post.');
                $stime = input('post.stime');
                $etime = input('post.etime');
                if(!empty($stime)){
                    $data['stime'] = strtotime($stime);
                }else{
                    $data['stime'] = 0;
                }
                if(!empty($etime)){
                    $data['etime'] = strtotime($etime);
                }else{
                    $data['etime'] = 0;
                }
                db('activity')->where('id', $id)->update($data);
                //修改奖品奖励
                $prizearr = Request::instance()->param()['prize'];
                $type = input('post.type');
                $isprize = db('activity')->where(array('id'=>$id))->find();
                foreach ($prizearr as $s=>$v){
                    if($v['weight']<=$type){
                        $prizedata['aid']    = $isprize['id']; 
                        $prizedata['weight'] = $v['weight']; 
                        $prizedata['name']   = $v['name']; 
                        $prizedata['img']    = $v['img']; 
                        $prizedata['total']  = $v['total']; 
                        $prizedata['remain'] = $v['remain']; 
                        $prizedata['chance'] = $v['chance'];
                        $prizedata['status'] = 1; 
                        if(empty($v['id'])){
                            db('activity_prize')->insert($prizedata);
                        }else{
                            db('activity_prize')->where('id', $v['id'])->update($prizedata);
                        }
                    }else{
                        db('activity_prize')->where(array('weight'=>$v['weight'],'aid'=>$id))->update(array('status' =>2));
                        //db('activity_prize')->where(array('weight'=>$v['weight'],'aid'=>$id))->delete();
                    }
                }
                return array('type'=>1,'msg'=>'修改成功！');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $myactivity = Db::name('activity')->where("id=$id")->find();
                $myprizetime['stime'] =  date("Y-m-d",$myactivity['stime']);
                $myprizetime['etime'] =  date("Y-m-d",$myactivity['etime']);
                //获取奖品的信息
                $list = db('activity_prize')->where(array('aid'=>$id))->select();
                //计算list个数
                $listnum = count($list);
                $this->assign('list', $list);
                $this->assign('myactivity', $myactivity);
                $this->assign('myprizetime', $myprizetime);
            }
        }
        if (!empty($listnum)){
            $this->assign('listnum', $listnum+1);
        }else{
            $this->assign('listnum', 1);
        }
        return $this->fetch();
    }
    
    public function coupon(){
        $get = Request::instance()->param();
        $mohu = ['id','couponname'];
        $timename = 'createtime';
        $getwhere = getwhere('',$get,$mohu,$timename);
        $list=Db::name('coupon')
                ->order('id', 'desc')
                ->where($getwhere['where'])
                ->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    
    public function couponadd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            $data = input('post.');
            $stime = input('post.stime');
            if(!empty($stime)){
                $data['stime'] = strtotime($stime);
            }else{
                $data['stime'] = time();
            }
            $etime = input('post.etime');
            if(!empty($etime)){
                $data['etime'] = strtotime($etime);
            }else{
                $data['etime'] = 0;
            }
            if(empty($id)){
                $data['creationtime'] = time();
                db('coupon')->insert($data);
                $couponid = Db::name('coupon')->getLastInsID();
                if(!empty($data['uid'])){
                    $res['couponid'] = $couponid;
                    $res['gettype'] = 0;
                    $res['uid'] =$data['uid'];
                    $res['used'] = 0;
                    if(empty($data['stime']))
                    $res['gettime'] = time();
                    else{
                        $res['gettime'] = $data['stime'];
                    }
                    db('coupon_data') -> insert($res);
                }
                return array('type'=>1,'msg'=>'添加成功');
            }else{
                db('coupon')->where('id', $id)->update($data);
                return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $mycoupon = Db::name('coupon')->where("id=$id")->find();
                $mycoupon['stime'] = !empty($mycoupon['stime'])?date("Y-m-d H:i:s",$mycoupon['stime']):'' ;
                $mycoupon['etime'] = !empty($mycoupon['etime'])?date("Y-m-d H:i:s",$mycoupon['etime']):'' ;
                $this->assign('mycoupon', $mycoupon);
            }
        }
        //dump($mycoupon);die;
        return $this->fetch();
    }
    public function lvyou ()
    {
	    $get = Request::instance()->param();
        $mohu = ['id','title'];
        $timename = 'createtime';
        $getwhere = getwhere('',$get,$mohu,$timename);
        $list=Db::name('lvyou')
                ->order('id', 'desc')
                ->where($getwhere['where'])
                ->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
	    return $this->fetch();
    }
    public function lvyouadd ()
    {
	    if(Request::instance()->isPost()){
            $id= input('post.id');
            $data = input('post.');
            $stime = input('post.stime');
            if(!empty($stime)){
                $data['stime'] = strtotime($stime);
            }else{
                $data['stime'] = 0;
            }
            $etime = input('post.etime');
            if(!empty($etime)){
                $data['etime'] = strtotime($etime);
            }else{
                $data['etime'] = 0;
            }
            if(empty($id)){
                $data['creationtime'] = time();
                db('lvyou')->insert($data);
                return array('type'=>1,'msg'=>'添加成功');
            }else{
                db('lvyou')->where('id', $id)->update($data);
                return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $lvyou = Db::name('lvyou')->where("id=$id")->find();
                $lvyou['stime'] = !empty($lvyou['stime'])?date("Y-m-d H:i:s",$lvyou['stime']):'' ;
                $lvyou['etime'] = !empty($lvyou['etime'])?date("Y-m-d H:i:s",$lvyou['etime']):'' ;
                $this->assign('lvyou', $lvyou);
            }
        }
	    return $this->fetch();
    }
    public function lvyoubaoming ()
    {
	    if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $list = Db::name('lvyou_baoming')->alias('l')->join('member u','l.userid = u.id','LEFT')->where("lyid=$id")->paginate(20,false);
                //$list['time'] = !empty($list['time'])?date("Y-m-d H:i:s",$list['time']):'' ;
                $this->assign('list', $list);
            }
        }
	    return $this->fetch();
    }
}