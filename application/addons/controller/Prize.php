<?php
namespace app\addons\controller;
use think\Controller;
use think\Session;
use think\Url;
use think\Config;
use think\Page;
use think\Verify;
use think\Image;
use think\Db;
use think\Request;
class Prize  extends Base 
{
    public function index(){
        if(!Session::has('user')){
            header("Location: ".url('/index/login/login'));
            exit();
        }
        if(Request::instance()->isGet()){
            $aid = input('get.aid');
            if(!empty($aid)){
                $time = time();
                $act = db('activity')->where(array('id'=>$aid,'stime'=>['<',$time],'etime'=>['>',$time],'status'=>1))->find();
                if(!empty($act)){
                    $list = db('activity_prize')->where(array('aid'=>$aid,'status'=>1))->select();
                    $this->assign('list',$list);
                    //计算个数
                    $listnum = count($list);
                    $jiaodu = 360/$listnum;
                    $this->assign('listnum',$listnum);
                    $this->assign('jiaodu',$jiaodu);
                    //用户的抽奖次数计算，，，测试送100次
                    $member = $this->member;
                    $ismember = db('activity_takenum')->where(array('uid'=>$member['id'],'aid'=>$aid))->find();
                    if(empty($ismember)){
                        $data  = array(
                            'aid' =>$aid,
                            'uid' =>$member['id'],
                            'take_num'=>100,
                        );
                        db('activity_takenum')->insert($data);
                        $this->assign('takenum', 100);
                    } else {
                        $this->assign('takenum', $ismember['take_num']);
                    }
                    
                    
                }else{
                    echo '活动不存在或活动已结束！';
                    die();
                }
            }else{
                echo '活动不存在或活动已结束！';
                die();
            }
        }else{
            echo '活动不存在或活动已结束！';
            die();
        }
        $this->assign('act',$act);
        $this->assign('aid',$aid);
        return $this->fetch();
    }
    public function getprize(){
        if(Request::instance()->isPost()){
            $aid = input('post.aid');
            if(!empty($aid)){
                //第一步先检测用户抽奖次数是否充足
                $ismember = db('activity_takenum')->where(array('uid'=>$this->member['id'],'aid'=>$aid))->find();
                if(empty($ismember['take_num'])){
                    return array('type'=>0,'msg'=>'抽奖次数不足！');
                }
                $time = time();
                $chances = 0;
                $act = db('activity')->where(array('id'=>$aid,'stime'=>['<',$time],'etime'=>['>',$time],'status'=>1))->find();
                if(!empty($act)){
                    $list = db('activity_prize')->where(array('aid'=>$aid))->select();
                    foreach ($list as $s => $v){
                        if($v['remain']){
                            $chances += $v['chance']*100000;
                            $list[$s]['rand'] =  $chances;
                        }
                    }
                    //未中奖部分,概率没有达到100，其他都是未中奖
                    if($chances<10000000){
                        $chances =10000000;
                    }
                    $sjs = rand(1,$chances);
                    //减少一次抽奖
                    db('activity_takenum')->where(array('uid'=> $this->member['id'],'aid'=>$aid))->setDec('take_num');
                    
                    foreach ($list as $s=>$v){
                        if($v['remain']){
                            if($sjs<=$v['rand']){
                                $logdata = array(
                                    'aid'=>$aid,
                                    'pid'=>$v['id'],
                                    'uid'=> $this->member['id'],
                                    'time'=>time(),
                                    'status'=>1
                                );
                                db('activity_prize_log')->insert($logdata);
                                //减少库存
                                db('activity_prize')->where(array('aid'=>$aid,'weight'=>$v['weight']))->setDec('remain');
                                return array('type'=>1,'msg'=>'恭喜你中奖了！','num'=> $v['weight'],'rand'=>$sjs );
                            }
                        }
                    }
                    return array('type'=>1,'msg'=>'未中奖！','num'=> 13,'rand'=>$sjs );
                }else{
                    return array('type'=>0,'msg'=>'活动不存在或活动已结束1！');
                }
            }else{
                return array('type'=>0,'msg'=>'活动不存在或活动已结束2！');
            }
        }else{
            return array('type'=>0,'msg'=>'活动不存在或活动已结束3！');
        }
    }

}