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
class Set extends Base {
    public function index(){
        return $this->fetch();
    }
    public function setting(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                db('setting')->insert($data);
                echo '<script>alert("添加成功");</script>';
            }else{
                $data = input('post.');
                db('setting')->where('id', $id)->update($data);
                echo '<script>alert("修改成功");</script>';
            }
        }
        $setting = Db::name('setting')->order('id', 'desc')->find();
        $this->assign('setting', $setting);
        return $this->fetch();
    }
    public function wxset(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                db('wx_set')->insert($data);
                echo '<script>alert("添加成功");</script>';
            }else{
                $data = input('post.');
                db('wx_set')->where('id', $id)->update($data);
                echo '<script>alert("修改成功");</script>';
            }
        }
        $wxset = Db::name('wx_set')->order('id', 'desc')->find();
        $this->assign('wxset', $wxset);
        return $this->fetch();
    }
    public function alipay(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                db('set_alipay')->insert($data);
                echo '<script>alert("添加成功");</script>';
            }else{
                $data = input('post.');
                db('set_alipay')->where('id', $id)->update($data);
                echo '<script>alert("修改成功");</script>';
            }
        }
        $alipay = Db::name('set_alipay')->order('id', 'desc')->find();
        $this->assign('alipay', $alipay);
        return $this->fetch();
    }
    public function smsset(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                db('sms_set')->insert($data);
                echo '<script>alert("添加成功");</script>';
            }else{
                $data = input('post.');
                db('sms_set')->where('id', $id)->update($data);
                echo '<script>alert("修改成功");</script>';
            }
        }
        $smsset = Db::name('sms_set')->order('id', 'desc')->find();
        $this->assign('smsset', $smsset);
        return $this->fetch();
    }
     public function emailset(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                db('email_set')->insert($data);
                echo '<script>alert("添加成功");</script>';
            }else{
                $data = input('post.');
                db('email_set')->where('id', $id)->update($data);
                echo '<script>alert("修改成功");</script>';
            }
        }
        $emailset = Db::name('email_set')->order('id', 'desc')->find();
        $this->assign('emailset', $emailset);
        return $this->fetch();
    }
    public function testemail(){
        $status =  $this->sendmail('测试邮件', '这是一份测试邮件，测试邮件的内容我就不多写了，恭喜你成功了。');
        if(!empty($status['status'])){
            return array('type'=>1,'msg'=>$status['msg']);
        }else{
            return array('type'=>0,'msg'=>$status['msg']);
        }
    }
    public function menu(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                db('wx_set')->insert($data);
                echo '<script>alert("添加成功");</script>';
            }else{
                $data = input('post.');
                db('wx_set')->where('id', $id)->update($data);
                echo '<script>alert("修改成功");</script>';
            }
        }
        $list = Db::name('wx_menu')->order('listorder', 'ASC')->select();
        $list = $this->menuRow($list);
        $this->assign('list', $list);
        return $this->fetch();
    }
    public function menuRow($cate , $lefthtml = '|— ' , $pid=0 , $lvl=0, $leftpin=0 ){
		$arr=array();
		foreach ($cate as $v){
			if($v['pid']==$pid){
				$v['lvl']=$lvl + 1;
				$v['leftpin']=$leftpin + 0;
				$v['lefthtml']=str_repeat($lefthtml,$lvl);
				$v['ltitle']=$v['lefthtml'].$v['name'];
				$arr[]=$v;
				$arr= array_merge($arr, $this->menuRow($cate,$lefthtml,$v['id'], $lvl+1 ,$leftpin+20));
			}
		}

		return $arr;
    }
    public function addmenu(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                db('wx_menu')->insert($data);
                echo '<script>alert("添加成功");</script>';
            }else{
                $data = input('post.');
                db('wx_menu')->where('id', $id)->update($data);
                echo '<script>alert("修改成功");</script>';
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $mymenu = Db::name('wx_menu')->where("id=$id")->find();
                $this->assign('mymenu', $mymenu);
            }
        }
        $pmenu = Db::name('wx_menu')->where('pid','0')->order('id', 'desc')->select();
        $this->assign('pmenu', $pmenu);
        return $this->fetch();
    }
    public function menudel(){
        if(Request::instance()->isPost()){
            $id = input('get.id');
            if($id>0){
                Db::name('wx_menu')->where('id',$id)->delete();
                echo $id;
            }else{
                echo '0';
            }
            
        }
    }
    public function createmenu(){
        $wx=db('wx_set')->where('id>0')->find();//读取微信配置参数
        $access_token = $this->get_access_token($wx['appid'],$wx['appsecret']);
        //获取父级菜单
        $p_menus = db('wx_menu')->where(array('pid'=>0))->order('id ASC')->select();
        $p_menus = convert_arr_key($p_menus,'id');
        $post_str = $this->convert_menu($p_menus);
        // http post请求
        if(!count($p_menus) > 0){
            $back['info'] = "没有菜单可发布";
            $back['code'] =0;
            return $back;
        }
        $url ="https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
        $return = httpRequest($url,'POST',$post_str);
        $return = json_decode($return,1);
        if($return['errcode'] == 0){
            $back['info'] = "菜单已成功生成";
            $back['code'] =1;
        }else{
            $back['info'] = "错误代码;".$return['errcode'];
            $back['code'] =0;
        }
        return $back;
    }
    //获取微信access_token
    public function get_access_token($appid,$appsecret){
        //判断是否过了缓存期
        $wxUser = db('wx_set');
        $wechat = $wxUser->find();
        $expire_time = $wechat['web_expires'];
        if($expire_time > time()){
            return $wechat['web_access_token'];
        }
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
        $return = httpRequest($url,'GET');
        $return = json_decode($return,1);
        $web_expires = time() + 7000; // 提前200秒过期
        $wxUser->where(array('id'=>$wechat['id']))->update(array('web_access_token'=>$return['access_token'],'web_expires'=>$web_expires));
        return $return['access_token'];
    }
        //菜单转换
    private function convert_menu($p_menus){
        $new_arr = array();
        $count = 0;
        $wxMenu = db('wx_menu');
        foreach($p_menus as $k => $v){
            $new_arr[$count]['name'] = $v['name'];
            //获取子菜单
            $c_menus = $wxMenu->where(array('pid'=>$k))->select();

            if($c_menus){
                foreach($c_menus as $kk=>$vv){
                    $add = array();
                    $add['name'] = $vv['name'];
                    $add['type'] = $vv['type'];
                    // click类型
                    if($add['type'] == 'click'){
                        $add['key'] = $vv['value'];
                    }elseif($add['type'] == 'view'){
                        $add['url'] = $vv['value'];
                    }else{
                        $add['key'] = $vv['value'];
                    }
                    $add['sub_button'] = array();
                    if($add['name']){
                        $new_arr[$count]['sub_button'][] = $add;
                    }
                }
            }else{
                $new_arr[$count]['type'] = $v['type'];
                // click类型
                if($new_arr[$count]['type'] == 'click'){
                    $new_arr[$count]['key'] = $v['value'];
                }elseif($new_arr[$count]['type'] == 'view'){
                    //跳转URL类型
                    $new_arr[$count]['url'] = $v['value'];
                }else{
                    //其他事件类型
                    //$new_arr[$count]['key'] = $key_map[$v['type']];
                    $new_arr[$count]['key'] = $v['value'];  //2016年9月29日01:40:13
                }
            }
            $count++;
        }
        return json_encode(array('button'=>$new_arr),JSON_UNESCAPED_UNICODE);
    }
    public function sqlselect(){
        if(Request::instance()->isPost()){
            $sql = input('post.sql');
            $selectstr = substr( $sql, 0, 6 );
            if($selectstr != 'select' &&  $selectstr != 'SELECT'){
                return array('type'=>0,'msg'=>'查询失败,您输入的不是查询语句！');      
            }
            //return array('type'=>0,'msg'=>$sql);  
            $list = db('user')->query($sql);
            if($list){
                return array('type'=>1,'data'=>$list,'msg'=>'查询成功！');        
            }else{
                return array('type'=>0,'msg'=>'查询失败！');        
            }
        }
        return $this->fetch();
    }
    public function adminlog(){
        $list = db('admin_log')->order('id', 'desc')->paginate(20);
        $this->assign('list', $list);
        return $this->fetch();
    }
    //合同设置
    public function contractset(){
        if(Request::instance()->isPost()){
            $id = input('post.id');
            $parameter = Request::instance()->param()['parameter'];
            $parameter = serialize($parameter);
            if(empty($id)){
                db('contract_set')->insert(array('parameter'=>$parameter,'background'=> input('post.background')));
                echo '<script>alert("添加成功");</script>';
            }else{
                db('contract_set')->where('id', $id)->update(array('parameter'=>$parameter,'background'=> input('post.background')));
                echo '<script>alert("修改成功");</script>';
            }
        }
        $contractset = Db::name('contract_set')->where('id',2)->find();
        if(!empty($contractset['parameter'])){
            $contractset['parameter'] =  unserialize($contractset['parameter']);
        }
        $this->assign('contractset', $contractset);
        return $this->fetch();
    }

    //转让合同设置
    public function contractset1(){
        if(Request::instance()->isPost()){
            $id = input('post.id');
            $parameter = Request::instance()->param()['parameter'];
            $parameter = serialize($parameter);
            if(empty($id)){
                db('contract_set')->insert(array('parameter'=>$parameter,'background'=> input('post.background')));
                echo '<script>alert("添加成功");</script>';
            }else{
                db('contract_set')->where('id', $id)->update(array('parameter'=>$parameter,'background'=> input('post.background')));
                echo '<script>alert("修改成功");</script>';
            }
        }
        $contractset = Db::name('contract_set')->where('id',3)->find();
        if(!empty($contractset['parameter'])){
            $contractset['parameter'] =  unserialize($contractset['parameter']);
        }
        $this->assign('contractset', $contractset);
        return $this->fetch();
    }

        //通用的删除记录方法
    /***
     * 表名，ID
     */
    public function deldata(){
        if(Request::instance()->isPost()){
            $id = input('id');
            $tabname = input('tabname');
            if(!empty($id)){
                Db::name($tabname)->where('id',$id)->delete();
                echo $id;
            }else{
                echo '0';
            }
            
        }
    }
    
    
    /**
     * 通用导出Excel表格
     */
    public function export(){
        
        $tablename = input('tablename');
        $get = Request::instance()->param();
        if($tablename=='lamb'){
            $mohu = ['id','uid','lambsn'];
            $timename = 'creationtime';
            $getwhere = getwhere('l.',$get,$mohu,$timename);
            $list=Db::name('lamb')
                    ->field('l.id,l.lambsn,g.gname,l.lambname,l.message,l.uid,m.username,l.status')
                    ->alias('l')
                    ->join('__MEMBER__ m','m.id = l.uid','LEFT')
                    ->join('__GOODS__ g','g.id = l.gid','LEFT')
                    ->order('l.id', 'desc')
                    ->where($getwhere['where'])
                    ->select();
            $headTitle = "羊羔信息导出"; 
            $title = "羊羔信息导出".date("Y-m-d H:i:s",time()) ; 
            $headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>"; 
            $titlename = "<tr> 
                           <th style='width:70px;' >ID</th> 
                           <th style='width:70px;' >羊羔耳标</th> 
                           <th style='width:70px;'>羊羔期数</th> 
                           <th style='width:150px;'>羊羔昵称</th> 
                           <th style='width:70px;'>羊羔寄语</th> 
                           <th style='width:100px;'>羊羔主人ID</th> 
                           <th style='width:70px;'>羊羔主人昵称</th> 
                           <th style='width:70px;'>羊羔状态</th> 
                       </tr>"; 
            $filename = $title.".xls"; 
        }elseif ($tablename=='goods') {
            $mohu = ['id','gname','price'];
            $timename = 'reg_time';
            $getwhere = getwhere('',$get,$mohu,$timename);
            $list=Db::name('goods')->field('id,gname,price,stock,percentage,cycle,limitnum,integral,status')->where(array('status'=>['>=',0]))->order('id', 'desc')->where($getwhere['where'])->select();
            $headTitle = "商品信息导出"; 
            $title = "商品信息导出".date("Y-m-d H:i:s",time()) ; 
            $headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>"; 
            $titlename = "<tr> 
                           <th style='width:70px;' >ID</th> 
                           <th style='width:70px;' >商品名称</th> 
                           <th style='width:70px;'>商品价格</th> 
                           <th style='width:150px;'>商品库存</th> 
                           <th style='width:150px;'>年化率%</th> 
                           <th style='width:150px;'>周期</th> 
                           <th style='width:150px;'>限购</th> 
                           <th style='width:150px;'>购买送积分</th> 
                           <th style='width:70px;'>状态</th> 
                       </tr>"; 
            $filename = $title.".xls"; 
        }elseif ($tablename=='member') {
            $mohu = ['id','username','mobile'];
            $timename = 'reg_time';
            $getwhere = getwhere('m.',$get,$mohu,$timename);
            $list=Db::name('member')
                    ->field('m.id,m.username,m.realname,m.mobile,m.email,m.cardid,m.agentid,m.sex,m.credit,m.credit2,m.reg_time')
                    ->alias('m')
                    ->join('__MEMBER_LEVEL__ ml','m.level = ml.id','LEFT')
                    ->order('m.id', 'desc')
                    ->where($getwhere['where'])
                    ->select();
            $headTitle = "用户信息导出"; 
            $title = "用户信息导出".date("Y-m-d H:i:s",time()) ; 
            $headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>"; 
            $titlename = "<tr> 
                           <th style='width:70px;' >ID</th> 
                           <th style='width:70px;' >昵称</th> 
                           <th style='width:150px;'>真实姓名</th> 
                           <th style='width:70px;'>手机</th> 
                           <th style='width:70px;'>邮箱</th> 
                           <th style='width:70px;'>身份证</th> 
                           <th style='width:150px;'>上级ID</th> 
                           <th style='width:150px;'>性别</th> 
                           <th style='width:150px;'>余额</th> 
                           <th style='width:150px;'>积分</th> 
                           <th style='width:150px;'>创建时间</th> 
                       </tr>"; 
            $filename = $title.".xls"; 
            foreach ($list as $s=>$v){
                $list[$s]['reg_time'] = date("Y-m-d H:i:s",$v['reg_time']);
            }
            
        }elseif ($tablename=='address') {
            $mohu = ['id','uid','phone','name','province','city','area','detailed'];
            $timename = 'time';
            $getwhere = getwhere('',$get,$mohu,$timename);
            $list=Db::name('address')
                    ->field('id,uid,name,phone,province,city,area,detailed,defaults,time')
                    ->order('id', 'desc')
                    ->where($getwhere['where'])
                    ->select();
            $headTitle = "地址信息导出"; 
            $title = "地址信息导出".date("Y-m-d H:i:s",time()) ; 
            $headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>"; 
            $titlename = "<tr> 
                           <th style='width:70px;' >ID</th> 
                           <th style='width:70px;' >用户ID</th> 
                           <th style='width:150px;'>用户名</th> 
                           <th style='width:70px;'>手机</th> 
                           <th style='width:70px;'>省份</th> 
                           <th style='width:70px;'>地级市</th> 
                           <th style='width:150px;'>市县</th> 
                           <th style='width:150px;'>详细地址</th> 
                           <th style='width:150px;'>是否默认</th> 
                           <th style='width:150px;'>创建时间</th> 
                       </tr>"; 
            $filename = $title.".xls"; 
            foreach ($list as $s=>$v){
                $list[$s]['time'] = date("Y-m-d H:i:s",$v['time']);
            }
            
        }if($tablename=='order'){
            $mohu = ['id','ordersn','uid'];
            $timename = 'creationtime';
            $getwhere = getwhere('o.',$get,$mohu,$timename);
            $list=Db::name('order')
                    ->field('o.id,o.ordersn,g.gname,og.num,o.money,o.integral,m.username,m.realname,m.mobile,o.uid,o.creationtime,o.status,m.agentid,s.realname as agent_realname,s.username as agent_username')
                    ->alias('o')
                    ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
                    ->join('__MEMBER__ m','o.uid = m.id','LEFT')
                    ->join('__GOODS__ g','og.gid = g.id','LEFT')
                    ->join('__MEMBER__ s','m.agentid = s.id','LEFT')
                    ->order('o.id', 'desc')
                    ->where($getwhere['where'])
                    ->select();
            $headTitle = "订单信息导出"; 
            $title = "订单信息导出".date("Y-m-d H:i:s",time()) ; 
            $headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>"; 
            $titlename = "<tr> 
                           <th style='width:70px;' >ID</th> 
                           <th style='width:70px;' >订单号</th> 
                           <th style='width:150px;'>商品名称</th> 
                           <th style='width:70px;'>购买数量</th> 
                           <th style='width:70px;'>商品总价</th> 
                           <th style='width:70px;'>积分总价</th> 
                            
                           <th style='width:70px;'>用户ID</th> 
                           <th style='width:150px;'>下单时间</th> 
                           <th style='width:150px;'>状态</th> 
                           <th style='width:120px;'>购买用户</th> 
                           <th style='width:100px;'>上级用户</th>
                       </tr>"; 
            $filename = $title.".xls"; 
            $statusstr = array('0'=>'待付款','1'=>'已付款','2'=>'待收货','3'=>'完成','4'=>'关闭',);
            foreach ($list as $s=>$v){
	            $list[$s]['user'] = 'ID:'.$v['uid'].'    姓名:'.$v['realname']."({$v['username']}    {$v['mobile']})";
	            $list[$s]['agent_user'] = 'ID:'.$v['agentid'].'    姓名:'.$v['agent_realname']."({$v['agent_username']})";
	            unset($list[$s]['username'],$list[$s]['realname'],$list[$s]['mobile'],$list[$s]['agentid'],$list[$s]['agent_realname'],$list[$s]['agent_username']);
	            
                $list[$s]['creationtime'] = date("Y-m-d H:i:s",$v['creationtime']);
                $list[$s]['status'] = $statusstr[$v['status']];
            }
        }
        if ( $tablename=='tixianshenqing' ){
			$mohu = ['id','uid','applysn'];
        	$timename = 'applytime';
        	$getwhere = getwhere('w.',$get,$mohu,$timename);
        	$list=Db::name('withdrawals')
                	//->field('w.id,w.applysn,w.uid,w.type,w.money,w.money_pay,,m.username')
                	->field('w.*,m.username')
                	->alias('w')
                	->join('__MEMBER__ m','m.id = w.uid','LEFT')
                	->order('w.id', 'desc')
                	->where($getwhere['where'])
                	->select();
            $headTitle = "提现申请导出"; 
            $title = "提现申请导出".date("Y-m-d H:i:s",time()) ; 
            $headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>"; 
            $titlename = "<tr> 
                           <th style='width:70px;' >ID</th> 
                           <th style='width:150px;' >提现串号</th>
                           <th style='width:70px;'>申请人ID</th>
                           <th style='width:70px;'>提现类型</th>  
                           <th style='width:70px;'>申请金额</th> 
                           <th style='width:70px;'>到款金额</th> 
                           <th style='width:150px;'>申请时间</th>
                           <th style='width:150px;'>审核时间</th>
                           <th style='width:150px;'>状态</th> 
                           <th style='width:70px;'>申请人</th> 
                           <th style='width:70px;'>支付宝或银行账号</th> 
                       </tr>"; 
            $filename = $title.".xls"; 
            $statusstr = array('-1'=>'驳回','0'=>'未知','1'=>'正在申请','2'=>'审核通过');
            $type = array('0'=>'余额','1'=>'微信','2'=>'支付宝','3'=>'银行卡');
            foreach ($list as $s=>$v){
	            $list[$s]['zhanghao'] = $v['alipay'].$v['realname'].'#'.$v['bankname'].'#'.$v['bankcard'];
	            unset($list[$s]['content'],$list[$s]['alipay'],$list[$s]['realname'],$list[$s]['bankname'],$list[$s]['bankcard'],$list[$s]['charge']);

                $list[$s]['applytime'] = date("Y-m-d H:i:s",$v['applytime']);
                $list[$s]['status'] = $statusstr[$v['status']];
                $list[$s]['type'] = $type[$v['type']];
                if(!empty($list[$s]['handletime'])){
	                $list[$s]['handletime'] = date("Y-m-d H:i:s",$v['handletime']);
                }
            }
        }
        excelData($list,$titlename,$headtitle,$filename); 
    }

}