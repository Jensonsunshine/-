<?php
namespace app\index\model;

use think\Model;

class MsgInfo extends Model
{
	protected $table = "t_msg_info";

	public function select_talks($proId,$userId){
		$where  = array(
				's.recieve_person_id ' => $userId,'s.pro_id' => $proId,'s.msg_status'=>0
			);
		$result = $this
		->Distinct(true)
		->field('s.send_person_id,
				s.msg_content,
				u.user_nickname,
				COUNT(s.send_person_id)')
		->join('t_user_info u' , 's.send_person_id = u.user_id' , 'left')
		->where($where)
		->group('s.send_person_id')
		->order('s.send_time DESC')
		// ->page($data['page'] , $data['size'])
		->select();
		return $result;
	}
}
