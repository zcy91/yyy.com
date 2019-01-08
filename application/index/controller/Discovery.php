<?php
namespace app\index\controller;
use think\AjaxPage;
use think\Controller;
use think\Session;
use think\Url;
use think\Config;
use think\Page;
use think\Verify;
use think\Image;
use think\Db;
use think\Request;
class Discovery extends Base 
{
    public function index(){
        $list = db('ad')->where('stime','<', time())->where('etime','>', time())->where(array('type'=>2,'status'=>1))->order('id','desc')->select();
        
        $this->assign('list', $list);
        $this->assign('webtitle', '了解我们');
        return $this->fetch();
    }
    public function sheepvideo(){
        $video_type = db('video_type')->where(array('id'=>['>',1]))->select();
        $video_list = db('lamb_video')->where(array('status'=>1))->order(array('sort'=>'desc','id'=>'desc'))->select();
        $this->assign('video_type', $video_type);
        $this->assign('video_list', $video_list);
        $this->assign('webtitle', '牧场视频');
        return $this->fetch();
    }
    public function questions(){
        //分类5是常见问题
        $list = db('article')->where(array('catid'=>5,'status'=>1))->order(array('sort'=>'desc','id'=>'desc'))->select();
        $this->assign('list', $list);
        $this->assign('webtitle', '常见问题');
        return $this->fetch();
    }
    public function content(){
        //通过文章id获取文章
        $id= input('id');
        $myarticle = db('article')->where(array('id'=>$id,'status'=>1))->find();
        $userId = $myarticle['userid'];
        $list = db('comment') -> where(array('aid'=>$id,'status'=>1))-> select();
        if(!empty($myarticle)){
            $myarticle['img'] = unserialize($myarticle['img']); // 晒单图片

            if( $myarticle['img']){
                foreach ( $myarticle['img'] as $k=>$v){
                    $myarticle['size'][$k] = getimagesize('http://'.$_SERVER['HTTP_HOST'].$v);
                }
            }
            $this->assign('myarticle', $myarticle);
        }else{
            exit();
        }
        $isdelarticle = 0;
        if(!empty(Session::get('user.user_id'))){
            $userid = Session::get('user.user_id');
            if($userid == $userId){
                $isdelarticle = 1;
            }
            $iszan = db('comment') -> where('userid',$userid)->where('aid',$id)->where("comment is null")->value('iszan');
        }elseif(@$_COOKIE['mobile']){
            $mobile = $_COOKIE['mobile'];
            $userid = db('member') -> where('mobile',$mobile) -> value('id');
            if($userid == $userId){
                $isdelarticle = 1;
            }
            $iszan = db('comment') -> where('userid',$userid)->where('aid',$id)->where("comment is null")->value('iszan');
        }else{
            $iszan = 0;
        }
        //dump($iszan);die;
        $count = count(db('comment')->where(array('aid'=>$id,'status'=>1))->select());
        $page_count = 8;
        $page = new AjaxPage($count, $page_count);
        $list = db('comment')->where(array('aid'=>$id,'status'=>1,'mid'=>0))->order(array('id'=>'desc'))->limit($page->firstRow . ',' . $page->listRows) ->select();
       // dump($list);die;
        if(empty(input('get.p'))){
            $p = 0;
        }else{
            $p = input('get.p');
        }
        foreach ($list as $s=>$v){
            $list[$s]['timestr'] = time_tran($v['time']);
            $list[$s]['comment'] = strip_tags($v['comment']);
            $list[$s]['comment'] =  filterComment($list[$s]['comment']);
            $list[$s]['comment_count'] = count(db('comment') -> where(array('mid'=>$v['id'],'status'=>1))->select());
        }
        db('article') -> where('id',$id)->setInc('hits'); //增加阅读
        //dump($list);die;
        $this -> assign('isdelarticle',$isdelarticle);
        $this -> assign('list',$list);
        $this -> assign('iszan',$iszan);
        $this->assign('webtitle', $myarticle['title']);
        $this->assign('count', $count);//总条数
        $this->assign('page_count', $page_count);//页数
        $this->assign('current_count', $page_count * input('get.p'));//当前条
        $this->assign('p', $p);//页数
        $this->assign('commentlist', $list);
        return $this->fetch();
    }
    public function pasture(){
        //分类2是牧场介绍
        $list = db('article')->where(array('catid'=>2,'status'=>1))->order(array('sort'=>'desc','id'=>'desc'))->select();
        //print_r($list);
        $this->assign('list', $list);
        $this->assign('webtitle', '牧场视频');
        return $this->fetch();
    }
    public function notice(){
        //搜索最近发布的一期羊圈
        $fabu = db('goods')->where(array('shelftime'=>['<=',time()],'stock'=>['>',0],'status'=>1))->order(array('sort'=>'desc','shelftime'=>'desc'))->find();
        $isorder = db('order')
                ->field('o.*,m.username,m.realname,m.mobile,g.gname')
                ->alias('o')
                ->join('__MEMBER__ m','o.uid=m.id','LEFT')
                ->join('__ORDER_GOODS__ og','o.id=og.oid','LEFT')
                ->join('__GOODS__ g','og.gid=g.id','LEFT')
                ->where(array('o.status'=>1))
                ->group('o.uid')
                ->order('o.creationtime','desc')
                ->limit(10)
                ->select();
        //获取公告信息
        $notice = db('article')->where(array('catid'=>3))->order(array('sort'=>'desc','id'=>'desc','status'=>1))->limit(10)->select();
        $this->assign("fabu", $fabu);
        $this->assign("isorder", $isorder);
        $this->assign("notice", $notice);
        $this->assign('webtitle', '公告');
        return $this->fetch();
    }
    //community社区
    public function community(){
        $count = count(db('article')->where(array('catid'=>7,'status'=>1))->order(array('sort'=>'desc','id'=>'desc'))->select());
        $page_count = 8;
        $page = new AjaxPage($count, $page_count);
        $list = db('article')->where(array('catid'=>7,'status'=>1))->order(array('sort'=>'desc','id'=>'desc'))->limit($page->firstRow . ',' . $page->listRows) ->select();
        foreach ($list as $s=>$v){
            $list[$s]['timestr'] = time_tran($v['createtime']);
            $list[$s]['content'] = strip_tags($v['content']);
            $list[$s]['content'] = filterComment($list[$s]['content']);
            $list[$s]['img'] = unserialize($v['img']); // 晒单图片
            $image = unserialize($v['img']);
            if($image){
                foreach ($image as $k=>$v){
                    $list[$s]['size'][$k] = getimagesize('http://'.$_SERVER['HTTP_HOST'].$v);
                }
            }

        }
        //var_dump($list);die;
        if(empty(input('get.p'))){
            $p = 0;
        }else{
            $p = input('get.p');
        }
        $this->assign('list', $list);
        $this->assign('commentlist', $list);
        $this->assign('webtitle', '牧羊人社区');
        $this->assign('count', $count);//总条数
        $this->assign('page_count', $page_count);//页数
        $this->assign('current_count', $page_count * input('get.p'));//当前条
        $this->assign('p', $p);//页数
        return $this->fetch();
    }
    public function photograph(){
        $count = count(db('article')->where(array('catid'=>8,'status'=>1))->order(array('sort'=>'desc','id'=>'desc'))->select());
        $page_count = 8;
        $page = new AjaxPage($count, $page_count);
        $list = db('article')->where(array('catid'=>8,'status'=>1))->order(array('sort'=>'desc','id'=>'desc'))->limit($page->firstRow . ',' . $page->listRows) ->select();
        foreach ($list as $s=>$v){
            $list[$s]['timestr'] = time_tran($v['createtime']);
            $list[$s]['content'] = strip_tags($v['content']);
            $list[$s]['content'] = filterComment($list[$s]['content']);
            $list[$s]['img'] = unserialize($v['img']); // 晒单图片
            $image = unserialize($v['img']);
            if($image){
                foreach ($image as $k=>$v){
                    $list[$s]['size'][$k] = getimagesize('http://'.$_SERVER['HTTP_HOST'].$v);
                }
            }

        }
        //var_dump($list);die;
        if(empty(input('get.p'))){
            $p = 0;
        }else{
            $p = input('get.p');
        }
        $this->assign('list', $list);
        $this->assign('commentlist', $list);
        $this->assign('webtitle', '摄影大赛');
        $this->assign('count', $count);//总条数
        $this->assign('page_count', $page_count);//页数
        $this->assign('current_count', $page_count * input('get.p'));//当前条
        $this->assign('p', $p);//页数
        return $this->fetch();
    }
    public function ajaxcommunity(){
        $count = count(db('article')->where(array('catid'=>7,'status'=>1))->order(array('sort'=>'desc','id'=>'desc'))->select());
        $page_count = 8;
        $page = new AjaxPage($count, $page_count);
        $list = db('article')->where(array('catid'=>7,'status'=>1))->order(array('sort'=>'desc','id'=>'desc'))->limit($page->firstRow . ',' . $page->listRows) ->select();
        foreach ($list as $s=>$v){
            $list[$s]['timestr'] = time_tran($v['createtime']);
            $list[$s]['content'] = strip_tags($v['content']);
            $list[$s]['content'] = filterComment($list[$s]['content']);
            $list[$s]['img'] = unserialize($v['img']); // 晒单图片
            $image = unserialize($v['img']);
            if($image){
                foreach ($image as $k=>$v){
                    $list[$s]['size'][$k] = getimagesize('http://'.$_SERVER['HTTP_HOST'].$v);
                }
            }
        }
        if(empty(input('get.p'))){
            $p = 0;
        }else{
            $p = input('get.p');
        }
        $this->assign('list', $list);
        $this->assign('commentlist', $list);
        $this->assign('count', $count);//总条数
        $this->assign('page_count', $page_count);//页数
        $this->assign('current_count', $page_count * input('get.p'));//当前条
        $this->assign('p', $p);//页数
        return $this->fetch();
    }
    public function ajaxphotograph(){
        $count = count(db('article')->where(array('catid'=>8,'status'=>1))->order(array('sort'=>'desc','id'=>'desc'))->select());
        $page_count = 8;
        $page = new AjaxPage($count, $page_count);
        $list = db('article')->where(array('catid'=>8,'status'=>1))->order(array('sort'=>'desc','id'=>'desc'))->limit($page->firstRow . ',' . $page->listRows) ->select();
        foreach ($list as $s=>$v){
            $list[$s]['timestr'] = time_tran($v['createtime']);
            $list[$s]['content'] = strip_tags($v['content']);
            $list[$s]['content'] = filterComment($list[$s]['content']);
            $list[$s]['img'] = unserialize($v['img']); // 晒单图片
        }
        if(empty(input('get.p'))){
            $p = 0;
        }else{
            $p = input('get.p');
        }
        $this->assign('list', $list);
        $this->assign('commentlist', $list);
        $this->assign('count', $count);//总条数
        $this->assign('page_count', $page_count);//页数
        $this->assign('current_count', $page_count * input('get.p'));//当前条
        $this->assign('p', $p);//页数
        return $this->fetch();
    }
    //判断评论时是否登录
    public function iscomment_login(){
        if(Request::instance()->isPost()){
            if(!(Session::get('user')['user_id'] ||@$_COOKIE['mobile'])){
                return array('status'=>0,'msg'=>'请先登录');
            }else{
                return array('status'=>1, 'msg' => '已登录');
            }
        }
    }
    //社区评论/点赞
    public function comment()
    {
        if (Request::instance()->isPost()) {
            $data = Request::instance()->post();
            $data['aid'] = input('aid');
            if (!(Session::get('user')['user_id'] || @$_COOKIE['mobile'])) {
                return array('status' => 0, 'msg' => '请先登录');
            } elseif (Session::get('user')['user_id']) {
                $userid = Session::get('user')['user_id'];
            } else {
                $userid = Db::name('member')->where('mobile', $_COOKIE['mobile'])->value('id');
            }
//            $time = Db::name('comment')->where('userid', $userid)->where('aid', $data['aid'])->value('time');
//            if ($time && ((time() - $time) < 60 * 3)) {
//                return array('status' => 0, 'msg' => '评论太频繁');
//            }
            $mid = input('mid');
            $data['status'] = 1;
            $data['userid'] = $userid;
            $data['mid'] = input('mid') ? input('mid') : 0;
            $userinfo = db('member')->where('id', $userid)->field('avatar,username')->find();
            $data['username'] = $userinfo['username'];
            $data['useravatar'] = $userinfo['avatar'];
            $data['time'] = time();
            $data['ip'] = get_real_ip();
            $comment = input('post.comment','','htmlspecialchars');
//            $data['comment'] = filterComment($comment);
            if(empty($data['comment'])){
                return array('status' => 0, 'msg' => '请填写评论内容');
            }
            $result = Db::name('comment')->insert($data);
            $cid = input('cid');
            if(($cid==1)){
                $res = Db::name('article')->where('id', $data['aid'])->setInc('comment');
            }

            if ($result) {
                return array('status' => 2, 'msg' => '评论成功');
            } else {
                return array('status' => 0, 'msg' => '评论失败');
            }
        }
        if (Request::instance()->isGet()) {
            $data = Request::instance()->get();
            $data['aid'] = input('aid');
            $data['mid'] = input('mid') ? input('mid') : 0;
            if (!(Session::get('user')['user_id'] || @$_COOKIE['mobile'])) {
                return array('status' => 0, 'msg' => '请先登录');
            } elseif (Session::get('user')['user_id']) {
                $userid = Session::get('user')['user_id'];
            } else {
                $userid = Db::name('member')->where('mobile', $_COOKIE['mobile'])->value('id');
            }
            $data['userid'] = $userid;
            $iszan = Db::name('comment')->where('userid', $userid)->where('aid', $data['aid'])->where('comment is null')->where("mid",$data['mid'])->value('iszan');
            if ($iszan) {
                return array('status' => 0, 'msg' => '您已经点赞过了');
            }
            $data['mid'] = input('mid') ? input('mid') : 0;
            $userinfo = db('member')->where('id', $userid)->field('avatar,username')->find();
            $data['username'] = $userinfo['username'];
            $data['useravatar'] = $userinfo['avatar'];
            $data['time'] = time();
            $data['ip'] = get_real_ip();
            $data['iszan'] = 1;
            $result = Db::name('comment')->insert($data);
            $res = Db::name('article')->where('id', $data['aid'])->setInc('zan');
            if ($result && $res) {
                return array('status' => 1, 'msg' => "点赞成功");
            } else {
                return array('status' => 0, 'msg' => '点赞失败');
            }
        }
    }

        public function dianzan(){
            if (Request::instance()->isGet()) {
                $data = Request::instance()->get();
                $data['aid'] = input('aid');
                if (!(Session::get('user')['user_id'] || @$_COOKIE['mobile'])) {
                    return array('status' => 0, 'msg' => '请先登录');
                } elseif (Session::get('user')['user_id']) {
                    $userid = Session::get('user')['user_id'];
                } else {
                    $userid = Db::name('member')->where('mobile', $_COOKIE['mobile'])->value('id');
                }
                $data['userid'] = $userid;
                $iszan = Db::name('comment')->where('userid', $userid)->where('aid', $data['aid'])->value('iszan');
                if ($iszan) {
                    return array('status' => 0, 'msg' => '您已经点赞过了');
                }
                $data['mid'] = input('mid') ? input('mid') : 0;
                $userinfo = db('member')->where('id', $userid)->field('avatar,username')->find();
                $data['username'] = $userinfo['username'];
                $data['useravatar'] = $userinfo['avatar'];
                $data['time'] = time();
                $data['ip'] = get_real_ip();
                $data['iszan'] = 1;
                $result = Db::name('comment')->insert($data);
                $res = Db::name('article')->where('id', $data['aid'])->setInc('zan');
                if ($result && $res) {
                    return array('status' => 1, 'msg' => "点赞成功");
                } else {
                    return array('status' => 0, 'msg' => '点赞失败');
                }
            }
        }
        public function comment_list(){
            $id= input('id');
            $myarticle = db('comment')->where(array('id'=>$id,'status'=>1))->find();
            $aid = $myarticle['aid'];
            if(!empty($myarticle)){
                $myarticle['comment'] = filterComment( $myarticle['comment']);
                $this->assign('myarticle', $myarticle);
            }else{
                exit();
            }

            if(!empty(Session::get('user.user_id'))){
                $userid = Session::get('user.user_id');
                $iszan = db('comment') -> where('userid',$userid)->where('mid',$id)->where("comment is null")->value('iszan');
            }elseif(@$_COOKIE['mobile']){
                $mobile = $_COOKIE['mobile'];
                $userid = db('member') -> where('mobile',$mobile) -> value('id');
                $iszan = db('comment') -> where('userid',$userid)->where('mid',$id)->where("comment is null")->value('iszan');
            }else{
                $iszan = 0;
            }
            $list = db('comment')->where(array('status'=>1,'mid'=>$id))->order(array('id'=>'desc')) ->select();
            // dump($list);die;
            foreach ($list as $s=>$v){
                $list[$s]['timestr'] = time_tran($v['time']);
                $list[$s]['comment'] = strip_tags($v['comment']);
                $list[$s]['comment'] = filterComment($list[$s]['comment']);
                $list[$s]['comment_count'] = count(db('comment') -> where(array('mid'=>$v['id'],'status'=>1))->select());
                $list[$s]['zan'] = count(db('comment') -> where(array('mid'=>$v['id']))->where("comment is null")->select());
            }

            $this -> assign('aid',$aid);
            $this -> assign('list',$list);
            $this -> assign('iszan',$iszan);
            $this->assign('commentlist', $list);
            return $this->fetch();
        }

        public function comment_love(){
            if (Request::instance()->isGet()) {
                $data = Request::instance()->get();
                $data['aid'] = input('aid');
                if (!(Session::get('user')['user_id'] || @$_COOKIE['mobile'])) {
                    return array('status' => 0, 'msg' => '请先登录');
                } elseif (Session::get('user')['user_id']) {
                    $userid = Session::get('user')['user_id'];
                } else {
                    $userid = Db::name('member')->where('mobile', $_COOKIE['mobile'])->value('id');
                }
                $data['userid'] = $userid;
                $data['mid'] = input('mid');
                $iszan = Db::name('comment')->where('userid', $userid)->where('mid', $data['mid'])->where('comment',Null)->value('iszan');
                if ($iszan) {
                    return array('status' => 0, 'msg' => '您已经点赞过了');
                }

                $userinfo = db('member')->where('id', $userid)->field('avatar,username')->find();
                $data['username'] = $userinfo['username'];
                $data['useravatar'] = $userinfo['avatar'];
                $data['time'] = time();
                $data['ip'] = get_real_ip();
                $data['iszan'] = 1;
                $result = Db::name('comment')->insert($data);
                $res = Db::name('comment')->where('id', $data['mid'])->setInc('zan');
                if ($result && $res) {
                    return array('status' => 1, 'msg' => "点赞成功");
                } else {
                    return array('status' => 0, 'msg' => '点赞失败');
                }
            }
        }

        public function del_comment(){
            if (Request::instance()->isPost()) {
                $id = Request::instance()->post();
                $aid = Request::instance()->get();
                $res = db('comment') -> where('id',$id['id']) -> delete();
                if($res){
                    db('comment') -> where('mid',$id['id']) -> delete();
                    if(!empty($aid['aid'])){
                        db('article') -> where('id',$aid['aid']) -> setDec('comment');
                    }
                    return array('status'=> 1 , 'msg'=> '删除成功');
                }else{
                    return array('status'=> 0 , 'msg'=> '删除失败');
                }
            }

        }

        public function del_article(){
            if (Request::instance()->isPost()) {
                $id = Request::instance()->post();
                $res = db('article') -> where('id',$id['id']) -> delete();
                if($res){
                    db('comment') -> where('aid',$id['id']) -> delete();
                    return array('status'=> 1 , 'msg'=> '删除成功');
                }else{
                    return array('status'=> 0 , 'msg'=> '删除失败');
                }
            }
        }
}