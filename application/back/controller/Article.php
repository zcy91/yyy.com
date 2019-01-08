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
class Article extends Base {
    public function index(){
        return $this->fetch();
    }
    public function articlelist(){
        $get = Request::instance()->param();
        $mohu = ['id','userid','username','title'];
        $timename = 'createtime';
        $getwhere = getwhere('',$get,$mohu,$timename);
        $list=Db::name('article')->where($getwhere['where'])->order('id', 'desc')->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function articleadd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                $data['createtime'] = time();
                $files = request()->file('comment_img_file');
                $save_url = 'public/upload/comment/' . date('Y', time()) . '/' . date('m-d', time());
                foreach ($files as $file) {
                    // 移动到框架应用根目录/public/uploads/ 目录下
                    $info = $file->rule('uniqid')->validate(['size' => 1024 * 1024 * 2, 'ext' => 'jpg,png,gif,jpeg'])->move($save_url);

                    if ($info) {
                        // 成功上传后 获取上传信息
                        // 输出 jpg
                        $comment_img[] = '/'.$save_url . '/' . $info->getFilename();
                    } else {
                        // 上传失败获取错误信息
                        $this->error($file->getError());
                    }
                }
                if (!empty($comment_img)) {
                    $data['img'] = serialize($comment_img);
                }
                db('article')->insert($data);
                $this -> success('添加成功');
//                return array('type'=>1,'msg'=>'添加成功');
            }else{
                $data = input('post.');
                $files = request()->file('comment_img_file');

                $save_url = 'public/upload/comment/' . date('Y', time()) . '/' . date('m-d', time());
                foreach ($files as $file) {
                    // 移动到框架应用根目录/public/uploads/ 目录下
                    $info = $file->rule('uniqid')->validate(['size' => 1024 * 1024 * 2, 'ext' => 'jpg,png,gif,jpeg'])->move($save_url);

                    if ($info) {
                        // 成功上传后 获取上传信息
                        // 输出 jpg
                        $comment_img[] = '/'.$save_url . '/' . $info->getFilename();
                    } else {
                        // 上传失败获取错误信息
                        $this->error($file->getError());
                    }
                }
                if (!empty($comment_img)) {
                    $data['img'] = serialize($comment_img);
                }
                db('article')->where('id', $id)->update($data);
                $this -> success('修改成功');
               // return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $myarticle = Db::name('article')->where("id=$id")->find();
                $myarticle['img'] = unserialize($myarticle['img']); // 晒单图片
                $this->assign('myarticle', $myarticle);
            }
        }
        //dump($myarticle);die;
        $article_type = Db::name('article_type')->where("id>0")->select();
        $this->assign('article_type', $article_type);
        return $this->fetch();
    }
    public function commentlist(){
        $get = Request::instance()->param();
        $mohu = ['id','aid','userid','username'];
        $timename = 'time';
        $getwhere = getwhere('',$get,$mohu,$timename);
        $list=Db::name('comment')->where($getwhere['where'])->where('comment is not null')->order('id', 'desc')->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function commentadd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                $data['time'] = time();
                db('comment')->insert($data);
                return array('type'=>1,'msg'=>'添加成功');
            }else{
                $data = input('post.');
                db('comment')->where('id', $id)->update($data);
                return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            $aid= input('get.aid');
            if(!empty($id)){
                $mycomment = Db::name('comment')->where("id=$id")->find();
                $this->assign('mycomment', $mycomment);
            }
            if(!empty($aid)){
                $this->assign('aid', $aid);
            }
        }
        return $this->fetch();
    }
    public function commentdel(){
        if(Request::instance()->isPost()){
            $id = input('get.id');
            if($id>0){
                Db::name('comment')->where('id',$id)->delete();
                echo $id;
            }else{
                echo '0';
            }
        }
    }
    public function articledel(){
        if(Request::instance()->isPost()){
            $id = input('get.id');
            if($id>0){
                Db::name('article')->where('id',$id)->delete();
                echo $id;
            }else{
                echo '0';
            }
            
        }
    }
    public function adlist(){
        $get = Request::instance()->param();
        $mohu = ['id','title'];
        $timename = 'stime';
        $getwhere = getwhere('',$get,$mohu,$timename);
        $list=Db::name('ad')->where($getwhere['where'])->order('id', 'desc')->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function adadd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                $data['stime'] = strtotime(input('post.stime'));
                $data['etime'] = strtotime(input('post.etime'));
                db('ad')->insert($data);
                return array('type'=>1,'msg'=>'添加成功');
            }else{
                $data = input('post.');
                $data['stime'] = strtotime(input('post.stime'));
                $data['etime'] = strtotime(input('post.etime'));
                db('ad')->where('id', $id)->update($data);
                return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $myad = Db::name('ad')->where("id=$id")->find();
                if(empty($myad['stime'])){
                    $myad['stime'] = date("Y-m-d",time());
                    $myad['etime'] = date("Y-m-d",time() + 2678400);
                }else{
                    $myad['stime'] = date("Y-m-d",$myad['stime']);
                    $myad['etime'] = date("Y-m-d",$myad['etime']);
                }
                $this->assign('myad', $myad);
            } else {
                $myad['stime'] = date("Y-m-d",time());
                $myad['etime'] = date("Y-m-d",time() + 2678400);
                $this->assign('myad', $myad);
            }
        }
        return $this->fetch();
    }
    public function addel(){
        if(Request::instance()->isPost()){
            $id = input('get.id');
            if($id>0){
                Db::name('ad')->where('id',$id)->delete();
                echo $id;
            }else{
                echo '0';
            }
        }
    }
    public function articletype(){
        $articletypelist=Db::name('article_type')->where("id>0")->order('id', 'desc')->select();
        $this->assign('articletypelist', $articletypelist);
        return $this->fetch();
    }
    public function articletypeadd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $name = input('post.name');
                $isuser=Db::name('article_type')->where(array('name'=>$name))->find();
                if(empty($isuser)){
                    $data = input('post.');
                    db('article_type')->insert($data);
                    echo '<script>alert("添加成功");</script>';
                } else {
                    echo '<script>alert("等级已存在添加失败");</script>';
                }
            }else{
                $data = input('post.');
                db('article_type')->where('id', $id)->update($data);
                echo '<script>alert("修改成功");</script>';
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id) && $id>0){
                $myarticle_type = Db::name('article_type')->where("id=$id")->find();
                $this->assign('myarticle_type', $myarticle_type);
            }
        }
        return $this->fetch();
    }
    public function tourtype(){
        $articletypelist=Db::name('tour_type')->where("id>0")->order('id', 'desc')->select();
        $this->assign('articletypelist', $articletypelist);
        return $this->fetch();
    }
    public function tourtypeadd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $name = input('post.name');
                $isuser=Db::name('tour_type')->where(array('name'=>$name))->find();
                if(empty($isuser)){
                    $data = input('post.');
                    db('tour_type')->insert($data);
                    echo '<script>alert("添加成功");</script>';
                } else {
                    echo '<script>alert("名称已存在添加失败");</script>';
                }
            }else{
                $data = input('post.');
                db('article_type')->where('id', $id)->update($data);
                echo '<script>alert("修改成功");</script>';
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id) && $id>0){
                $myarticle_type = Db::name('tour_type')->where("id=$id")->find();
                $this->assign('myarticle_type', $myarticle_type);
            }
        }
        return $this->fetch();
    }
    public function tourlist(){
        $get = Request::instance()->param();
        $mohu = ['id','userid','username','title'];
        $timename = 'createtime';
        $getwhere = getwhere('',$get,$mohu,$timename);
        $list=Db::name('tour')->where($getwhere['where'])->order('id', 'desc')->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function touradd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                $data['createtime'] = time();
                $price_ladder = array();
                if ($data['ladder_num'][0] > -1 && $data['ladder_num'][0] < 3) {
                    foreach ($data['ladder_num'] as $key => $value) {
                        $price_ladder[$key]['num'] = ($data['ladder_num'][$key]);
                        $price_ladder[$key]['arrive'] = ($data['ladder_arrive'][$key]);
                        $price_ladder[$key]['play'] = ($data['ladder_play'][$key]);
                        $price_ladder[$key]['back'] = ($data['ladder_back'][$key]);
                        $price_ladder[$key]['people'] = ($data['ladder_people'][$key]);
                    }


                    $data['price_ladder'] = serialize($price_ladder);
                } else {
                    $this -> error('限带儿童人数最多2人');
                }
                db('tour')->insert($data);
                $this -> success('添加成功');
//                return array('type'=>1,'msg'=>'添加成功');
            }else{
                $data = input('post.');
                $price_ladder = array();
                if ($data['ladder_num'][0] > -1 && $data['ladder_num'][0] < 3) {
                    foreach ($data['ladder_num'] as $key => $value) {
                        $price_ladder[$key]['num'] = ($data['ladder_num'][$key]);
                        $price_ladder[$key]['arrive'] = ($data['ladder_arrive'][$key]);
                        $price_ladder[$key]['play'] = ($data['ladder_play'][$key]);
                        $price_ladder[$key]['back'] = ($data['ladder_back'][$key]);
                        $price_ladder[$key]['people'] = ($data['ladder_people'][$key]);
                    }

                }else{
                    $this -> error('限带儿童人数最多2人');
                }
                    $data['price_ladder'] = serialize($price_ladder);
                //var_dump($data);die;
               $res = db('tour')->where('id', $id)->update($data);
               if($res)
                $this -> success('修改成功');
               else
                   $this -> error('修改失败');
                // return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id)){
                $myarticle = Db::name('tour')->where("id=$id")->find();
                if ($myarticle['price_ladder']) {
                    $myarticle['price_ladder'] = unserialize($myarticle['price_ladder']);
                }
//                $tour = db('tour') -> where('catid',9) -> value('price_ladder');
//                $tour = unserialize($tour);
//                foreach($tour as $k=>$v){
//                    if($v['num'] == 2){
//                        $m[$k] = $v['people'];
//                        $key = $k;
//                    }
//                }
//                $people = $tour[$key]['people']-1;
//                $tour[$key]['people'] = $tour[$key]['people']-1;
//                var_dump($tour);die;
                $myarticle['img'] = unserialize($myarticle['img']); // 晒单图片
                $this->assign('myarticle', $myarticle);
            }
        }
        //dump($myarticle);die;
        $article_type = Db::name('tour_type')->where("id>0")->select();
        $this->assign('article_type', $article_type);
        return $this->fetch();
    }

    public function tourdel(){
        if(Request::instance()->isPost()){
            $id = input('get.id');
            if($id>0){
                Db::name('tour')->where('id',$id)->delete();
                echo $id;
            }else{
                echo '0';
            }

        }
    }

    public function lvkelist(){
        if(Request::instance()->isGet()){
            $id = $_GET['id'];
            $tour = db("tour") -> where('id',$id)->find();
            $myarticle = unserialize($tour['price_ladder']);
            $this->assign('list', $myarticle);
            $this -> assign('tourtype',$tour['catid']);
            return $this->fetch();
        }
    }

    public function lvkelist1(){
        $get = Request::instance()->param();
        $mohu = ['id','uid'];
        $timename = 'creationtime';
        $num = $_GET['id'];
        $tourtype = $_GET['tourtype'];
        $getwhere = getwhere('',$get,$mohu,$timename);
        $list=Db::name('sell_lamb')->where($getwhere['where'])->where('tourlist',$num) -> where('tourtype',$tourtype) -> where('status IN (2,-2,-3)')->where('isdelete','<>',1)->order('id', 'desc')->paginate(20,false,$getwhere['query']);

        $this->assign('list', $list);
        $this->assign('id',$num);
        $this->assign('tourtype',$tourtype);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
//        if(Request::instance()->isGet()){
//            $num = $_GET['id'];
//            $tourtype = $_GET['tourtype'];
//            $data = db('sell_lamb')->where('tourlist',$num) -> where('tourtype',$tourtype) -> where('status',2) -> select();
//            $this->assign('list', $data);
//            return $this->fetch();
//        }
    }

    public function safe(){
        $id = $_GET['id'];
        $safe = db('sell_lamb') -> where('id',$id) -> value('safe');
        if($safe != 1){
            $res = db('sell_lamb') -> where('id',$id)->update(array('safe'=>1));
            $result = 1 ;
        }
        else{
            $res = db('sell_lamb') -> where('id',$id)->update(array('safe'=>0));
            $result = 2;
        }
        if(!empty($res)){
            return $result;
        }else{
            return 0;
        }
    }
    public function safes(){
        $fid = trim($_POST['name']);
        //以下为查询条件
        $bname['safe'] = 1;
        $res = db('sell_lamb')
            ->where(array('id'=>array('in',$fid)))
            ->update($bname);
        if(!empty($res)){
            return array('code'=>1);
        }else{
            return array('code'=>0);
        }

    }

    public function lvke(){
        if(Request::instance()->isGet()){
            $id = $_GET['id'];
            $lvke = db("sell_lamb") -> where('id',$id)->find();
            $this->assign('list', $lvke);
            $this -> assign('id',$id);
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data = $_POST;
            $res = db('sell_lamb')->where('id', $data['id'])->update($data);
            if($res)
                $this -> success('修改成功');
            else
                $this -> error('修改失败');
        }
    }

    public function lvkedel(){
        if(Request::instance()->isPost()){
            $id = $_GET['id'];
            $lvke = db("sell_lamb") -> where('id',$id)->find();
            $uid = $lvke['uid'];
            $tourtype = $lvke['tourtype'];
            $tourlist = $lvke['tourlist'];
            $lambid = $lvke['lambid'];
            if(!empty($tourtype)){
                $tour = db('tour') -> where('catid',$tourtype) -> value('price_ladder');
                $tour = unserialize($tour);
                foreach($tour as $k=>$v){
                    if($v['num'] == $tourlist){
                        $key = $k;
                        $people = $v['people'];
                        $arrive = $v['arrive'];
                    }
                }
                if(( strtotime($arrive) - time()) < 3*24*3600){
                    return array('type'=> 0 ,'msg'=>'因与抵达时间小于3天，不能取消');
                }
                if($people>0){
                    $people = $people + 1;
                    $tour[$key]['people'] = $people;
                    $tour = serialize($tour);
                    $res = db('tour') -> where('catid',$tourtype) -> update(array('price_ladder'=>$tour));
                    $result = db('lamb') -> where('id',$lambid) -> update(array('status'=>1));
                    $result1 = db('sell_lamb') -> where('id',$id) -> update(array('isdelete'=>1));
                    if(($res && $result && $result1)){
                        return array('type' => 1,'msg'=>'删除成功，羊只重新归还');
                    }else{
                        return array('type' => 0,'msg'=>'删除失败，请联系网站管理员');
                    }
                }else{
                    return array('type'=>0,'msg'=>'上限人数已满');
                }
            }
            $this->assign('list', $lvke);
            $this -> assign('id',$id);
            return $this->fetch();
        }
    }


}