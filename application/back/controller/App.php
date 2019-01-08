<?php
namespace app\back\controller;
use think\Request;
use think\config;

class App extends Base {
	public function banbenguanli (){
		$data = Config::get('appver');
		if(Request::instance()->isPost()){
			$data = input('post.');
			sys_config_setbyarr('/back/extra/appver.php',$data);
			$this->success('修改成功',url("/back/app/banbenguanli"));
		}
		$this->assign('data',$data);
		return $this->fetch();
	}
}