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
use wxpay;
class Capital extends Base {
    public function index(){
        return $this->fetch();
    }
    public function withdrawals(){
        $get = Request::instance()->param();
        $mohu = ['id','uid','applysn'];
        $timename = 'applytime';
        $getwhere = getwhere('w.',$get,$mohu,$timename);
        $list=Db::name('withdrawals')
                ->field('w.*,m.username')
                ->alias('w')
                ->join('__MEMBER__ m','m.id = w.uid','LEFT')
                ->order('w.id', 'desc')
                ->where($getwhere['where'])
                ->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function moneylog(){
        $get = Request::instance()->param();
        $mohu = ['id','userid','rechargesn'];
        $timename = 'time';
        $getwhere = getwhere('rl.',$get,$mohu,$timename);
        $list=Db::name('recharge_log')
                ->field('rl.*,m.username')
                ->alias('rl')
                ->join('__MEMBER__ m','m.id = rl.userid','LEFT')
                ->order('rl.id', 'desc')
                ->where($getwhere['where'])
                ->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function paymoney(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            $type= input('post.type');
            if(!empty($id)){
                $isstatus = Db::name('withdrawals')->where('id',$id)->find();
                if($isstatus['status']==1){
                    if($type==1){
                        if(!empty($isstatus['uid'])){
                            $ismember = db('member')->where(array('id'=>$isstatus['uid']))->find();
                            if(!empty($ismember['openid'])){
                                $config = array(
                                    'wxappid'		=> 'wx39eef0e1655086aa',
                                    'mch_id'	 	=> '1487835822',
                                    'pay_apikey' 	=> 'lijing1118lijing1118lijing1118li',
                                    'api_cert'		=> EXTEND_PATH.'/wxpay/cert/apiclient_cert.pem',	
                                    'api_key'		=> EXTEND_PATH.'/wxpay/cert/apiclient_key.pem'
                                );
                                $redpack = new wxpay\WxRedpack($config);//初始化类(同时传递参数)
                                $content = $redpack->mchpay($ismember['openid'],$isstatus['money'],$isstatus['applysn'],'微信红包提现');  
                                if(!empty($content['return_code'])){
                                    $ispay = Db::name('withdrawals')->where('id',$id)->update(array('status'=>2,'money_pay'=>$isstatus['money']));
                                    return array('type'=>1,'msg'=>'微信打款成功。');
                                }else{
                                    return array('type'=>0,'msg'=>'微信打款失败,'.$content['msg']);
                                }
                            }else{
                                return array('type'=>0,'msg'=>'无法获取该用户的openid，不能微信打款。');
                            }
                        }else{
                            return array('type'=>0,'msg'=>'打款失败，获取用户信息不成功。');
                        }
                        
                    }elseif($type==2){
                        $ispay = Db::name('withdrawals')->where('id',$id)->update(array('status'=>2,'money_pay'=>$isstatus['money']));
                        if($ispay){
                            return array('type'=>1,'msg'=>'线下打款成功！');
                        }else{
                            return array('type'=>0,'msg'=>'线下打款失败！');
                        }
                    }elseif ($type==0) {
                        $ispay = Db::name('withdrawals')->where('id',$id)->update(array('status'=>'-1','money_pay'=>$isstatus['money']));
                        $isuser = Db::name('member')->where('id',$isstatus['uid'])->setInc('credit', $isstatus['money']);
                        $ismember = db('member')->where(array('id'=>$isstatus['uid']))->find();
                        if($ispay){
                            $recharge_data=array(
                                'userid'=>$isstatus['uid'],
                                'money'=> $isstatus['money'],
                                'vary'=>1,
                                'type'=>1,
                                'time'=>time(),
                                'remark'=>'提现申请驳回',
                                'balance'=>$ismember['credit'],
                                'status'=>'1',
                            );
                            $isrecharge=db('recharge_log')->insert($recharge_data);
                            return array('type'=>1,'msg'=>'驳回申请成功！');
                        }else{
                            return array('type'=>0,'msg'=>'驳回申请失败！');
                        }
                    }
                } else {
                    return array('type'=>0,'msg'=>'已处理申请，无须重复审核。');
                }
            }else{
                return array('type'=>0,'msg'=>'id不能为空');
            }
        }else{
            return array('type'=>0,'msg'=>'请求失败');
        }
    }
    //佣金明细
    public function commission_log(){
        $get = Request::instance()->param();
        $mohu = ['id','prizeid','ordersn'];
        $timename = 'stime';
        $getwhere = getwhere('rl.',$get,$mohu,$timename);
        $list=Db::name('commission_log')
            ->field('rl.*,m.username')
            ->alias('rl')
            ->join('__MEMBER__ m','m.id = rl.prizeid','LEFT')
            ->order('rl.id', 'desc')
            ->where($getwhere['where'])
            ->paginate(20,false,$getwhere['query']);
        //dump($list);die;
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }

}