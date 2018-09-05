<?php
namespace app\index\controller;

use app\index\model\Users as user;
use app\index\model\UserAccountItem as Account;

class Pay
{
	private $appid = "wx85c9697793b02430";
	private $mch_id = ""; #商户号id
	private $user;
	private $account;
	public function __construct(){
		$this->user = new user;
		$this->account = new account;
	}
	/**
		* @api {post} /Pay/recharge 账户充值
		* @apiGroup Pay
		* @apiVersion 0.1.0
		* @apiParam {string} body 商品描述
		* @apiParam {string} out_trade_no 商品订单号
		* @apiParam {int} total_fee 标价金额
		* @apiParam {string} spbill_create_ip 终端ip
		* @apiParam {int} money_number 价钱
		* @apiSuccessExample 正确返回值:
		*  HTTP/1.1 200 OK
		* {
		*   code:200,
		*   msg:'充值成功',
		* }
		* @apiErrorExample {json} 错误返回值:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'充值失败',
		* }
	 */
	public function recharge(){
		header("Content-type: text/xml");
		$data['appid'] = $this->appid;
		$data['mch_id'] = $this->mch_id;
		$data['nonce_str'] = '';
		$data['sign'] = '';
		$data['body'] = input('post.body','JSAPI支付测试');
		$data['out_trade_no'] = input('post.out_trade_no');
		$data['total_fee'] = input('post.total_fee')*100;
		$data['spbill_create_ip'] = input('post.spbill_create_ip');
		$data['notify_url'] = "https://sharemypro.dmpp.net.cn/Pay/notice";
		$data['trade_type'] = 'JSAPI';
		$xml = $this->arrayToXml($data);
		//$result = $this->curl_post('https://api.mch.weixin.qq.com/pay/unifiedorder' , $data);
		$url = "https://api.mch.weixin.qq.com/pay/unifiedorder";

		dump($result);die;
 	}
 	//微信支付
	public function pay(){
	    //获取openid
	    $openid = "oM64f5e7zwmWyz_rrzuzgFQtzizc";
	    if(input("post.code"))
        {   //用code获取openid
            $code= input("post.code");
            $WX_APPID = 'wx85c9697793b02430';//appid
            $WX_SECRET = '08017cc5692078d1d9ac7e1bc4a20d17';//AppSecret
            $url = "https://api.weixin.qq.com/sns/jscode2session?appid=" . $WX_APPID . "&secret=" . $WX_SECRET . "&js_code=" . $code . "&grant_type=authorization_code";
            $infos = json_decode(file_get_contents($url));
            $openid = $infos->openid;
        }
	    //$fee = I("post.total_fee");
	    $fee = 0.01;//举例支付0.01
	    $appid =        'wx85c9697793b02430';//appid.如果是公众号 就是公众号的appid
	    $body =         '标题';
	    $mch_id =       '11111111';  //商户号
	    $nonce_str =    $this->nonce_str();//随机字符串
	    $notify_url =   'https://sharemypro.dmpp.net.cn/Pay/notice'; //回调的url【自己填写】
	    $openid =       $openid;
	    $out_trade_no = $this->order_number($openid);//商户订单号
	    $spbill_create_ip = '';//服务器的ip【自己填写】;
	    $total_fee =    $fee*100;// 微信支付单位是分，所以这里需要*100
	    $trade_type = 'JSAPI';//交易类型 默认
	 
	 
	    //这里是按照顺序的 因为下面的签名是按照顺序 排序错误 肯定出错
	    $post['appid'] = $appid;
	    $post['body'] = $body;
	    $post['mch_id'] = $mch_id;
	    $post['nonce_str'] = $nonce_str;//随机字符串
	    $post['notify_url'] = $notify_url;
	    $post['openid'] = $openid;
	    $post['out_trade_no'] = $out_trade_no;
	    $post['spbill_create_ip'] = $spbill_create_ip;//终端的ip
	    $post['total_fee'] = $total_fee;//总金额 
	    $post['trade_type'] = $trade_type;
	    $sign = $this->sign($post);//签名
	    $post_xml = '<xml>
	           <appid>'.$appid.'</appid>
	           <body>'.$body.'</body>
	           <mch_id>'.$mch_id.'</mch_id>
	           <nonce_str>'.$nonce_str.'</nonce_str>
	           <notify_url>'.$notify_url.'</notify_url>
	           <openid>'.$openid.'</openid>
	           <out_trade_no>'.$out_trade_no.'</out_trade_no>
	           <spbill_create_ip>'.$spbill_create_ip.'</spbill_create_ip>
	           <total_fee>'.$total_fee.'</total_fee>
	           <trade_type>'.$trade_type.'</trade_type>
	           <sign>'.$sign.'</sign>
	        </xml>';
	 	// print_r($post_xml);die;
	    //统一接口prepay_id
	    $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
	    $xml = $this->http_request($url,$post_xml);
	 
	    $array = $this->xml($xml);//全要大写
	 	//print_r($array);
	    if($array['RETURN_CODE'] == 'SUCCESS' && $array['RESULT_CODE'] == 'SUCCESS'){
	        $time = time();
	        $tmp='';//临时数组用于签名
	        $tmp['appId'] = $appid;
	        $tmp['nonceStr'] = $nonce_str;
	        $tmp['package'] = 'prepay_id='.$array['PREPAY_ID'];
	        $tmp['signType'] = 'MD5';
	        $tmp['timeStamp'] = "$time";
	 
	        $data['state'] = 200;
	        $data['timeStamp'] = "$time";//时间戳
	        $data['nonceStr'] = $nonce_str;//随机字符串
	        $data['signType'] = 'MD5';//签名算法，暂支持 MD5
	        $data['package'] = 'prepay_id='.$array['PREPAY_ID'];//统一下单接口返回的 prepay_id 参数值，提交格式如：prepay_id=*
	        $data['paySign'] = $this->sign($tmp);//签名,具体签名方案参见微信公众号支付帮助文档;
	        $data['out_trade_no'] = $out_trade_no;
	 
	 
	    }else{
	        $data['state'] = 0;
	        $data['text'] = "错误";
	        $data['RETURN_CODE'] = $array['RETURN_CODE'];
	        $data['RETURN_MSG'] = $array['RETURN_MSG'];
	    }
	    echo json_encode($data);
	}

	/**
		* @api {post} /Pay/cash 提现
		* @apiGroup Pay
		* @apiVersion 0.1.0
		* @apiParam {int} money_number 授权状态码
		* @apiSuccessExample 正确返回值:
		*  HTTP/1.1 200 OK
		* {
		*   code:200,
		*   msg:'提现成功',
		* }
		* @apiErrorExample {json} 错误返回值:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'提现失败',
		* }
	 */
	public function cash(){

	}

	public function notice(){
		echo 1;
	}
	/**
		* @api {post} /Pay/test_recharge 测试充值
		* @apiGroup Pay
		* @apiVersion 0.1.0
		* @apiParam {int} user_balance 价钱
		* @apiParam {int} user_id 用户id
		* @apiParam {string} item_desc 备注
		* @apiSuccessExample 正确返回值:
		*  HTTP/1.1 200 OK
		* {
		*   code:200,
		*   msg:'充值成功',
		* }
	 */
	public function test_recharge(){
		$user_balance = input('post.user_balance');
		$user_id = input('post.user_id');
		$result = $this->user->add_user_balance($user_balance , $user_id );

		$val['item_account'] = $user_balance;
		$val['item_name'] = '充值';
		$val['item_no'] = 'XMB_'.time().rand(111111,999999);
		$val['user_id'] = $user_id;
		$val['createtime'] = date('Y-m-d H:i:s' , time());
		$val['item_desc'] = input('post.item_desc');
		$val['pay_type'] = 0;
		$val['item_type'] = 0;
		if($result){
			$res = $this->account->add_detailed($val);
			$return = array(
				'code' => 200 ,
				'msg' => '充值成功'
			);
		}else{
			$return = array(
				'code' => 201 ,
				'msg' => '充值失败'
			);
		}
		echo json_encode($return);
	}

	/**
		* @api {post} /Pay/test_cash 测试提现
		* @apiGroup Pay
		* @apiVersion 0.1.0
		* @apiParam {int} user_balance 价钱
		* @apiParam {int} user_id 用户id
		* @apiParam {string} item_desc 备注
		* @apiSuccessExample 正确返回值:
		*  HTTP/1.1 200 OK
		* {
		*   code:200,
		*   msg:'充值成功',
		* }
	 */
	public function test_cash(){
		$user_balance = input('post.user_balance');
		$user_id = input('post.user_id');
		$balance = $this->user->get_onelist($user_id);
		if($user_balance < 100 ){
			exit(json_encode(array('code'=> 201 , 'msg'=> '100以上才能取现')));
		}
		if($balance['user_balance'] < 100 || $balance['user_balance'] < $user_balance){
			exit(json_encode(array('code'=> 201 , 'msg'=> '余额不足')));
		}
		$result = $this->user->edit_user_balance($user_balance , $user_id);
		$val['item_account'] = $user_balance;
		$val['item_name'] = '提现';
		$val['item_no'] = 'XMB_'.time().rand(111111,999999);
		$val['user_id'] = $user_id;
		$val['createtime'] = date('Y-m-d H:i:s' , time());
		$val['item_desc'] = input('post.item_desc');
		$val['pay_type'] = 0;
		$val['item_type'] = 1;
		if($result){
			$res = $this->account->add_detailed($val);
			$return = array(
				'code' => 200 ,
				'msg' => '提现成功'
			);
		}else{
			$return = array(
				'code' => 201 ,
				'msg' => '提现失败'
			);
		}
		echo json_encode($return);
	}

	public function arrayToXml($arr){
	    $xml = "<xml>";
	    $xml .= '<?xml version="1.0"?>';
	    foreach ($arr as $key=>$val){
	    if(is_array($val)){
	    $xml.="<".$key.">".arrayToXml($val)."</".$key.">";
	    }else{
	    $xml.="<".$key.">".$val."</".$key.">";
	    }
	    }
	    $xml.="</xml>";
	    return $xml;
	}

	//随机32位字符串
	private function nonce_str(){
	    $result = '';
	    $str = 'QWERTYUIOPASDFGHJKLZXVBNMqwertyuioplkjhgfdsamnbvcxz';
	    for ($i=0;$i<32;$i++){
	        $result .= $str[rand(0,48)];
	    }
	    return $result;
	}
 
	//生成订单号
	private function order_number($openid){
	    //date('Ymd',time()).time().rand(10,99);//18位
	    return md5($openid.time().rand(10,99));//32位
	}
 
  
	//签名 $data要先排好顺序
	private function sign($data){
	    $stringA = '';
	    foreach ($data as $key=>$value){
	        if(!$value) continue;
	        if($stringA) $stringA .= '&'.$key."=".$value;
	        else $stringA = $key."=".$value;
	    }
	    $wx_key = '';//申请支付后有给予一个商户账号和密码，登陆后自己设置的key
	    $stringSignTemp = $stringA.'&key='.$wx_key;
	    return strtoupper(md5($stringSignTemp));
	}
 
 
	//curl请求
	public function http_request($url,$data = null,$headers=array())
	{
	    $curl = curl_init();
	    if( count($headers) >= 1 ){
	        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	    }
	    curl_setopt($curl, CURLOPT_URL, $url);
	 
	 
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	 
	 
	    if (!empty($data)){
	        curl_setopt($curl, CURLOPT_POST, 1);
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	    }
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    $output = curl_exec($curl);
	    curl_close($curl);
	    return $output;
	}
	 
	 
	//获取xml
	private function xml($xml){
	    $p = xml_parser_create();
	    xml_parse_into_struct($p, $xml, $vals, $index);
	    xml_parser_free($p);
	    $data = "";
	    foreach ($index as $key=>$value) {
	        if($key == 'xml' || $key == 'XML') continue;
	        $tag = $vals[$value[0]]['tag'];
	        $value = $vals[$value[0]]['value'];
	        $data[$tag] = $value;
	    }
	    return $data;
	}
}