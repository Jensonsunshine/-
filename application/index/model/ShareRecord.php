<?php
namespace app\index\model;

use think\Model;

class ShareRecord extends Model
{
	protected $table = 't_share_record';

	public function add_record( $data ){
		$result = $this->save( $data );
		return $result;
	}
	public function updata_status( $shareId,$status ){
		$result = $this->where('share_id',$shareId)->update(['share_status' => $status]);
		return $result;
	}
	public function myshare_number($proId,$userId){
		$where  = array(
				'pro_id' => $proId
			);
		$result = $this
			->alias('s')
			->field('count(0)')
			->where($where)
			->where('code' ,'like', '%,'.$userId.',%')
			->find();
		return $result['count(0)'];
	}
	//由我转发的人
	public function select_sharer( $proId,$receiveId ){
		$where  = array(
				's.pro_id' => $proId,'s.share_user_id' => $receiveId
			);
		$result = $this
		->alias('s')
		->field('s.receive_user_id,user_nickname,user_img')
		->join('t_user_info u' , 'u.user_id = s.receive_user_id' , 'left')
		->where($where)
		->order('createtime DESC')
		// ->page($data['page'] , $data['size'])
		->select();
		for ($i=0; $i <count($result); $i++) { 
			$result2 = $this
			->alias('s')
			->field('count(0)')
			->where('code' ,'like', '%,'.$result[$i]['receive_user_id'].',%')
			->where('s.pro_id',$proId)
			// ->page($data['page'] , $data['size'])
			->find();
			$result[$i]['number']=$result2['count(0)'];
		}
		return $result;
	}
}