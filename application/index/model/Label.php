<?php
namespace app\index\model;

use think\Model;

class Label extends Model
{
	protected $table = "t_user_label";

	// public function add_label($data){
	// 	$result = $this->save($data);
	// 	return $result;
	// }

	// public function get_list( $where ){
	// 	$list = $this
	// 	->field('label_name , label_id')
	// 	->where($where)
	// 	->find()
	// 	return $list;
	// }
	// public function update_label($data , $label_id){
	// 	$where = array(
	// 		'label_id' => $label_id
	// 	);
	// 	$result = $this
	// 	->where($where)
	// 	->update($data);
	// 	return $result;
	// }

	// public function del_label($label_id){
	// 	$where = array(
	// 		'label_id' => $label_id
	// 	);
	// 	$result = $this
	// 	->where($where)
	// 	->delete();
	// 	return $result;
	// }
}
