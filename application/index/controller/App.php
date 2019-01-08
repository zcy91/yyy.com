<?php
namespace app\index\controller;
use think\Url;
use think\Config;
use think\Db;
use think\Request;

class App extends Base {
	public function update (){
		$cur = Config::get('appver');
		$data = input('get.');
		if($data['version'] < $cur['androidVer']){
			return json(['status'=>1,'note'=>'发现有新版本，是否需要下载更新？','url'=>'http://yang.oioos.com'.$cur['Update'],'appid'=>$data['appid'],'version'=>$data['version'],'imei'=>$data['imei']]);
		}else{
			return json(['sss'=>$data['version'],'cur'=>$cur['androidVer']]);
		}
	}

	public function download(){
	    $pasture = input('pasture');
	    $this->assign('pasture',$pasture);
        return $this->fetch();
    }
}