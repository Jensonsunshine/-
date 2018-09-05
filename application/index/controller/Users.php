<?php
namespace app\index\controller;

use app\index\model\Users as user;
use app\index\model\UserAccountItem as Account;
use app\index\model\Proinfo;
use app\index\model\RewardRecord;
use app\index\model\Label;
use think\Cache;

class Users
{
	private $appid = "wx85c9697793b02430";
	private $secret = "08017cc5692078d1d9ac7e1bc4a20d17";
	private $user;
	private $account;
	private $reward;
	private $Label;
	public function __construct(){
		$this->user = new user;
		$this->account = new account;
		$this->Proinfo = new Proinfo;
		$this->reward = new RewardRecord;
		$this->Label = new Label;
	}
	/**
		* @api {post} /users/user_login 用户登录
		* @apiGroup User
		* @apiVersion 0.1.0
		* @apiParam {String} code 授权状态码
		* @apiSuccess {int} user_id 用户id
		* @apiSuccessExample 正确返回值:
		*  HTTP/1.1 200 OK
		* {
		*   code:200,
		*   msg:'success',
		*   data:{ 
		* 	  user_id：1
		*   }
		* }
		* @apiErrorExample {json} 错误返回值:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'error',
		*   data:{ 
		*   }
		* }
	 */
	public function user_login(){
		$code = input('post.code');
		$url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$this->appid."&secret=".$this->secret."&js_code=$code&grant_type=authorization_code";
		$result = json_decode( file_get_contents($url) , true );

		$openid = $result['openid'];
		$user_id = $this->user->get_user_id($openid);
		if($user_id){
			$return = array(
				'code'=> 200 ,
				'msg' => '请求成功' ,
				'data' => $user_id
			);
			exit(json_encode($return));
		}
		if($result){
			$return = array(
				'code'=> 200 ,
				'msg' => '请求成功' ,
				'data' => $result
			);
		}else{
			$return = array(
				'code'=> 201 ,
				'msg' => '请求失败' ,
				'data' => $result
			);
		}
		echo json_encode($return);
		//$openid = $result['openid'];
		//$session_key = $result['session_key'];
	}

	/**
		* @api {post} /users/user_res 用户注册
		* @apiGroup User
		* @apiVersion 0.1.0
		* @apiParam {String} user_nickname 用户昵称
		* @apiParam {int} user_phone  手机号
		* @apiParam {String} user_compony  公司名称
		* @apiParam {String} user_img  用户头像
		* @apiParam {String} calling  用户所在行业
		* @apiParam {String} user_area  用户所在区域
		* @apiParam {String} user_lable 标签
		* @apiParam {String} openid 微信openid
		* @apiSuccessExample 正确返回值:
		*  HTTP/1.1 200 OK
		* {
		*   code:200,
		*   msg:'注册成功',
		* }
		* @apiErrorExample {json} 错误返回值:
		*{
		*   code:201,
		*   msg:'注册失败',
		* }
	*/
	public function user_res(){
		if(!input('post.openid')){
			exit(json_encode(array('code'=>201 , 'msg'=>'openid为空')));
		}
		$data['user_nickname'] = input('post.user_nickname');
		$data['user_phone'] = input('post.user_phone');
		$data['openid'] = input('post.openid');
		$data['user_title'] = input('post.user_title');
		$data['user_compony'] = input('post.user_compony');
		$data['user_img'] = input('post.user_img');
		$data['user_balance'] = 0;
		$data['createtime'] = date("Y-m-d H:i:s" , time());
		$data['calling'] = input('post.calling');
		$data['user_area'] = input('post.user_area');
		$data['user_lable'] = input('post.user_lable');
		$user = new user();
		$result = $user->add_user($data);
		$return = array();
		if($result){
			$return = array(
				'code' => 200 ,
				'msg' => '注册成功' ,
				'data' => ['user_id' => $result ]
			);
		}else{
			$return = array(
				'code' => 201 ,
				'msg' => '注册失败'
			);
		}
		echo json_encode($return);
	}

	/**
		* @api {post} /users/user_info 用户信息
		* @apiGroup User
		* @apiVersion 0.1.0
		* @apiParam {int} user_id 用户id
		* @apiSuccess {Object} data 用户信息
		* @apiSuccess {string} user_nickname 用户昵称
		* @apiSuccess {string} user_phone 用户手机号
		* @apiSuccess {string} user_title 用户职位
		* @apiSuccess {string} user_compony 用户公司名称
		* @apiSuccess {string} user_balance 账户余额
		* @apiSuccess {string} user_img 头像地址
		* @apiSuccess {string} pro_count 发布任务次数
		* @apiSuccess {string} label_id 标签id 
		* @apiSuccess {string} label_name 标签名字
		* @apiSuccess {string} count 成功打赏次数
		* @apiSuccess {string} money 打赏金额
		* @apiSuccess {string} calling  所在行业
		* @apiSuccessExample 正确返回值:
		* {
		*   code:200,
		*   msg:'success',
		*   data:{ 
		* 	  'user_nickname':'张三',
		* 	  'user_phone':18888888888,
		* 	  'user_title':'总裁'
		*   }
		* }
	*/
	public function user_info(){
		$where['user_id'] = input('post.user_id');
		if(!$where){
			exit(json_encode(array('code'=> 201 , 'msg'=> '参数不全')));
		}
		$data = $this->user->user_info( $where );
		if(!$data){
			exit(json_encode(array('code'=> 201 , 'msg'=> '没有此用户')));
		}
		$pro_count = $this->Proinfo->pro_count( $where );
		$reward_val = $this->reward->get_count(['reward_user_id' => $where['user_id']]);
		//$data['label'] = $this->Label->get_list($where);
		// $label = $this->Label->get_list($where);
		$data['money'] = $reward_val[0]['money'];
		$data['count'] = $reward_val[0]['count'];
		$data['pro_count'] = $pro_count;
		// $data['label_name'] = $label['label_name'];
		// $data['label_id'] = $label['label_id'];
		$return = array();
		if($data){
			$return['code'] = 200 ;
			$return['msg'] = "返回用户信息成功";
			$return['data'] = $data ;
		}else{
			$return['code'] = 200 ;
			$return['msg'] = "返回用户信息成功";
			$return['data'] = $data ;
		}
		echo json_encode($return);
	}

	/**
		* @api {post} /users/user_bill 资金明细
		* @apiGroup User
		* @apiVersion 0.1.0
		* @apiParam {int} user_id 用户id
		* @apiParam {int} item_type 0 全部 1 收入 2 支出
		* @apiParam {int} page 页数
		* @apiParam {int} size 条数
 		* @apiSuccess {string} item_name 收支项目名称 
		* @apiSuccess {string} createtime 创建时间
		* @apiSuccess {string} item_account 项目费用
		* @apiSuccess {int} item_type 账务类型：0：充值，1：提现，2：打赏
		* @apiSuccessExample 正确返回值:
		*{
		*   code:200,
		*   msg:'success',
		*   data:{ 
		*   }
		* }
		* @apiErrorExample {json} 错误返回值:
		* {
		* 	code:201,
		* 	msg:'error',
		* 	data:{}
		* }
	 */
	public function user_bill(){
		$user_id = input('post.user_id');
		//$where['item_type'] = input('post.item_type');
		$item_type = input('post.item_type');
		if(!$user_id){
			exit(json_encode(array('code' => 201 , 'msg' => '参数不全')));
		}
		if($item_type == 0 ){
			$where['item_type'] = "0,1,2";
		}
		if($item_type == 1 ){
			$where['item_type'] = '0';
		}
		if($item_type == 2 ){
			$where['item_type'] = '1,2';
		}
		$where['user_id'] = $user_id;
		$page['page'] = input('post.page' , 1);
		$page['size'] = input('post.size' , 10);
		$account = new Account();
		$get_list = $account->get_list( $where , $page );
		if($get_list){
			$return = array(
				'code' => 200 ,
				'msg' => '获取列表成功' ,
				'data' => $get_list
			);
		}else{
			$return = array(
				'code' => 200 ,
				'msg' => '列表为空' ,
				'data' => []
			);
		}
		echo json_encode($return);
	}
	/**
		* @api {post} /users/usual_question 常见问题
		* @apiGroup User
		* @apiVersion 0.1.0
		* @apiParam {int} id 请求一个问题的详细
		* @apiSuccess {object} list 常见问题列表
		* @apiSuccessExample 正确返回值:
		*{
		*	"code": 200,
		*	"msg": "返回常见问题列表成功",
		*	"data": [{
		*		"title": "什么是赏金猎人",
		*		"content": "赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。"
		*	}, {
		*		"title": "什么是赏金猎人",
		*		"content": "赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。"
		*	}, {
		*		"title": "什么是赏金猎人",
		*		"content": "赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。"
		*	}, {
		*		"title": "什么是赏金猎人",
		*		"content": "赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。"
		*	}]
		*}
		* @apiErrorExample {json} 错误返回值:
		* {
		* 	code:201,
		* 	msg:'返回常见问题列表失败',
		* 	data:{}
		* }
	 */
	public function usual_question(){
		$id = input('post.id');
    	$array = array(
    		array('id'=>'0','title'=>'什么是赏金猎人' , 'content'=> '赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。'),
    		array('id'=>'1','title'=>'如何新建项目' , 'content'=> '赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。'),
    		array('id'=>'2','title'=>'如何转发' , 'content'=> '赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。'),
    		array('id'=>'3','title'=>'如何打赏' , 'content'=> '赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。'),
    		array('id'=>'4','title'=>'如何充值' , 'content'=> '赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。'),
    		array('id'=>'5','title'=>'如何提现' , 'content'=> '赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。'),
    		array('id'=>'6','title'=>'打赏的规则是什么' , 'content'=> '赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。'),
    		array('id'=>'7','title'=>'如何关闭项目' , 'content'=> '赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。')
    	);
    	
    	if($id){
    		$arr = $array[$id];
    	}else{
    		$arr = $array;
    	}
    	$result = array(
    		'code' => 200 ,
    		'msg' => '返回常见问题列表成功',
    		'data' => $arr
    	);
    	echo json_encode($result);
    }
    /**
		* @api {post} /users/edit_user_info 编辑用户信息
		* @apiGroup User
		* @apiVersion 0.1.0
		*@apiParam {String} user_nickname 用户昵称
		* @apiParam {int} user_phone  手机号
		* @apiParam {String} user_compony  公司名称
		* @apiParam {String} user_img  用户头像
		* @apiParam {String} calling  用户在职公司名称
		* @apiParam {String} user_area  用户所在区域
		* @apiParam {String} user_lable 标签
		* @apiSuccessExample 正确返回值:
		*{
		*	"code": 200,
		*	"msg": "信息修改成功",
		*}
    */
    public function edit_user_info(){
    	$user_id = input('post.user_id');
    	$data['user_nickname'] = input('post.user_nickname');
		$data['user_phone'] = input('post.user_phone');
		$data['user_title'] = input('post.user_title');
		$data['user_compony'] = input('post.user_compony');
		$data['user_img'] = input('post.user_img');
		$data['user_balance'] = 0;
		$data['createtime'] = date("Y-m-d H:i:s" , time());
		$data['calling'] = input('post.calling');
		$data['user_area'] = input('post.user_area');
		$data['user_lable'] = input('post.user_lable');
		$res = $this->user->edit_user_info($data , $user_id);
		if($res){
			$return = array(
				'code'=> 200 ,
				'msg' => '用户信息修改成功',
			);
		}else{
			$return = array(
				'code'=> 201 ,
				'msg' => '用户信息修改失败',
			);
		}
		echo json_encode($return);
    }
    /**
		* @api {post} /users/add_label 添加标签
		* @apiGroup User
		* @apiVersion 0.1.0
		* @apiParam {String} label_name 标签
		* @apiParam {int} user_id  用户id
		* @apiSuccessExample 正确返回值:
		*{
		*	"code": 200,
		*	"msg": "添加标签成功",
		*}
     */
    public function add_label(){
    	$data['label_name'] = input('post.label_name');
    	$data['user_id'] = input('post.user_id');
    	$data['create_time'] = date("Y-m-d H:i:s" , time());
    	$result = $this->Label->add_label($data);
    	if($result){
    		$return = array(
    			'code' => 200 ,
    			'msg' => '添加标签成功'
    		);
    	}else{
    		$return = array(
    			'code' => 201 ,
    			'msg' => '添加标签失败'
    		);
    	}
    	echo json_encode($return);
    }

    public function update_label(){
    	$label_id = input('post.label_id');
    	$data['label_name'] = input('post.label_name');
    	$data['user_id'] = input('post.user_id');
    	$data['create_time'] = date("Y-m-d H:i:s" , time());
    	$result = $this->Label->update_label($data , $label_id);
    	if($result){
    		$return = array(
    			'code' => 200 ,
    			'msg' => '修改标签成功'
    		);
    	}else{
    		$return = array(
    			'code' => 201 ,
    			'msg' => '修改标签失败'
    		);
    	}
    	echo json_encode($return);
    }

    /**
	* @api {post} /del_label
	* @apiGroup del_label
	* @apiVersion 0.1.0
	* @apiParam {String} version 版本号
	* @apiParam {String} signType 签名方式
	* @apiParam {String} charset 编码格式
	* @apiParam {String} noncestr 随机字符串
	* @apiParam {String} sign 签名
	* @apiParam {String} payType 业务类型
	* @apiSuccessExample 正确返回值:
	*{
	*	"code":"200",
	*	'msg':'success',
	*	'data':{
	*		"version": "1.0",
	*		"signType": "SHA256",
	*		"charset": "utf-8",
	*		"noncestr": "6dwd54few545grw5grg55f",
	*		"merchOrderId": "M345654279890",
	*		"payReqId": "201805210132",
	*		"mchId": "88370112100025",
	*		"payAmount": "0.01",
	*		"orderDesc": "堃用支付",
	*		"payType": "3002",
	*		"termId": "ANDD",
	*		"attach": "",
	*		"orderExpire": "60",
	*		"notifyUrl": "http=>\/\/47.96.170.254\/api\/testNotify",
	*		"orgId": "873717021022",
	*		"orderTime": "2018-05-18 13=>23=>23"
	*	}
	*}
*/
    public function  del_label(){
    	$label_id = input('post.label_id');
    	$result = $this->Label->delete_label( $label_id );
    	if($result){
    		$return = array(
    			'code' => 200 ,
    			'msg' => '删除标签成功'
    		);
    	}else{
    		$return = array(
    			'code' => 201 ,
    			'msg' => '删除标签失败'
    		);
    	}
    	echo json_encode($return);
    }
    /**
		* @api {post} /users/detailed 账户明细表
		* @apiGroup User
		* @apiVersion 0.1.0
		* @apiParam {int} item_id 明细id
		* @apiSuccess {string} item_account 账目费用
		* @apiSuccess {int} item_no 订单号
		* @apiSuccess {string} createtime 交易时间
		* @apiSuccess {string} item_desc 备注
		* @apiSuccess {int} item_type 交易类型
		* @apiSuccessExample 正确返回值:
		* {
		* 	"code": 200,
		*  	"msg": "返回明细成功",
		*   "data": 
		*   {
		*     "item_account": "0.00",
		*     "item_no": "123312222",
		*     "createtime": "2018-08-11 12:09:29",
		*     "item_desc": "1",
		*     "item_type": "1"
		*   }
		*}
     */
    public function detailed(){
    	$item_id = input('post.item_id');
    	if(empty($item_id)){
    		exit(json_encode(array('code'=>201 , 'msg'=> '参数不全')));
    	}
    	$result = $this->account->detailed(array('item_id'=>$item_id));
    	if($result){
    		$return = array(
    			'code' => 200 ,
    			'msg' => '返回明细成功',
    			'data' => $result
    		);
    	}else{
    		$return = array(
    			'code' => 201 ,
    			'msg' => '返回明细失败',
    			'data' => []
    		);
    	}
    	echo json_encode($return);
    }


    public function test_1(){
    	echo phpinfo();die;
    	$str = "1,2,A,E,5,Q,B,1";
    	$arr = explode(',', $str);
    	foreach($arr as $val){
    		if(is_numeric($val)){
    			$num[] = $val;
    			asort($num);
    		}else{
    			$words[] = $val;
    			sort($words);
    		}
    	}
    	dump($words);die;
    }


    public function test_redis(){
	  $options = [

	      'type'  => 'redis',//指定类型

	      'password'=>'12345',

	     'prefix' => 'sbn-',

	     'host'      => '127.0.0.1',

	  ];

	   Cache::init($options);//初始化
	   Cache::set('listtest','112211');
	 $res = Cache::get('listtest');

	    dump($res);
    }
    public function test(){

 		Cache::store('redis')->set('name','value');
        $name = Cache::get('name');
        echo $name;
    }

    public function test_get(){
    	Cache::rm('name');
    	$name = Cache::get('name');
    	echo $name;
    }
}
