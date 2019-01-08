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
class Admin extends Base {
    public function index(){
        $admininfo = $this->admininfo;
        $this->assign('admininfo', $admininfo);
        return $this->fetch();
    }
    public function upadmin(){
        if(Request::instance()->isPost()){
            $data = input('post.');
            $isadmin = db('admin')->where('admin_id', $this->admininfo['admin_id'])->update($data);
            if(!empty($isadmin)){
                return array('type'=>1,'msg'=>'修改成功！');
            }else{
                return array('type'=>0,'msg'=>'修改失败！');
            }
        }else{
            return array('type'=>0,'msg'=>'请求失败！');
        }
    }
    public function changepwd(){
        $admininfo = $this->admininfo;
        $this->assign('admininfo', $admininfo);
        if(Request::instance()->isPost()){
            $oldpwd = input('post.oldpwd');
            $newpwd = input('post.newpwd');
            $isadmin = db('admin')->where('admin_id', $this->admininfo['admin_id'])->find();
            if(md5($oldpwd)!=$isadmin['pwd']){
                return array('type'=>0,'msg'=>'旧密码输入不正确！');
            }
            $ispwd = db('admin')->where('admin_id', $this->admininfo['admin_id'])->update(array('pwd'=> md5($newpwd)));
            if(!empty($isadmin)){
                return array('type'=>1,'msg'=>'修改成功！');
            }else{
                return array('type'=>0,'msg'=>'修改失败！');
            }
        }
        return $this->fetch();
    }
    public function adminlist(){
        $get = Request::instance()->param();
        $mohu = ['admin_id','username','tel'];
        $timename = 'add_time';
        $getwhere = getwhere('a.',$get,$mohu,$timename);
        $list=Db::name('admin')
                ->field('a.*,al.name levelname')
                ->alias('a')
                ->join('__ADMIN_LEVEL__ al','a.level_id = al.id','LEFT')
                ->order('a.admin_id', 'desc')
                ->where($getwhere['where'])
                ->paginate(20,false,$getwhere['query']);
        $this->assign('list', $list);
        $this->assign('query', $getwhere['query']);
        return $this->fetch();
    }
    public function adminadd(){
        if(Request::instance()->isPost()){
            $admin_id= input('post.admin_id');
            if(empty($admin_id)){
                $username = input('post.username');
                $isadmin = Db::name('admin')->where(array("username"=>$username))->find();
                if(empty($isadmin)){
                    $data = input('post.');
                    $data['pwd'] = md5($data['pwd']);
                    $data['add_time'] = time();
                    db('admin')->insert($data);
                    return array('type'=>1,'msg'=>'添加成功!');
                } else {
                    return array('type'=>0,'msg'=>'用户名已存在，添加失败!');
                }
            }else{
                $data = input('post.');
                if(!empty($data['pwd'])){
                    $data['pwd'] = md5($data['pwd']);
                } else {
                    unset($data['pwd']);
                }
                db('admin')->where('admin_id', $admin_id)->update($data);
                return array('type'=>1,'msg'=>'修改成功!');
            }
        }
        if(Request::instance()->isGet()){
            $admin_id= input('get.admin_id');
            if(!empty($admin_id)){
                $myadmin = Db::name('admin')->where("admin_id=$admin_id")->find();
                $this->assign('myadmin', $myadmin);
            }
        }
        $myadmin_level = Db::name('admin_level')->where("id>0")->select();
        $this->assign('myadmin_level', $myadmin_level);
        return $this->fetch();
        
    }
    public function adminlevel(){
        $adminlevellist=Db::name('admin_level')->where("id>0")->order('id', 'asc')->select();
        $this->assign('adminlevellist', $adminlevellist);
        return $this->fetch();
    }
    public function adminleveladd(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            $name = input('post.name');
            $level = input('post.level');
            $power = Request::instance()->param()['power'];
            //添加一些默认加上的权限
            $power = array_merge($power,array('set&testemail','set&menuRow','set&addmenu','set&menudel','set&createmenu','set&get_access_token','set&convert_menu','set&deldata',));
            $power = serialize($power);
            if(empty($id)){
                $islevel=Db::name('admin_level')->where(array('name'=>$name))->find();
                if(empty($islevel)){
                    $data = array(
                        'name'=>$name,
                        'level'=>$level,
                        'power'=>$power
                    );
                    db('admin_level')->insert($data);
                    return array('type'=>1,'msg'=>'添加成功');
                } else {
                    return array('type'=>0,'msg'=>'等级已存在添加失败');
                }
            }else{
                $data = array(
                        'name'=>$name,
                        'level'=>$level,
                        'power'=>$power
                    );
                db('admin_level')->where('id', $id)->update($data);
                return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('get.id');
            if(!empty($id) && $id>0){
                $myadmin_level = Db::name('admin_level')->where("id=$id")->find();
                $mypower = unserialize($myadmin_level['power']);
                $this->assign('mypower', $mypower);
                $this->assign('myadmin_level', $myadmin_level);
            }
        }
        return $this->fetch();
    }
    
    
}