<?php
namespace app\index\controller;
use \think\Db;
use app\index\model\RewardRecord;
use app\index\model\Users as user;
use app\index\model\ShareRecord ;
use app\index\model\Proinfo ;
use app\index\model\MsgInfo;

class Orders
{
	protected $shared;
	protected $proInfo;
	protected $msg;
	protected $rewarde;
	public function __construct(){
		$this->proinfo = new Proinfo();
		$this->shared = new ShareRecord();
		$this->msg=new MsgInfo();
		$this->rewarde=new RewardRecord();
	}
	/**
		* @api {post} /Orders/order_detail  我发出的项目详情
		* @apiGroup Order
		* @apiVersion 0.1.0
		* @apiParam {int} pro_id 项目ID
		* @apiParam {int} user_id ID用户
		* @apiSuccess {Object} data 项目详情
		* @apiSuccess {string} pro_id 项目id
		* @apiSuccess {string} user_id 用户id
		* @apiSuccess {string} pro_name 项目标题
		* @apiSuccess {string} pro_desc 项目内容
		* @apiSuccess {string} pro_imgs 项目图片
		* @apiSuccess {string} deadline 项目截止时间
		* @apiSuccess {string} createtime 项目创建时间
		* @apiSuccess {string} pre_reward 项目赏金
		* @apiSuccess {string} real_reward 项目真实赏金
		* @apiSuccess {string} pro_status 项目状态
		* @apiSuccess {string} share_count 项目分享数
		@apiSuccess {string} read_count 项目阅读数
		* @apiSuccess {string} attention_count 咨询数量
		* @apiSuccessExample Success-Response:
		*  HTTP/1.1 200 OK
		* {
		*   code:0,
		*   msg:'success',
		*   data:{ 
		* 	  pro_title:"xxxxx",
		* 	  pro_content:"xxxxxxxxxxxxxxxxxxxxxxx",
		* 	  pro_pics:"xxxxx,xxxxx",
		* 	  pro_endTime:"2018-08-02",
		* 	  pro_money:"100",
		* 	  pro_status:"1",
		* 	  pro_shares:"123",
		* 	  pro_asks:"321",
		*   }
		* }
		* @apiErrorExample {json} Error-Response:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'error',
		*   data:{ 
		*   }
		* }
	 */
	public function order_detail(){
		$proId = input('post.pro_id');
		$userId=input('post.user_id');
		if($proId){
			$pros=Db::table('t_pro_info')->where('pro_id',$proId)->find();
		}
		// if($userId){
		// 	$pros=Db::table('t_pro_info')->where(['pro_status'=>'0','user_id'=>$userId,'deadline'=>['GT','createtime']])->select();
		// }
		$shared=new ShareRecord();
		$share_number=$shared->myshare_number($proId,$userId);
		$return = array();
		$result= $pros;
		if($result){
			$result['number']=$share_number;
			$return = array(
				'code' => 200 ,
				'msg' => '请求成功',
			 	'data'=>$result
			);
		}else{
			$return = array(
				'code' => 201 ,
				'msg' => '获取信息失败'
			);
		}
		echo json_encode($return);
	}

		/**
		* @api {post} /Orders/order_edit 编辑
		* @apiGroup Order
		* @apiVersion 0.1.0
		* @apiParam {int} pro_id 项目ID
		* @apiParam {string} pro_name 项目名称
		* @apiParam {string} pro_desc 项目内容
		* @apiParam {string} pro_imgs 项目图片
		* @apiParam {string} deadline 项目截止时间
		* @apiParam {string} pre_reward 项目赏金
		* @apiSuccessExample Success-Response:
		*  HTTP/1.1 200 OK
		* {
		*   code:0,
		*   msg:'success',
		*   data:{ 
		*   }
		* }
		* @apiErrorExample {json} Error-Response:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'error',
		*   data:{ 
		*   }
		* }
	 */
	public function order_edit(){
		$data['pro_id'] = input('post.pro_id');
		$data['pro_name'] = input('post.pro_name');
		$data['pro_desc'] = input('post.pro_desc');
		$data['pro_imgs'] = input('post.pro_imgs');
		$data['deadline'] = input('post.deadline');
		$data['pre_reward'] = input('post.pre_reward');
		if(!$data['pro_id']||!$data['pro_name']||!$data['pro_desc']){
			$return = $this->returnMsg(201,"参数不全");
			return json_encode($return);
		}
		$proInfo= new Proinfo();
		$result=$proInfo->edit_pro($data);
		if($result){
			$return = $this->returnMsg(200,"修改成功");
		}else{
			$return = $this->returnMsg(201,"修改失败");
		}
		echo json_encode($return);
	}

	/**
		* @api {post} /Orders/order_reward 打赏
		* @apiGroup Order
		* @apiVersion 0.1.0
		* @apiParam {int[]} reward_user_id 打赏者ID
		* @apiParam {int} pro_id 项目ID
		* @apiParam {int} money 打赏金额
		* @apiParam {int} get_reward_user_id 收到打赏者ID
		* @apiSuccess {Object} data 项目打赏
		* @apiSuccessExample Success-Response:
		*  HTTP/1.1 200 OK
		* {
		*   code:0,
		*   msg:'success',
		*   data:{ 
		*   }
		* }
		* @apiErrorExample {json} Error-Response:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'error',
		*   data:{ 
		*   }
		* }
	 */
	public function order_reward(){

		$data['pro_id'] = input('post.pro_id');
		$data['reward_user_id'] = input('post.reward_user_id');
		$data['money'] = input('post.money');
		$data['get_reward_user_id'] = input('post.get_reward_user_id');
		$data['createtime'] = date("Y-m-d H:i:s",time());
		if(!$data['pro_id']||!$data['reward_user_id']||!$data['money']||!$data['get_reward_user_id']){
			$return = $this->returnMsg(201,"参数不全");
			return json_encode($return);
		}
		$rewarde=new RewardRecord();
		$user=new user();
		$proInfo=new Proinfo();
		$result=$rewarde->add_reward($data);
		$addMoney=$user->update_add_balance($data['get_reward_user_id'],$data['money']);
		$decMoney=$user->update_dec_balance($data['reward_user_id'],$data['money']);
		$return =array();
		if($result&&$addMoney&&$decMoney){
			$proInfo->update_real_money($data['pro_id'],$data['money']);
			$return=$this->returnMsg(200,"打赏成功");
		}else{
			$return=$this->returnMsg(201,"打赏失败");
		}
			echo json_encode($return);
	}
	/**
		* @api {post} /Orders/order_reward_list 已打赏list
		* @apiGroup Order
		* @apiVersion 0.1.0
		* @apiParam {int} pro_id 项目ID
		* @apiSuccess {Object} data 项目打赏
		* @apiSuccessExample Success-Response:
		*  HTTP/1.1 200 OK
		* {
		*   code:0,
		*   msg:'success',
		*   data:{ 
		*   }
		* }
		* @apiErrorExample {json} Error-Response:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'error',
		*   data:{ 
		*   }
		* }
	 */
	public function order_reward_list(){

		$data['pro_id'] = input('post.pro_id');
		$data['user_id'] = input('post.user_id');
		if(!$data['pro_id']){
			$return = $this->returnMsg(201,"参数不全");
			return json_encode($return);
		}
		$rewarde=new RewardRecord();
		$result=$rewarde ->select_reward_list($data['pro_id'],$data['user_id']);
		$return =array();
		if($result){
			$return = array(
				'code' => 200 ,
				'msg' => '请求成功',
			 	'data'=>$result
			);
		}else{
			$return = array(
				'code' => 201 ,
				'msg' => '暂无打赏信息',
			 	'data'=>$result
			);
		}
			echo json_encode($return);
	}
	
	//返回基本json
	
	public function returnMsg($status,$msg){
		$return=array(
				'code' => $status ,
				'msg' =>$msg
			);
		return $return;
	}
	/**
		* @api {post} /Orders/order_resend 转发
		* @apiGroup Order
		* @apiVersion 0.1.0
		* @apiParam {int[]} source_user_id  发起人ID
		* @apiParam {int} pro_id 项目ID
		* @apiParam {int[]} share_user_id 分享人ID
		* @apiParam {int[]} receive_user_id 接收人ID
		* @apiParam {int[]} share_word 推荐语
		* @apiParam {int[]} share_url 分享链接
		* @apiSuccessExample Success-Response:
		*  HTTP/1.1 200 OK
		* {
		*   code:0,
		*   msg:'success',
		*   data:{ 
		*   }
		* }
		* @apiErrorExample {json} Error-Response:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'error',
		*   data:{ 
		*   }
		* }
	 */
	public function order_resend(){
		$data['source_user_id'] = input('post.source_user_id');
		$data['share_user_id'] = input('post.share_user_id');
		$data['pro_id'] = input('post.pro_id');
		$data['receive_user_id'] = input('post.receive_user_id');
		$data['share_word'] = input('post.share_word');
		$data['share_url'] = input('post.share_url');
		$data['sharetime'] = date("Y-m-d H:i:s",time());
		$data['shared'] = input('post.shared',1);
		if(!$data['source_user_id']||!$data['share_user_id']||!$data['pro_id']||!$data['receive_user_id']||!$data['share_word']){
			$return = $this->returnMsg(201,"参数不全");
			return json_encode($return);
		}
		$shared=new ShareRecord();
		//判断是否可以分享
		$shareRecord=Db::table('t_share_record')->where(['pro_id'=>$data['pro_id'],'receive_user_id'=>$data['share_user_id']])->find();
		if ($shareRecord) {
			$data['code']=$shareRecord['code'].$data['share_user_id'].',';
		}else{
			$data['code']=','.$data['source_user_id'].',';
		}
		if(!$shareRecord&&$shareRecord['share_status']==1){
			$return = $this->returnMsg(201,"分享已禁止");
			return json_encode($return);
		}
		$pros=Db::table('t_pro_info')->where('pro_id',$data['pro_id'])->find();
		if($pros&&$pros['pro_status']==0){
			$result=$shared->add_record($data);
			if($result){
				$proinfo=new Proinfo();
				$count=$proinfo->update_count($data['pro_id'],1);
				$return = $this->returnMsg(200,"分享成功");
			}else{
				$return = $this->returnMsg(201,"分享失败");
			}
		}else{
			$return = $this->returnMsg(201,"分享已停用");
		}
		echo json_encode($return);
	}
	/**
		* @api {post} /Orders/order_status 修改项目状态
		* @apiGroup Order
		* @apiVersion 0.1.0
		* @apiParam {int} pro_id 项目ID
		* @apiParam {string} pro_status 项目状态（0，转发中，1，已关闭，2，已过期）
		* @apiSuccessExample Success-Response:
		*  HTTP/1.1 200 OK
		* {
		*   code:0,
		*   msg:'success',
		*   data:{ 
		*   }
		* }
		* @apiErrorExample {json} Error-Response:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'error',
		*   data:{ 
		*   }
		* }
	 */
	public function order_status(){
		$data['pro_id'] = input('post.pro_id');
		$data['pro_status'] = input('post.pro_status');
		if(!$data['pro_id']){
			$return = $this->returnMsg(201,"参数不全");
			return json_encode($return);
		}
		if(!$data['pro_status']){
			$data['pro_status']=0;
		}
		$proInfo=new  Proinfo();
		$result=$proInfo->update_pro_status($data['pro_id'],$data['pro_status']);
		if($result){
			$return = $this->returnMsg(200,"修改成功");
		}else{ 
			$return = $this->returnMsg(201,"修改失败");
		}
		echo json_encode($return);
	}
	/**
		* @api {post} /Orders/order_delete 删除项目
		* @apiGroup Order
		* @apiVersion 0.1.0
		* @apiParam {int} pro_id 项目ID
		* @apiSuccessExample Success-Response:
		*  HTTP/1.1 200 OK
		* {
		*   code:0,
		*   msg:'success',
		*   data:{ 
		*   }
		* }
		* @apiErrorExample {json} Error-Response:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'error',
		*   data:{ 
		*   }
		* }
	 */
	public function order_delete(){
		$data['pro_id'] = input('post.pro_id');
		if(!$data['pro_id']){
			$return = $this->returnMsg(201,"参数不全");
			return json_encode($return);
		}
		$proInfo=new  Proinfo();
		$result=$proInfo->update_pro_delete($data['pro_id']);
		if($result){
			$return = $this->returnMsg(200,"修改成功");
		}else{ 
			$return = $this->returnMsg(201,"修改失败");
		}
		echo json_encode($return);
	}
	/**
		* @api {post} /Orders/order_is_share 转发状态
		* @apiGroup Order
		* @apiVersion 0.1.0
		* @apiParam {int} share_id 分享ID
		* @apiParam {string} share_status 分享状态（0，可分享，1，不可分享）
		* @apiSuccessExample Success-Response:
		*  HTTP/1.1 200 OK
		* {
		*   code:0,
		*   msg:'success',
		*   data:{ 
		*   }
		* }
		* @apiErrorExample {json} Error-Response:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'error',
		*   data:{ 
		*   }
		* }
	 */
	public function order_is_share(){
		$data['shareId'] = input('post.share_id');
		$data['share_status'] = input('post.share_status');
		if(!$data['pro_id']||!$data['receive_user_id']){
			$return = $this->returnMsg(201,"参数不全");
			return json_encode($return);
		}
		$shared = new ShareRecord();
		$result=$shared->updata_status($data['shareId'],$data['share_status']);
		if($result){
			$return = $this->returnMsg(200,"修改成功");
		}else{ 
			$return = $this->returnMsg(201,"修改失败");
		}
		echo json_encode($return);
	}
/**
		* @api {post} /Orders/order_myshare 由我转发
		* @apiGroup Order
		* @apiVersion 0.1.0
		* @apiParam {int} pro_id 项目ID
		* @apiParam {int} user_id 用户ID
		* @apiSuccessExample Success-Response:
		*  HTTP/1.1 200 OK
		* {
		*   code:0,
		*   msg:'success',
		*   data:{ 
		*   }
		* }
		* @apiErrorExample {json} Error-Response:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'error',
		*   data:{ 
		*   }
		* }
	 */
	public function order_myshare(){
		$data['proId'] = input('post.pro_id');
		$data['userId'] = input('post.user_id');
		if(!$data['proId']||!$data['userId']){
			$return = $this->returnMsg(201,"参数不全");
			return json_encode($return);
		}
		$shared = new ShareRecord();
		$result=$shared->select_sharer($data['proId'],$data['userId']);
		$share_number=$shared->myshare_number($data['proId'],$data['userId']);
		if($result){
		 	$rewardinfo['rewardinfo']=$result;
			$rewardinfo['number']=$share_number;
			$return = array(
				'code' => 200 ,
				'msg' => '请求成功',
			 	'data'=>$rewardinfo
			);
		}else{ 
			$return = array(
				'code' => 200 ,
				'msg' => '无数据',
			 	'data'=>$result
			);
		}
		echo json_encode($return);
	}
/**
		* @api {post} /Orders/order_talks 合作咨询
		* @apiGroup Order
		* @apiVersion 0.1.0
		* @apiParam {int} pro_id 项目ID
		* @apiParam {int} user_id 用户ID
		* @apiSuccessExample Success-Response:
		*  HTTP/1.1 200 OK
		* {
		*   code:0,
		*   msg:'success',
		*   data:{ 
		*   }
		* }
		* @apiErrorExample {json} Error-Response:
		* HTTP/1.1 201 
		*{
		*   code:201,
		*   msg:'error',
		*   data:{ 
		*   }
		* }
	 */
	public function order_talks(){
		$data['proId'] = input('post.pro_id');
		$data['userId'] = input('post.user_id');
		if(!$data['proId']||!$data['userId']){
			$return = $this->returnMsg(201,"参数不全");
			return json_encode($return);
		}
		$msg = new MsgInfo();
		$result=$msg->select_talks($data['proId'],$data['userId']);
	
		if($result){
			$return = array(
				'code' => 200 ,
				'msg' => '请求成功',
			 	'data'=>$result
			);
		}else{ 
			$return = array(
				'code' => 200 ,
				'msg' => '无数据',
			 	'data'=>$result
			);
		}
		echo json_encode($return);
	}

}
