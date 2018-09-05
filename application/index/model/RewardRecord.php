<?php

namespace app\index\model;

use think\Model;

class RewardRecord extends Model{
	protected $table = 't_reward_info';

	public function add_reward( $data ){
		$result = $this->save( $data );
		return $result;
	}
	public function get_count( $where ){
		$result = $this
		->field('sum(money) as money , count(reward_id) as count ,  createtime ')
		->where($where)
		->select();
		return $result;
	}
	public function select_reward_list( $proId,$userId ){
		$where  = array(
				'pro_id'=>$proId
			);
		$result = $this
		->alias('r')
		->Distinct(true)
		->field('reward_user_id,u.user_nickname,r.createtime,
				u.user_img')
		->join('t_user_info u' , 'r.reward_user_id = u.user_id' , 'left')
		->where('pro_id',$proId)
		->select();
		for ($i=0; $i <count($result); $i++) { 
			if($result[$i]['reward_user_id']==$userId){
				$result[$i]['is_source']=0;
			}else{
				$result[$i]['is_source']=1;
			}
			$result2 = $this
			->field('sum(money)')
			->where($where)
			->where('reward_user_id',$result[$i]['reward_user_id'])
			// ->page($data['page'] , $data['size'])
			->find();
			$result[$i]['number']=$result2['sum(money)'];
			$result3=$this
			->field('get_reward_user_id,ui.user_nickname,
				ui.user_img,money')
			->join('t_user_info ui' , 'get_reward_user_id = ui.user_id' , 'left')
			->where($where)
			->where('reward_user_id',$result[$i]['reward_user_id'])
			->select();
			$result[$i]['reward_list']=$result3;
		}
		return $result;
	}
}