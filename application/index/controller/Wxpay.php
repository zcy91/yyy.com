<?php
/**
 * Created by PhpStorm.
 * User: fbi
 * Date: 2018/8/22 0022
 * Time: 15:27
 */
namespace app\index\controller;
use think\Db;

class Wxpay  extends Base  {
    public function ToXml($data=array())
    {
        if(!is_array($data) || count($data) <= 0)
        {
            return '数组异常';
        }

        $xml = "<xml>";
        foreach ($data as $key=>$val)
        {
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }
    public function rand_code(){
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//62个字符
        $str = str_shuffle($str);
        $str = substr($str,0,32);
        return  $str;
    }

    private function getSign($params) {
        ksort($params);        //将参数数组按照参数名ASCII码从小到大排序
        foreach ($params as $key => $item) {
            if (!empty($item)) {         //剔除参数值为空的参数
                $newArr[] = $key.'='.$item;     // 整合新的参数数组
            }
        }
        $stringA = implode("&", $newArr);         //使用 & 符号连接参数
        $stringSignTemp = $stringA."&key="."946nhjhsocj2kmrlkw6puaw09byt4yyb";        //拼接key
        // key是在商户平台API安全里自己设置的
        $stringSignTemp = MD5($stringSignTemp);       //将字符串进行MD5加密
        $sign = strtoupper($stringSignTemp);      //将所有字符转换为大写
        return $sign;
    }
    public function wx_pay() {
        $oid = input('oid');
        $myorder=Db::name('order')->where('id',$oid)->find();

        $order_sn = $myorder['ordersn'];
        $total_price = $myorder['price']*100;
        $body = '食花百草羊';
        $nonce_str = $this->rand_code();        //调用随机字符串生成方法获取随机字符串
        $data['appid'] ='wx7f6ac7bccdd29c6a';   //appid
        $data['mch_id'] = '1503944471';        //商户号
        $data['body'] = $body;
        $data['spbill_create_ip'] = $_SERVER['REMOTE_ADDR'];   //ip地址
        $data['total_fee'] = (float)$total_price;                         //金额
        $data['out_trade_no'] = $order_sn;    //商户订单号,不能重复
        $data['nonce_str'] = $nonce_str;                   //随机字符串
        $data['notify_url'] = 'http://yang.oioos.com/index/wxpay/wx_notify';   //回调地址,用户接收支付后的通知,必须为能直接访问的网址,不能跟参数
        $data['trade_type'] = 'APP';      //支付方式
        //将参与签名的数据保存到数组  注意：以上几个参数是追加到$data中的，$data中应该同时包含开发文档中要求必填的剔除sign以外的所有数据
        $data['sign'] = $this->getSign($data);        //获取签名
//var_dump($data);die;
        $xml = $this->ToXml($data);            //数组转xml

        //curl 传递给微信方
        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
        header("Content-Type:text/xml");
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }    else    {
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
        }
        //设置header
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        //传输文件
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        //返回结果

        if($data){
            curl_close($ch);
            //返回成功,将xml数据转换为数组.
            $re = $this->FromXml($data);
            header('Content-Type:text/json');
            if($re['return_code'] != 'SUCCESS'){
                return ( json(['error'=>'签名错误'],'500'));
            }
            else{
                if($re['result_code'] =='FAIL'){
                    return json(['err_code_des'=> $re['err_code_des']],500);
                }
                //接收微信返回的数据,传给APP!
                $arr =array(
                    'prepayid' =>$re['prepay_id'],
                    'appid' => 'wx7f6ac7bccdd29c6a',
                    'partnerid' => '1503944471',
                    'package' => 'Sign=WXPay',
                    'noncestr' => $nonce_str,
                    'timestamp' =>time(),
                );
                //第二次生成签名
                $sign = $this->getSign($arr);
                $arr['sign'] = $sign;

                return (json($arr,'200'));
            }
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            return (json(['error'=>"curl出错，错误码:$error"],'201'));
        }
    }
    public function FromXml($xml)
    {
        if(!$xml){
            echo "xml数据异常！";
        }
        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $data;
    }
    function wx_notify(){
        //接收微信返回的数据数据,返回的xml格式
        $xmlData = file_get_contents('php://input');
        //将xml格式转换为数组
        $data = $this->FromXml($xmlData);
        //用日志记录检查数据是否接受成功，验证成功一次之后，可删除。
        $file = fopen('./log.txt', 'a+');
        fwrite($file,var_export($data,true));
        //为了防止假数据，验证签名是否和返回的一样。
        //记录一下，返回回来的签名，生成签名的时候，必须剔除sign字段。
        $sign = $data['sign'];
        unset($data['sign']);
        if($sign == $this->getSign($data)){
            //签名验证成功后，判断返回微信返回的
            if ($data['result_code'] == 'SUCCESS') {
                //根据返回的订单号做业务逻辑
                $arr = array(
                    'pay_status' => 1,
                );
                $time=time();
                $ordersn = $data['out_trade_no'];
                $issn = db('order')->where(array('ordersn'=>$ordersn))->find();
                $member = db('member')->where('id',$issn['uid'] )->find();
                $result = db('order')->where('id', $issn['id'])->update(['status'=>1,'paytype'=>6,'paytime'=> $time]);
                db('lamb')->where('oid', $issn['id'])->update(['status' => '1','paytime'=>$time]);
                $data=array(
                    'rechargesn'=>'',
                    'userid'=>$member['id'],
                    'money'=>$issn['money'],
                    'vary'=>2,//1表示增加
                    'balance'=>$member['credit'],//余额
                    'type'=>6,//6表示微信APP
                    'time'=>$time,
                    'remark'=>'买羊羔',
                    'status'=>1,//生效
                );
                db('recharge_log')->insert($data);

                //处理完成之后，告诉微信成功结果！
                if($result){
                    echo '<xml>
              <return_code><![CDATA[SUCCESS]]></return_code>
              <return_msg><![CDATA[OK]]></return_msg>
              </xml>';exit();
                }
            }
            //支付失败，输出错误信息
            else{
                $file = fopen('./log.txt', 'a+');
                fwrite($file,"错误信息：".$data['return_msg'].date("Y-m-d H:i:s"),time()."\r\n");
            }
        }
        else{
            $file = fopen('./log.txt', 'a+');
            fwrite($file,"错误信息：签名验证失败".date("Y-m-d H:i:s"),time()."\r\n");
        }

    }
}