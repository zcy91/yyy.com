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
class User extends Base {
    public function index(){
        return $this->fetch();
    }
    public function userlist(){
        $get = Request::instance()->param();
        $mohu = ['id','username','mobile'];
        $timename = 'reg_time';
        $getwhere = getwhere('m.',$get,$mohu,$timename);
        $list=Db::name('member')
                ->field('m.*,ml.name levelname')
                ->alias('m')
                ->join('__MEMBER_LEVEL__ ml','m.level = ml.id','LEFT')
                ->order('m.id', 'desc')
                ->where($getwhere['where'])
                ->paginate(20,false,$getwhere['query'])->each(function($item, $key){
                $wctypeid = $item["id"]; //获取数据集中的id
                $num = Db::name('lamb')->where("uid='$wctypeid'")->where('paytime>0')->where('status',1)->count('id'); //根据ID查询相关其他信息
                $item['num'] = $num; //给数据集追加字段num并赋值
                return $item;
                });
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function useradd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $mobile = input('post.mobile');
                $isuser=Db::name('member')->where("mobile=$mobile")->find();
                if(empty($isuser)){
                    $data = input('post.');
                    $data['password'] = md5($data['password']);
                    $data['reg_time'] = time();
                    db('member')->insert($data);
                    return array('type'=>1,'msg'=>'添加成功');
                } else {
                    return array('type'=>0,'msg'=>'手机号重复添加失败');
                }
            }else{
                $data = input('post.');
                if(!empty($data['password'])){
                    $data['password'] = md5($data['password']);
                } else {
                    unset($data['password']);
                }
                db('member')->where('id', $id)->update($data);
                return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $myuser = Db::name('member')->where("id=$id")->find();
                $this->assign('myuser', $myuser);
            }
        }
        $mymember_level = Db::name('member_level')->where("id>0")->select();
        $this->assign('mymember_level', $mymember_level);
        return $this->fetch();
    }
    public function userlevel(){
        $userlevellist=Db::name('member_level')->where("id>0")->order('id', 'desc')->select();
        $this->assign('userlevellist', $userlevellist);
        return $this->fetch();
    }
    public function userleveladd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $name = input('post.name');
                $isuser=Db::name('member_level')->where(array('name'=>$name))->find();
                if(empty($isuser)){
                    $data = input('post.');
                    db('member_level')->insert($data);
                    echo '<script>alert("添加成功");</script>';
                } else {
                    echo '<script>alert("等级已存在添加失败");</script>';
                }
            }else{
                $data = input('post.');
                db('member_level')->where('id', $id)->update($data);
                echo '<script>alert("修改成功");</script>';
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id) && $id>0){
                $mymember_level = Db::name('member_level')->where("id=$id")->find();
                $this->assign('mymember_level', $mymember_level);
            }
        }
        return $this->fetch();
    }
    public function main(){
        return $this->fetch();
    }
    public function recharge(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(!empty($id)){
                //通过id计算当前余额
                $ismember = db('member')->where(array('id'=>$id))->find();
                $vary = input('post.vary');
                $type = input('post.type');
                $num = input('post.num');
                if($type==1){
                    if($vary==1){
                        $balance = $ismember['credit']+$num;
                    }else if($vary==2){
                        $balance = $ismember['credit']-$num;
                    }
                }else{
                    if($vary==1){
                        $balance = $ismember['credit2']+$num;
                    }else if($vary==2){
                        $balance = $ismember['credit2']-$num;
                    }
                }
                
                $recharge_data=array(
                    'userid'=>$id,
                    'money'=>$num,
                    'vary'=>$vary,
                    'money_type'=>$type,
                    'type'=>1,
                    'time'=>time(),
                    'remark'=>'后台充值',
                    'balance'=>$balance,
                    'status'=>'1',
                );
                $isrecharge=db('recharge_log')->insert($recharge_data);
                if(!empty($isrecharge)){
                    if($type==1){
                        if($vary==1){
                            Db::name('member')->where('id', $id)->setInc('credit', $num);
                        }else{
                            Db::name('member')->where('id', $id)->setDec('credit', $num);
                        }
                    }else{
                        if($vary==1){
                            Db::name('member')->where('id', $id)->setInc('credit2', $num);
                        }else{
                            Db::name('member')->where('id', $id)->setDec('credit2', $num);
                        }
                    }
                    
                    return array('type'=>1,'msg'=>'充值成功');
                } else {
                    return array('type'=>0,'msg'=>'充值失败');
                }
            }else{
                return array('type'=>0,'msg'=>'ID不存在');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $myuser = Db::name('member')->where("id=$id")->find();
                $this->assign('myuser', $myuser);
            }
        }
        return $this->fetch();
    }
    public function userdel(){
        if(Request::instance()->isPost()){
            $id = input('get.id');
            if($id>0){
                Db::name('member')->where('id',$id)->delete();
                echo $id;
            }else{
                echo '0';
            }
            
        }
    }
    public function addresslist(){
        $get = Request::instance()->param();
        $mohu = ['id','uid','phone','name','province','city','area','detailed'];
        $timename = 'time';
        $getwhere = getwhere('',$get,$mohu,$timename);
        $list=Db::name('address')
                ->order('id', 'desc')
                ->where($getwhere['where'])
                ->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function agentlist(){
        $list = db('member')->where(array('agentid'=>0,'status'=>0))->select();
        $this->assign('list', $list);
        return $this->fetch();
    }
    public function getagent(){
        $agentid = input('post.agentid');
        if(!empty($agentid)){
            $list = db('member')->where(array('agentid'=>$agentid))->select();
            if(!empty($list)){
                return array('type'=>1,"msg"=>'获取数据成功','data'=>$list);
            } else {
                return array('type'=>0,"msg"=>'没有下线');
            }
        } else {
            return array('type'=>0,'msg'=>'获取数据失败');
        }
    }
    public function pasture(){
        $get = Request::instance()->param();
        $mohu = ['id','username','mobile'];
        $timename = 'reg_time';
        $getwhere = getwhere('m.',$get,$mohu,$timename);
        $list = db('pasture')->alias('m') ->where($getwhere['where']) ->paginate(20,false,$getwhere['query']);;
        $this -> assign('list',$list);
        $this->assign('query', $getwhere['query']);
        return $this -> fetch();
    }
    public function xiaji(){
        $get = Request::instance()->param();
        $mohu = ['id','uid','phone','name','province','city','area','detailed'];
        $timename = 'time';
        $getwhere = getwhere('',$get,$mohu,$timename);
        $id = input('id');
        $list = db('member') -> where('pasture',$id) ->order('id', 'desc')
            ->where($getwhere['where'])
            ->paginate(20,false,$getwhere['query'])->each(function($item, $key){
                $wctypeid = $item["id"]; //获取数据集中的id
                $num = Db::name('lamb')->where("uid='$wctypeid'")->where('paytime>0')->count('id'); //根据ID查询相关其他信息
                $item['num'] = $num; //给数据集追加字段num并赋值
                return $item;
            });

        $this->assign('query', $getwhere['query']);
        $this->assign('list', $list);
        return $this -> fetch();
    }
    public function exchange(){
        $get = Request::instance()->param();
        $mohu = ['id','lambsn','lambname'];
        $timename = 'paytime';
        $getwhere = getwhere('',$get,$mohu,$timename);
        $uid = input('uid');
        //var_dump($uid);die;
        $list = Db::name('lamb')->where("uid='$uid'")->where('paytime>0')->where('status',1) ->order('id', 'desc')
            ->where($getwhere['where']) ->paginate(20,false,$getwhere['query']);;
        $this->assign('list', $list);
        $this->assign('uid',$uid);
        return $this -> fetch();
    }
    public function exchangelvyou(){
        $sheep_id = input('id');
        $uid = input('uid');
        if(!empty($sheep_id)){
            $this->assign('sheep_id',$sheep_id);
        }
        $mylamb = db('lamb')
            ->field('l.id,l.lambname,l.message,l.paytime,g.price,g.gname,g.img,g.cycle,g.percentage ')
            ->alias('l')
            ->join('__GOODS__ g','l.gid = g.id','LEFT')
            ->where(array('l.id'=>$sheep_id,'l.status'=>1) )
            ->find();
        $tourtype = db('tour_type')->select();
        $list=Db::name('address')->where('uid',$uid)->order('defaults','desc')->select();
        $this->assign('list',$list);
        $this->assign('id',$sheep_id);
        $this->assign('mylamb', $mylamb);
        $this->assign('tourtype',$tourtype);
        $this->assign('uid',$uid);
        return $this->fetch();
    }

    public function exchangeproduct(){
        $sheep_id = input('id');
        $uid = input('uid');
        if(!empty($sheep_id)){
            $this->assign('sheep_id',$sheep_id);
        }
        $mylamb = db('lamb')
            ->field('l.id,l.lambname,l.message,l.paytime,g.price,g.gname,g.img,g.cycle,g.percentage ')
            ->alias('l')
            ->join('__GOODS__ g','l.gid = g.id','LEFT')
            ->where(array('l.id'=>$sheep_id,'l.status'=>1) )
            ->find();
        $tourtype = db('tour_type')->select();
        $list=Db::name('address')->where('uid',$uid)->order('defaults','desc')->select();
        $this->assign('list',$list);
        $this->assign('id',$sheep_id);
        $this->assign('mylamb', $mylamb);
        $this->assign('tourtype',$tourtype);
        $this->assign('uid',$uid);
        return $this->fetch();
    }
    public function selllamb(){
        if(Request::instance()->isPost()){
            $buyid = input('post.buyid');
            $lambid = input('post.lambid');
            $exchange = input('post.exchange');
            $lambmoney = input('post.lambmoney');
            $autograph = input('post.autograph');
            $uid = input('post.uid');
            if(!$uid){
                $uid = $this->member['id'];
            }
            $tourtype = input('post.tourtype');
            $tourlist = input('post.tourlist');
            $islamb = db('lamb')->where(array('id'=>$lambid,'uid'=> $uid))->find();
            if(empty($islamb)){
                return array('type'=>0,'msg'=>'这只羊好像不是你的哦！');
            }else if($islamb['status']!=1){
                return array('type'=>0,'msg'=>'羊圈中未找到该羊，或已出售！');
            }else{
                $data['sellsn'] = 'BUY'.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
                $data['creationtime'] = time();
                $data['buyid'] = $buyid;
                $data['uid'] = $uid;
                $data['lambid'] = $lambid;
                $data['autograph'] = $autograph;
                if($exchange == 2){
                    $id = input('id');
                    $mylamb = db('lamb')
                        ->field('l.id,l.gid,l.lambname,l.lambsn,l.message,l.paytime,g.price,g.gname,g.img,g.cycle,g.percentage ')
                        ->alias('l')
                        ->join('__GOODS__ g','l.gid = g.id','LEFT')
                        ->where(array('l.id'=>$id,'l.status'=>1) )
                        ->find();
                    //成长天数
                    $czday = differday($mylamb['paytime'], time());
                    //计算羊羔是否成熟
                    if($czday>=$mylamb['cycle']){
                        $islamb = TRUE;
                    }else{
                        return array('type'=>0,'msg'=>'该羊羔未成熟，请耐心等待~~');
                    }
                    //预计收益
                    $yjsy = reckonProfit($mylamb['price'], $mylamb['cycle'], $mylamb['percentage']);
                    $lambmoney = $yjsy + $mylamb['price'];
                }
                $data['money'] = $lambmoney;
                $data['exchange'] = $exchange;
                if($buyid>0){
                    $data['status'] = 1;
                    //$data['completetime'] = time();
                    $istx = db('sell_lamb')->insert($data);
                    if($istx){
                        db('lamb')->where(array('id'=>$lambid))->update(array('status'=>3));
                        return array('type'=>1,'msg'=>'赠送申请成功');
                    }else{
                        return array('type'=>0,'msg'=>'赠送申请失败');
                    }
                }elseif($exchange == 1){
                    $data['status'] = 1;
                    $data['address_id'] = input('post.address_id');
                    //$data['completetime'] = time();
                    $istx = db('sell_lamb')->insert($data);
                    if($istx){

                        db('lamb')->where(array('id'=>$lambid))->update(array('status'=>3));
                        $oid = db('lamb')->where('id',$lambid)->value('oid');
                        $this->setCommissionOne($oid,$lambid);
                        return array('type'=>1,'msg'=>'兑换成功,您已成为我是牧场主尊贵的代理,享受代理权利');
                    }else{
                        return array('type'=>0,'msg'=>'申请失败');
                    }
                }else{
                    $data['status'] = 1;
                    if(!empty($tourtype)){
                        $tour = db('tour') -> where('catid',$tourtype) -> value('price_ladder');
                        $tour = unserialize($tour);
                        if(empty($tourlist)){
                            return array('type'=>0,'msg'=>'请选择行程');
                        }
                        foreach($tour as $k=>$v){
                            if($v['num'] == $tourlist){
                                $key = $k;
                                $people = $v['people'];
                                $stime = $v['arrive'];
                            }
                        }
                        if($people>0){
                            $people = $people - 1;
                            $tour[$key]['people'] = $people;
                            $tour = serialize($tour);
                            db('tour') -> where('catid',$tourtype) -> update(array('price_ladder'=>$tour));
                        }else{
                            return array('type'=>0,'msg'=>'上限人数已满');
                        }
                        $data['tourtype'] =  $tourtype;
                        $data['tourlist'] = $tourlist;
                        $data['mobile'] = input('post.mobile');
                        $data['realname_da'] = input('post.realname_da');
                        $data['cartid'] = input('post.cartid');
                        $data['realname1'] = input('post.realname1');
                        $data['cartid1'] = input('post.cartid1');
                        $data['realname0'] = input('post.realname0');
                        $data['cartid0'] = input('post.cartid0');
                        $data['stime'] = strtotime($stime);
                        if(!($data['mobile'] && $data['realname_da'] && $data['cartid'])){
                            return array('type'=>0,'msg'=>'请完整填写大人信息');
                        }
                        if($data['realname0']){
                            if(!$data['cartid0']){
                                return array('type'=>0,'msg'=>'请完整填写儿童身份证信息');
                            }
                        }
                        if($data['realname1']){
                            if(!$data['cartid1']){
                                return array('type'=>0,'msg'=>'请完整填写儿童身份证信息');
                            }
                        }
                    }else{
                        return array('type'=>0,'msg'=>'请选择线路');
                    }

                    $istx = db('sell_lamb')->insert($data);
                    if($istx){
                        db('lamb')->where(array('id'=>$lambid))->update(array('status'=>2));
                        $oid = db('lamb')->where('id',$lambid)->value('oid');
                        $this->setCommissionOne($oid,$lambid);
                        return array('type'=>1,'msg'=>'兑换成功,您已成为我是牧场主尊贵的代理,享受代理权利');
                    }else{
                        return array('type'=>0,'msg'=>'申请失败');
                    }
                }

            }
        }else{
            return array('type'=>0,'msg'=>'请求失败...');
        }
    }
    /**
     * 获取用户真实 IP
     */
    function getIP()
    {
        static $realip;
        if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }
    public function ajaxlvyou(){
        if(Request::instance()->isPost()) {
            $id = input('id');
            $arr = db('tour') -> where('catid',$id) ->where('status',1)-> find();

            if (!empty($arr)) {
                $data = unserialize($arr['price_ladder']);
            }
            if(!empty($data)){
                foreach ($data as $k=>$v){
                    if(strtotime($v['arrive'])<=(time()+3600*24)){
                        unset($data["$k"]);
                    }
                }
                return array('type'=>1,'data'=>$data,'arr'=>$arr);
            }else
                return array('type'=> 0,'data'=>'未找到相关行程');
        }
    }
    public function setCommissionOne($oid,$lambid){
        //获取订单信息

        $isorder = db('order')->where(array('id'=>$oid,'status'=>['>=',1],'status'=>['<',4]))->find();
        if(!empty($isorder['uid'])){
            //获取买家信息
            $ip = $this->getIP();
            //$city = $this ->getCity($ip)['city'];
            $starttime = strtotime(date('Y-m-d'));
            $endtime =  $starttime +24*3600;
            $count = db('agent')->where("addtime >= $starttime and addtime <= $endtime")->count();
            $num = $count + 1;
            $temp_num = 10000;
            $new_num = $num + $temp_num;
            $real_num = substr($new_num,1,4); //即截取掉最前面的“1”
            $code = "SHBCY".date('Ymd').$real_num;
            $time = strtotime("+1 year",time());
            $time = date('Y-m-d',$time);
            $endtime = strtotime($time);
            $buy = db('member')->where(array('id'=>$isorder['uid']))->find();
            \db('member') ->where(['id'=>$isorder['uid']])->update(['is_agent'=>1]);
            db('agent')->insert(['uid'=>$isorder['uid'],'addtime'=>time(),'ip'=>$ip,'code'=>$code,'lambid'=>$lambid,'oid'=>$oid,'endtime'=>$endtime]);
            //获取买家上级
            if(!empty($buy['agentid'])){
                $onemember = db('member')->where(array('id'=>$buy['agentid'],'is_agent'=>1))->find();
                //获取一级上级的权限
                $one = db('member')->where(array('id'=>$buy['agentid']))->find();
                $onelelver = db('member_level')->where(array('level'=>$one['level']))->find();

                $twomember = db('member')->where(array('id'=>$one['agentid'],'is_agent'=>1))->find();
                //获取一级上级的权限
                $two = db('member')->where(array('id'=>$one['agentid']))->find();
                $twolelver = db('member_level')->where(array('level'=>$two['level']))->find();

                $threemember = db('member')->where(array('id'=>$two['agentid'],'is_agent'=>1))->find();
                //获取一级上级的权限
                $threelelver = db('member_level')->where(array('level'=>$threemember['level']))->find();

            }
            $result = db('sell_lamb')->where('lambid',$lambid)->where('status',1)->where('exchange',1)->update(array('issend'=>1));
            $res = db('sell_lamb')->where('lambid',$lambid)->where('status',1)->where('exchange',3)->update(array('issend'=>1));
            //获取订单对应的商品订单表
            $order_goods = db('order_goods')->where(array('oid'=>$oid))->select();
//                $count = db('commission_log')->where('ordersn',$isorder['ordersn'])->count();
//                if($order_goods[0]['num']<=$count){
//                    return false;
//                }
            $res1 = db('commission_log')->where(array('statue'=>3,'lambid'=>$lambid))->find();
            if($res1){
                return false;
            }
            //2000单价不返利
            $order = db('order_goods') ->where('oid',$oid)->find();
            $price = $order['money']/$order['num'];
            if($price == 2000){
                return false;
            }
            if(empty($onelelver)){
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
                    if(empty($twolelver)){
                        return false;
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
                    if(empty($threelelver)){
                        return false;
                    }
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