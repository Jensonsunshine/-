<?php

namespace app\index\model;

use think\Model;

class Users extends Model{
	protected $table = 't_user_info';
	//添加用户
	public function add_user( $data ){
		$result = $this->save( $data );
		return $this->user_id;
	}
	//增加用户余额
	public function update_add_balance($userId,$money){
		$result=$this->where('user_id',$userId)->setInc('user_balance',$money);
		return $result;
	}
	//扣除余额
		public function update_dec_balance($userId,$money){
		$result=$this->where('user_id',$userId)->setDec('user_balance',$money);
		return $result;
	}
	//获取用户信息
	public function user_info( $where ){
		$result = $this
		->field('user_nickname , user_title , user_compony , user_balance , user_img , user_lable , user_area , calling ')
		->where( $where )
		->find();
		return $result;
	}
	//修改用户信息
	public function edit_user_info( $data , $user_id ){
		$where = array(
			'user_id' => $user_id
		);
		$result = $this
		->where( $where )
		->update( $data );
		return $result;
	}

	public function get_user_id ( $openid ){
		$where = array(
			'openid' => $openid
		);
		$user_id = $this
		->field('user_id')
		->where($where)
		->find();
		return $user_id;
	}

	public function edit_user_balance($user_balance , $user_id){
		$where = array(
			'user_id' => $user_id
		);
		$result = $this
		->where($where)
		->setDec('user_balance', $user_balance);
		return $result;
	}

	public function add_user_balance($user_balance , $user_id){
		$where = array(
			'user_id' => $user_id
		);
		$result = $this
		->where($where)
		->setInc('user_balance', $user_balance);
		return $result;
	}

	public function get_onelist ( $user_id ){
		$where = array(
			'user_id' => $user_id
		);
		$list = $this
		->where($where)
		->find();
		return $list;
	}
}