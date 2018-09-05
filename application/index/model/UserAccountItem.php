<?php
namespace app\index\model;

use think\Model;

class UserAccountItem extends Model{

	protected $table = "t_user_account_item";

	public function get_list( $where , $page ){
		$result = $this
		->field('item_id , item_name , item_account , createtime , item_type')
		->where('user_id',$where['user_id'])
		->where('item_type' , 'in' , $where['item_type'])
		->page($page['page'] , $page['size'])
		->order('item_id DESC')
		->select();
		return $result;
	}


	public function detailed($where){
		$result = $this
		->field('item_account , item_no , createtime , item_desc , item_type')
		->where($where)
		->find();
		return $result;
	}


	public function add_detailed($data){
		$result = $this->save($data);
		return $result;
	}
}

