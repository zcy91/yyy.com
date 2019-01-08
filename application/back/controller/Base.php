<?php

namespace app\back\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Request;
use PHPMailer\PHPMailer;

class Base extends Controller {
    public $admininfo;
    public $adminlevel;
    public $power;
            function _initialize() {
       if(!(Session::has('admin'))){
            header("Location: ".url('back/login/login'));
            exit();
        }else{
            $this->admininfo = db('admin')->where('admin_id',Session::get('admin')['admin_id'])->find();
            $this->adminlevel = db('admin_level')->where(array('id'=> $this->admininfo['level_id']))->find();
            $this->power = unserialize($this->adminlevel['power']);
            $request = Request::instance();
            $action = $request->action();
            $controller = $request->controller();
            $this->assign('controller',strtolower($controller));
            define('MODULE_NAME',strtolower($controller));
            define('ACTION_NAME',strtolower($action));
            $levelstr = MODULE_NAME.'&'.ACTION_NAME;
            if(MODULE_NAME!='index'){
                if(!empty($this->power) && $this->admininfo['level_id']!=1 && !in_array($levelstr,$this->power)){
                    $this->success("权限不足！","/back/index/main");
                }
            }
        }
    }
    function sendmail($title,$content,$address=''){
        $emailset = Db::name('email_set')->order('id', 'desc')->find();
         //实例化
        $mail=new PHPMailer\PHPMailer;
        try{
            //邮件调试模式
            $mail->SMTPDebug = 0;  
            //设置邮件使用SMTP
            $mail->isSMTP();
            // 设置邮件程序以使用SMTP
            $mail->Host = $emailset['host'];
            // 设置邮件内容的编码
            $mail->CharSet='UTF-8';
            // 设置中文提示
            // 
            // 启用SMTP验证
            $mail->SMTPAuth = true;
            // SMTP username
            $mail->Username = $emailset['username'];
            // SMTP password
            $mail->Password = $emailset['password'];
            // 启用TLS加密，`ssl`也被接受
            if(!empty($emailset['secure'])){
                $mail->SMTPSecure = 'tls';
            }
            // 连接的TCP端口
            $mail->Port = $emailset['port'];
            //设置发件人
            $mail->setFrom($emailset['from']);
           //  添加收件人
            if(empty($address)){
                $mail->addAddress($emailset['address']);
            } else {
                $mail->addAddress($address);
            }
            

            $mail->isHTML(true);
            $mail->Subject = $title;
            $mail->Body    = $content;
//            $mail->AltBody = '这是非HTML邮件客户端的纯文本';
            $issend = $mail->send();
            
            $mail->isSMTP();
            if($issend){
                return array('status'=>1,'msg'=>'发送成功！');
            }else{
                return array('status'=>0,'msg'=>$mail->ErrorInfo);
            }
        }catch (Exception $e){
            return array('status'=>0,'msg'=>$mail->ErrorInfo);
        }
    }
}