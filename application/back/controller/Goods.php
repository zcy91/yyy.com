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
class Goods extends Base {
    public function index(){
        return $this->fetch();
    }
    public function classifylist(){
        $classifylist=Db::name('classify')->where("id>0")->order('id', 'desc')->select();
        $this->assign('classifylist', $classifylist);
        return $this->fetch();
    }
    public function classifyadd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $name = input('post.name');
                $isuser=Db::name('classify')->where(array('name'=>$name))->find();
                if(empty($isuser)){
                    $data = input('post.');
                    db('classify')->insert($data);
                    return array('type'=>1,'msg'=>'添加成功');
                } else {
                    return array('type'=>0,'msg'=>'分类已存在添加失败');
                }
            }else{
                $data = input('post.');
                db('classify')->where('id', $id)->update($data);
                return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $myclassify = Db::name('classify')->where("id=$id")->find();
                $this->assign('myclassify', $myclassify);
            }
        }
        $getclassify = $this->getclassify(0,0);
        
        $this->assign('getclassify', $getclassify);
        return $this->fetch();
    }
    public function getclassify($pid,$ceng){
        $classify=Db::name('classify')->field('id,pid,name')->where(array('pid'=>$pid))->order(array('id'=>'ASC'))->select();
        $reclassify = array();
        foreach ($classify as $v){
            $getclassify = $this->getclassify($v['id'],$ceng+1);
            $v['ceng'] = $ceng;
            if(!empty($getclassify)){
                $reclassify[] = $v;
                foreach ($getclassify as $ss=>$vv){
                    $reclassify[] = $vv;
                }
            }else{
                $reclassify[] = $v;
            }            
        }
        return $reclassify;
    }

    public function classifydel(){
        if(Request::instance()->isPost()){
            $id = input('get.id');
            if($id>0){
                Db::name('classify')->where('id',$id)->delete();
                echo $id;
            }else{
                echo '0';
            }
        }
    }
    public function goodslist(){
        $get = Request::instance()->param();
        $mohu = ['id','gname','price'];
        $timename = 'reg_time';
        $getwhere = getwhere('',$get,$mohu,$timename);
        $list=Db::name('goods')->where(array('status'=>['>=',0]))->order('id', 'desc')->where($getwhere['where'])->paginate(5,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function goodsadd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            $data = input('post.');
            $time = time();
            $shelftime = input('post.shelftime');
            if(!empty($shelftime)){
                $data['shelftime'] = strtotime($shelftime);
            }else{
                $data['shelftime'] = 0;
            }
            $showtime = input('post.showtime');
            if(!empty($shelftime)){
                $data['showtime'] = strtotime($showtime);
            }else{
                $data['showtime'] = 0;
            }
            $hidetime = input('post.hidetime');
            if(!empty($shelftime)){
                $data['hidetime'] = strtotime($hidetime);
            }else{
                $data['hidetime'] = 0;
            }
            if(empty($id)){
                $data['creationtime'] = $time;
                db('goods')->insert($data);
                $gid =db('goods')->getLastInsID();
                //如果是添加羊羔，要生成发售的羊
                if(input('post.shoptype')==1 && input('post.make')==1){
                    $lambnum = input('post.stock');
                    $lambdata = array(
                            'uid' =>0,
                            'oid' =>0,
                            'gid' =>$gid,
                            'lambname' =>'',
                            'message' =>'天空因为你们而更加蓝。',
                            'creationtime' =>$time,
                            'status'=>0
                    );
                    for ($i = 1; $i <=$lambnum; $i++) {
                        if(!empty(input('post.lambprefix'))){
                            $lambdata['lambsn'] = icode($i, input('post.lambprefix'));
                        }else{
                            $lambdata['lambsn'] = 'LM'.date('ymdHis').$i;
                        }
                        db('lamb')->insert($lambdata);
                    }
                }
                return array('type'=>1,'msg'=>'添加成功');
            }else{
                db('goods')->where('id', $id)->update($data);
                return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $mygoods = Db::name('goods')->where("id=$id")->find();
                $mygoods['shelftime'] = !empty($mygoods['shelftime'])?date("Y-m-d H:i:s",$mygoods['shelftime']):'' ;
                $mygoods['showtime'] = !empty($mygoods['showtime'])?date("Y-m-d H:i:s",$mygoods['showtime']):'' ;
                $mygoods['hidetime'] = !empty($mygoods['hidetime'])?date("Y-m-d H:i:s",$mygoods['hidetime']):'' ;
                $this->assign('mygoods', $mygoods);
            }
        }
        $classify = Db::name('classify')->where("id>0")->select();
        $this->assign('classify', $classify);
        return $this->fetch();
    }
    public function goodsdel(){
        if(Request::instance()->isPost()){
            $id = input('get.id');
            if($id>0){
                Db::name('goods')->where('id',$id)->update(array('status'=>'-1'));
                echo $id;
            }else{
                echo '0';
            }
            
        }
        
    }

    public function lambdel(){
        if(Request::instance()->isPost()){
            $id = input('get.id');
            if($id>0){
                $res = db('lamb') -> where('id',$id) ->value('status');

                if($res > 0){
                    echo '0';
                }else{
                    Db::name('lamb')->where('id',$id)->delete();
                    echo $id;
                }
            }else{
                echo '0';
            }

        }

    }
    

    public function selllamblist(){
        $get = Request::instance()->param();
        $mohu = ['id','uid','sellsn'];
        $timename = 'creationtime';
        $getwhere = getwhere('sl.',$get,$mohu,$timename);
        $list=Db::name('sell_lamb')
                ->field('sl.*,m.username,t.name,m.realname')
                ->alias('sl')
                ->join('__MEMBER__ m','m.id = sl.uid','LEFT')
                ->join('__TOUR_TYPE__ t','t.id = sl.tourtype','LEFT')
                ->order('sl.id', 'desc')
                ->where($getwhere['where'])
                ->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function lamblist(){
        $get = Request::instance()->param();
        $mohu = ['id','uid','lambsn'];
        $timename = 'creationtime';
        $getwhere = getwhere('l.',$get,$mohu,$timename);
        $list=Db::name('lamb')
                ->field('l.*,m.username,g.gname')
                ->alias('l')
                ->join('__MEMBER__ m','m.id = l.uid','LEFT')
                ->join('__GOODS__ g','g.id = l.gid','LEFT')
                ->order('l.id', 'desc')
                ->where($getwhere['where'])
                ->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function lambvideo(){
        $get = Request::instance()->param();
        $mohu = ['id','lambid'];
        $timename = 'creationtime';
        $getwhere = getwhere('lv.',$get,$mohu,$timename);
        $list=Db::name('lamb_video')
                ->field('lv.*,l.lambsn,l.lambname')
                ->alias('lv')
                ->join('__LAMB__ l','lv.lambid = l.id','LEFT')
                ->order('lv.id', 'desc')
                ->where($getwhere['where'])
                ->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function sellmoney(){
        if(Request::instance()->isPost()) {
            $id = input('post.id');
            $type = input('post.type');
            if (!empty($id)) {
                $isstatus = Db::name('sell_lamb')->where('id', $id)->find();
                if ($isstatus['status'] == 1) {
                    if ($type == 1) {
                        return array('type' => 0, 'msg' => '微信提现暂未开通。');
                    } elseif ($type == 2) {
                        $ispay = Db::name('sell_lamb')->where('id', $id)->update(array('status' => 2, 'completetime' => time()));
                        if ($ispay) {
                            return array('type' => 1, 'msg' => '线下打款成功！');
                        } else {
                            return array('type' => 0, 'msg' => '线下打款失败！');
                        }
                    } elseif ($type == 0) {
                        $onemember = db('member')->where(array('id' => $isstatus['uid']))->find();
                        $ispay = Db::name('sell_lamb')->where('id', $id)->update(array('status' => 2, 'completetime' => time()));
                        $isuser = Db::name('member')->where('id', $isstatus['uid'])->setInc('credit', $isstatus['money']);

                        $recharge_data = array(
                            'userid' => $isstatus['uid'],
                            'money' => $isstatus['money'],
                            'vary' => 1,
                            'type' => 1,
                            'time' => time(),
                            'remark' => '出售羔羊',
                            'balance' => $onemember['credit'] + $isstatus['money'],
                            'status' => '1',
                        );
                        $isrecharge = db('recharge_log')->insert($recharge_data);
                        if ($ispay) {
                            return array('type' => 1, 'msg' => '余额打款成功！');
                        } else {
                            return array('type' => 0, 'msg' => '余额打款失败！');
                        }
                    } elseif ($type == -1) {

                        $ispay = Db::name('sell_lamb')->where('id', $id)->update(array('status' => -1, 'completetime' => time()));
                        $res = db('lamb')->where(array('id'=>$isstatus['lambid']))->update(array('status'=>1));
                        $tourarr = db('sell_lamb') -> where('id',$id) -> find();
                        if(!empty($tourarr['tourtype'])){
                            $tour = db('tour') -> where('catid',$tourarr['tourtype']) -> value('price_ladder');
                            $tour = unserialize($tour);
                            foreach($tour as $k=>$v){
                                if($v['num'] == $tourarr['tourlist']){
                                    $key = $k;
                                    $people = $v['people'];
                                }
                            }
                            if($people>0){
                                $people = $people + 1;
                                $tour[$key]['people'] = $people;
                                $tour = serialize($tour);
                                $res = db('tour') -> where('catid',$tourarr['tourtype']) -> update(array('price_ladder'=>$tour));
                            }else{
                                return array('type'=>0,'msg'=>'上限人数已满');
                            }
                        }

                        if (!empty($ispay) && !empty($res)) {

                            return array('type' => 1, 'msg' => '驳回成功！');
                        } else {
                            return array('type' => 0, 'msg' => "驳回失败");
                        }
                    } elseif($type == 3){
                        $ispay = Db::name('sell_lamb')->where('id', $id)->update(array('status' => 2, 'completetime' => time()));
                        if ($ispay) {
                            return array('type' => 1, 'msg' => '审核成功！');
                        } else {
                            return array('type' => 0, 'msg' => '审核失败！');
                        }
                    }
                }elseif ($isstatus['status'] == -2){
                    if ($type == -1) {

                        $ispay = Db::name('sell_lamb')->where('id', $id)->update(array('status' => -3, 'completetime' => time()));
//                        $res = db('lamb')->where(array('id'=>$isstatus['lambid']))->update(array('status'=>1));
//                        $tourarr = db('sell_lamb') -> where('id',$id) -> find();
//                        if(!empty($tourarr['tourtype'])){
//                            $tour = db('tour') -> where('catid',$tourarr['tourtype']) -> value('price_ladder');
//                            $tour = unserialize($tour);
//                            foreach($tour as $k=>$v){
//                                if($v['num'] == $tourarr['tourlist']){
//                                    $key = $k;
//                                    $people = $v['people'];
//                                }
//                            }
//                            if($people>0){
//                                $people = $people + 1;
//                                $tour[$key]['people'] = $people;
//                                $tour = serialize($tour);
//                                $res = db('tour') -> where('catid',$tourarr['tourtype']) -> update(array('price_ladder'=>$tour));
//                            }else{
//                                return array('type'=>0,'msg'=>'上限人数已满');
//                            }
//                        }

                        if (!empty($ispay)) {

                            return array('type' => 1, 'msg' => '驳回成功！');
                        } else {
                            return array('type' => 0, 'msg' => "驳回失败");
                        }
                    } elseif($type == 3){
                        $ispay = Db::name('sell_lamb')->where('id', $id)->update(array('status' => 4, 'completetime' => time(),'isdelete'=>1));
                        $res = db('lamb')->where(array('id'=>$isstatus['lambid']))->update(array('status'=>1));
                        $tourarr = db('sell_lamb') -> where('id',$id) -> find();
                        if(!empty($tourarr['tourtype'])){
                            $tour = db('tour') -> where('catid',$tourarr['tourtype']) -> value('price_ladder');
                            $tour = unserialize($tour);
                            foreach($tour as $k=>$v){
                                if($v['num'] == $tourarr['tourlist']){
                                    $key = $k;
                                    $people = $v['people'];
                                }
                            }
                            if($people>0){
                                $people = $people + 1;
                                $tour[$key]['people'] = $people;
                                $tour = serialize($tour);
                                $res = db('tour') -> where('catid',$tourarr['tourtype']) -> update(array('price_ladder'=>$tour));
                            }else{
                                return array('type'=>0,'msg'=>'上限人数已满');
                            }
                        }
                        if ($ispay && $res) {
                            return array('type' => 1, 'msg' => '审核成功！');
                        } else {
                            return array('type' => 0, 'msg' => '审核失败！');
                        }
                    }
                } else {
                    return array('type' => 0, 'msg' => '已处理申请，无须重复审核。');
                }
            } else {
                return array('type' => 0, 'msg' => 'id不能为空');
            }
        }else{
            return array('type'=>0,'msg'=>'请求失败');
        }
    }
    public function videoadd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                $data['creationtime'] = time();
                db('lamb_video')->insert($data);
                return array('type'=>1,'msg'=>'添加成功');
            }else{
                $data = input('post.');
                db('lamb_video')->where('id', $id)->update($data);
                return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $myvideo = Db::name('lamb_video')->where("id=$id")->find();
                $this->assign('myvideo', $myvideo);
            }
            $lambid= input('get.lambid');
            if(!empty($lambid)){
                $this->assign('lambid', $lambid);
            }
        }
        $video_type = Db::name('video_type')->where("id>0")->select();
        $this->assign('video_type', $video_type);
        return $this->fetch();
    }
    
    public function videotype(){
        $videotypelist=Db::name('video_type')->where("id>0")->order('id', 'desc')->select();
        $this->assign('videotypelist', $videotypelist);
        return $this->fetch();
    }
    public function videotypeadd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $name = input('post.name');
                $isuser=Db::name('video_type')->where(array('name'=>$name))->find();
                if(empty($isuser)){
                    $data = input('post.');
                    db('video_type')->insert($data);
                    echo '<script>alert("添加成功");</script>';
                } else {
                    echo '<script>alert("等级已存在添加失败");</script>';
                }
            }else{
                $data = input('post.');
                db('video_type')->where('id', $id)->update($data);
                echo '<script>alert("修改成功");</script>';
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id) && $id>0){
                $myvideo_type = Db::name('video_type')->where("id=$id")->find();
                $this->assign('myvideo_type', $myvideo_type);
            }
        }
        return $this->fetch();
    }
    
    public function lambadd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                $data['creationtime'] = time();
                db('lamb')->insert($data);
                return array('type'=>1,'msg'=>'添加成功');
            }else{
                $data = input('post.');
                db('lamb')->where('id', $id)->update($data);
                return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $mylamb = Db::name('lamb')->where("id=$id")->find();
                $this->assign('mylamb', $mylamb);
            }
        }
        return $this->fetch();
    }

    //兑换产品
    public function selllvyou(){
        $id = $_GET['id'];
        if(Request::instance()->isPost()){
            $data = Request::instance()->param();
            $data['shipping_time'] = time();
            $data['status'] = 3;
            $res = db('sell_lamb')->where('sellsn',$data['sellsn'])->update($data);
            if($res){
                $this->success('发货成功');
            }else{
                $this->error('发货失败');
            }
        }else{
            $list=Db::name('sell_lamb')
                ->field('sl.*')
                ->alias('sl')
                ->where('id',$id)
               ->select();
            $uid = $list[0]['uid'];
            $address = db('address')->where('id',$list[0]['address_id'])->find();
            $list[0]['address'] = $address;
            $this->assign('id',$id);
            $this -> assign('list',$list);
            // dump($list);die;
            return $this->fetch();
        }
    }
    //产品确认收货
    public function comfir(){
        if(Request::instance()->isPost()){
            $id = Request::instance()->post('id');
            $status =  db('sell_lamb')->where('id',$id)->value('status');
            if($status == 3){
                $res = db('sell_lamb')->where('id',$id)->update(array('status'=>2,'completetime'=>time()));
                if($res){
                    $lambid = db('sell_lamb')->where('id',$id)->value('lambid');
                    $oid= db('lamb')->where('id',$lambid)->value('oid');
                    $this->setCommissionOne($oid,$lambid);
                    return json(['msg'=>'收货成功']);
                }else{
                    return json(['msg'=>'收货失败']);
                }
            }else{
                return json(['msg'=>$status]);
            }

        }
    }
    public function setCommissionOne($oid,$lambid){
        //获取订单信息
        $isorder = db('order')->where(array('id'=>$oid,'status'=>['>=',1],'status'=>['<',4]))->find();
        if(!empty($isorder['uid'])){
            //获取买家信息
            $buy = db('member')->where(array('id'=>$isorder['uid']))->find();
            \db('member') ->where(['id'=>$isorder['uid']])->update(['is_agent'=>1]);
            //获取买家上级
            if(!empty($buy['agentid'])){
                $onemember = db('member')->where(array('id'=>$buy['agentid'],'is_agent'=>1))->find();
                //获取一级上级的权限
                $onelelver = db('member_level')->where(array('level'=>$onemember['level']))->find();
                    $one = db('member')->where(array('id'=>$buy['agentid']))->find();
                    $twomember = db('member')->where(array('id'=>$one['agentid'],'is_agent'=>1))->find();
                    //获取一级上级的权限
                    $twolelver = db('member_level')->where(array('level'=>$twomember['level']))->find();
                    $two = db('member')->where(array('id'=>$one['agentid']))->find();
                        $threemember = db('member')->where(array('id'=>$two['agentid'],'is_agent'=>1))->find();
                        //获取一级上级的权限
                        $threelelver = db('member_level')->where(array('level'=>$threemember['level']))->find();

            }
            $result = db('sell_lamb')->where('lambid',$lambid)->where('status',2)->where('exchange',1)->update(array('issend'=>1));
            $res = db('sell_lamb')->where('lambid',$lambid)->where('status',2)->where('exchange',3)->update(array('issend'=>1));
            //获取订单对应的商品订单表
            $order_goods = db('order_goods')->where(array('oid'=>$oid))->select();
            $count = db('commission_log')->where('ordersn',$isorder['ordersn'])->count();
            if($order_goods[0]['num']<=$count){
                return false;
            }
            $res1 = db('commission_log')->where(array('statue'=>3,'lambid'=>$lambid))->find();
            if($res1){
                return false;
            }

            if($res || $result){
                foreach ($order_goods as $v){
                    //1级
                    if(!empty($onelelver['iscommission'] && !empty($onemember))){
                        $onemoney = 0;
                        if($onelelver['commission_way']==1){
                            $onemoney = $onelelver['commission1'] ;
                        }else{
                            $onemoney = $onelelver['commission1']*$v['money']/100;
                        }
                        if($onelelver['commission_type']==1 && $onemoney>0){
                            $data = array(
                                'ordersn'=>$isorder['ordersn'],
                                'og_id'=>$v['id'],
                                'prizeid'=>$onemember['id'],
                                'money_type'=>1,
                                'money'=>$onemoney,
                                'type'=>1,
                                'content'=>'一级分销奖送'.$onemoney.'余额',
                                'stime'=>time(),
                                'etime'=>time(),
                                'statue'=>3,
                                'lambid'=>$lambid
                            );
                            db('commission_log')->insert($data);
                            db('member')->where('id',$onemember['id'] )->setInc('credit', $onemoney);
                            $recharge_data=array(
                                'userid'=>$onemember['id'],
                                'money'=>$onemoney,
                                'vary'=>1,
                                'type'=>1,
                                'time'=>time(),
                                'remark'=>'一级分销送',
                                'balance'=>$onemember['credit']+$onemoney,
                                'status'=>'1',
                                'lambid'=>$lambid
                            );
                            $isrecharge=db('recharge_log')->insert($recharge_data);
                        }elseif($onelelver['commission_type']==2 && $onemoney>0){
                            $data = array(
                                'ordersn'=>$isorder['ordersn'],
                                'og_id'=>$v['id'],
                                'prizeid'=>$onemember['id'],
                                'money_type'=>2,
                                'money'=>$onemoney,
                                'type'=>1,
                                'content'=>'一级分销奖送'.$onemoney.'积分',
                                'stime'=>time(),
                                'etime'=>time(),
                                'statue'=>3,
                                'lambid'=>$lambid
                            );
                            db('commission_log')->insert($data);
                            db('member')->where('id',$onemember['id'] )->setInc('credit2', $onemoney);
                            $recharge_data=array(
                                'userid'=>$onemember['id'],
                                'money_type'=>2,
                                'money'=>$onemoney,
                                'vary'=>1,
                                'type'=>1,
                                'time'=>time(),
                                'remark'=>'一级分销送',
                                'balance'=>$onemember['credit2']+$onemoney,
                                'status'=>'1',
                                'lambid'=>$lambid
                            );
                            $isrecharge=db('recharge_log')->insert($recharge_data);
                        }
                    }
                    //2级
                    if(!empty($twolelver['iscommission'] && !empty($twomember))){
                        $twomoney = 0;
                        if($twolelver['commission_way']==1){
                            $twomoney = $twolelver['commission2'];
                        }else{
                            $twomoney = $twolelver['commission2']*$v['money']/100;
                        }
                        if($twolelver['commission_type']==1 && $twomoney>0){
                            $data = array(
                                'ordersn'=>$isorder['ordersn'],
                                'og_id'=>$v['id'],
                                'prizeid'=>$twomember['id'],
                                'money_type'=>1,
                                'money'=>$twomoney,
                                'type'=>2,
                                'content'=>'二级分销奖送'.$twomoney.'余额',
                                'stime'=>time(),
                                'etime'=>time(),
                                'statue'=>3,
                                'lambid'=>$lambid
                            );
                            db('commission_log')->insert($data);
                            db('member')->where('id',$twomember['id'] )->setInc('credit', $twomoney);
                            $recharge_data=array(
                                'userid'=>$twomember['id'],
                                'money'=>$twomoney,
                                'vary'=>1,
                                'type'=>1,
                                'time'=>time(),
                                'remark'=>'二级分销送',
                                'balance'=>$twomember['credit']+$twomoney,
                                'status'=>'1',
                                'lambid'=>$lambid
                            );
                            $isrecharge=db('recharge_log')->insert($recharge_data);
                        }elseif($twolelver['commission_type']==2 && $twomoney>0){
                            $data = array(
                                'ordersn'=>$isorder['ordersn'],
                                'og_id'=>$v['id'],
                                'prizeid'=>$twomember['id'],
                                'money_type'=>2,
                                'money'=>$twomoney,
                                'type'=>2,
                                'content'=>'二级分销奖送'.$twomoney.'积分',
                                'stime'=>time(),
                                'etime'=>time(),
                                'statue'=>3,
                                'lambid'=>$lambid
                            );
                            db('commission_log')->insert($data);
                            db('member')->where('id',$twomember['id'] )->setInc('credit2', $twomoney);
                            $recharge_data=array(
                                'userid'=>$twomember['id'],
                                'money_type'=>2,
                                'money'=>$twomoney,
                                'vary'=>1,
                                'type'=>1,
                                'time'=>time(),
                                'remark'=>'二级分销送',
                                'balance'=>$twomember['credit2']+$twomoney,
                                'status'=>'1',
                                'lambid'=>$lambid
                            );
                            $isrecharge=db('recharge_log')->insert($recharge_data);
                        }
                    }//3级
                    if(!empty($threelelver['iscommission'] && !empty($threemember))){
                        $threemoney = 0;
                        if($threelelver['commission_way']==1){
                            $threemoney = $threelelver['commission3'];
                        }else{
                            $threemoney = $threelelver['commission3']*$v['money']/100;
                        }
                        if($threelelver['commission_type']==1 && $threemoney>0){
                            $data = array(
                                'ordersn'=>$isorder['ordersn'],
                                'og_id'=>$v['id'],
                                'prizeid'=>$threemember['id'],
                                'money_type'=>1,
                                'money'=>$threemoney,
                                'type'=>3,
                                'content'=>'三级分销奖送'.$threemoney.'余额',
                                'stime'=>time(),
                                'etime'=>time(),
                                'statue'=>3,
                                'lambid'=>$lambid
                            );
                            db('commission_log')->insert($data);
                            db('member')->where('id',$threemember['id'] )->setInc('credit', $threemoney);
                            $recharge_data=array(
                                'userid'=>$threemember['id'],
                                'money'=>$threemoney,
                                'vary'=>1,
                                'type'=>1,
                                'time'=>time(),
                                'remark'=>'三级分销送',
                                'balance'=>$threemember['credit']+$threemoney,
                                'status'=>'1',
                                'lambid'=>$lambid
                            );
                            $isrecharge=db('recharge_log')->insert($recharge_data);
                        }elseif($threelelver['commission_type']==2 && $threemoney>0){
                            $data = array(
                                'ordersn'=>$isorder['ordersn'],
                                'og_id'=>$v['id'],
                                'prizeid'=>$threemember['id'],
                                'money_type'=>2,
                                'money'=>$threemoney,
                                'type'=>3,
                                'content'=>'三级分销奖送'.$threemoney.'积分',
                                'stime'=>time(),
                                'etime'=>time(),
                                'statue'=>3,
                                'lambid'=>$lambid
                            );
                            db('commission_log')->insert($data);
                            db('member')->where('id',$threemember['id'] )->setInc('credit2', $threemoney);
                            $recharge_data=array(
                                'userid'=>$threemember['id'],
                                'money_type'=>2,
                                'money'=>$threemoney,
                                'vary'=>1,
                                'type'=>1,
                                'time'=>time(),
                                'remark'=>'三级分销送',
                                'balance'=>$threemember['credit2']+$threemoney,
                                'status'=>'1',
                                'lambid'=>$lambid
                            );
                            $isrecharge=db('recharge_log')->insert($recharge_data);
                        }
                    }
                    db('sell_lamb')->where('lambid',$lambid)->update(array('issend'=>1));
                }
            }
        }
    }
}