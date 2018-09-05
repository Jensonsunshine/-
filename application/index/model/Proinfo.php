<?php
namespace app\index\model;

use think\Model;

class Proinfo extends Model
{
	protected $table = 't_pro_info';

	//发布
	public function add_pro( $data ){
		$result = $this->save($data);
		return $this->pro_id;
	}
	//编辑
	public function edit_pro( $data ){
		$result = $this->update($data);
		return $result;
	}
	//修改项目状态
	public function update_pro_status($proId,$status){
		$result=$this->where('pro_id',$proId)->update(['pro_status' => $status]);
		return $result;
	}
	//增加项目真实赏金
	public function update_real_money($proId,$money){
		$result=$this->where('pro_id',$proId)->setInc('real_reward',$money);
		return $result;
	}
	//增加项目转发等数
	public function update_count($proId,$count){
		$result=$this->where('pro_id',$proId)->setInc('share_count',$count);
		$this->where('pro_id',$proId)->setInc('read_count',$count);
		$this->where('pro_id',$proId)->setInc('attention_count',$count);
		return $result;
	}
		//删除项目
	public function update_pro_delete($proId){
		$result=$this->where('pro_id',$proId)->update(['is_delete'=>'1']);
		return $result;
	}
	//查询列表
	public function get_list( $data ){
		$where  = array(
			'ti.user_id' => $data['user_id']
		);
		$result = $this
		->alias('ti')
		->field('ti.pro_id , ti.pro_name , ti.pro_desc , ti.pro_imgs , ti.pro_status , ti.deadline , ti.pre_reward , ti.createtime , ti.share_count , ti.read_count , ti.attention_count , ti.real_reward , tr.shared , tr.share_id')
		->join('t_share_record tr' , 'ti.pro_id = tr.pro_id' , 'left')
		->where($where)
		->group('ti.pro_id')
		->order('createtime DESC')
		->page($data['page'] , $data['size'])
		->select();
		return $result;
	}
	public function receive_list($data){
		$where  = array(
			'tr.receive_user_id' => $data['user_id']
		);
		if($data['share_id']){
			$where  = array(
				'tr.receive_user_id' => $data['user_id'] , 
				'tr.shared' => 1
			);
		}
		$result = $this
		->alias('ti')
		->field('ti.pro_id , ti.pro_name , ti.pro_desc , ti.pro_imgs , ti.pro_status , ti.deadline , ti.pre_reward , ti.createtime , ti.share_count , ti.read_count , ti.attention_count , ti.real_reward , tr.shared , tr.share_id')
		->join('t_share_record tr' , 'ti.pro_id = tr.pro_id' , 'right')
		->where($where)
		->order('createtime DESC')
		->page($data['page'] , $data['size'])
		->select();
		return $result;
	}

	public function pro_count( $where ){
		$result = $this
		->field('pro_id')
		->where( $where )
		->count();
		return $result;
	}
	
}