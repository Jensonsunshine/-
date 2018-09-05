<?php
namespace app\index\controller;

use app\index\model\Proinfo;
use app\index\model\ShareRecord;
/**
 *首页
 */
class Main
{
	protected $proinfo;
	protected $ShareRecord;
	public function __construct(){
		$this->proinfo = new Proinfo();
		$this->ShareRecord = new ShareRecord();
	}
	/**
		* @api {post} /Main/my_release 我发布的
		* @apiGroup Main
		* @apiVersion 0.1.0
		* @apiParam {int} user_id 用户id
		* @apiParam {int} status 判断状态 1 我发布  0 我收到的
		* @apiParam {int} page 第几页
		* @apiParam {int} size 条数
		* @apiParam {int} share_id 只显示我转发的 0 全部  1 只显示
		* @apiSuccess {string} pro_name 项目名称 
		* @apiSuccess {string} deadline 截至日期
		* @apiSuccess {string} createtime 发布时间 
		* @apiSuccess {int} share_count 转发次数  
		* @apiSuccess {int} read_count 阅读次数
		* @apiSuccess {int} attention_count 意向人数
		* @apiSuccess {string} pro_reward 转发赏金
		* @apiSuccess {int} shared 0未分享，1已分享
		* @apiSuccess {int} share_id 分享id
		* @apiSuccessExample 正确返回值:
		* {
		*   code:200,
		*   msg:'success',
		*   data:{ 
		*   }
		* }
	*/ 
	public function my_release(){
		$data['user_id'] = input('post.user_id' , 1);
		$data['status'] = input('post.status' , 0);
		$data['page'] = input('post.page' , 1 );
		$data['size'] = input('post.size' , 10);
		$data['share_id'] = input('post.share_id');
		if(!$data['user_id'] || $data['status'] > 1 || !$data['page'] || !$data['size'] ){
			exit(json_encode(array('code' => 201 , 'msg' => '参数不全')));
		}
		if($data['status'] == 1){
			$list = $this->proinfo->get_list( $data );
		}else{
			$list = $this->proinfo->receive_list( $data );
		}
		if($list){
			$return = array(
				'code' => 200 ,
				'msg' => '返回列表成功' ,
				'data' => $list
			);
		}else{
			$return = array(
				'code' => 200 , 
				'msg' => '数据列表没数据' ,
				'data' => $list
			);
		}
		echo json_encode( $return );
	}

	/**
		* @api {post} /Main/pro_info 项目发布
		* @apiGroup Main
		* @apiVersion 0.1.0
		* @apiParam {string} pro_name 项目标题
		* @apiParam {string} pro_desc 项目描述
		* @apiParam {string} pro_imgs 项目照片（逗号隔开）
		* @apiParam {int} user_id 用户id
		* @apiParam {string} deadline 截止日期
		* @apiParam {string} pre_reward 预设赏金
		* @apiParam {string} share_word 推荐语
		* @apiSuccessExample 正确返回值:
		* {
		*	"code": 200,
		*	"msg": "发布成功",
		*	"data":{
		*		"pro_id":1
		*	}
		*}
	*/
	public function pro_info(){
		//项目（产品）表
		$data['pro_name'] = input('post.pro_name','赏金猎人');
		$data['pro_desc'] = input('post.pro_desc','赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。');
		$data['pro_imgs'] = input('post.pro_imgs','1,2,3');
		$data['user_id'] = input('post.user_id','100');
		$data['deadline'] = input('post.deadline','2018-08-03 19:08');
		$data['pre_reward'] = input('post.pre_reward',100);
		$data['createtime'] = date("Y-m-d H:i:s" , time() );
		$proinfo = new Proinfo();
		$pro_id = $proinfo->add_pro($data);
		$val['source_user_id'] = $data['user_id'];
		$val['share_user_id'] = $data['user_id'];

		//分享记录表
		$val['pro_id'] = $pro_id;
		$val['sharetime'] = date("Y-m-d H:i:s" , time() );
		$val['share_word'] = input('post.share_word');
		$val['share_url'] = input('post.share_url');
		$val['share_count'] = input('post.share_count')+1;
		$val['code'] = $data['user_id'];
		$val['share_status'] = 0;
		$ShareRecord = new ShareRecord();
		$result = $ShareRecord->add_record($val);
		$return = array();
		if($result){
			$return['code'] = 200;
			$return['msg'] = '发布成功';
			$return['data'] = ['pro_id' => $pro_id];
		}else{
			$return['code'] = 201;
			$return['msg'] = '发布失败';
		}
		exit(json_encode($return));
 	}
}