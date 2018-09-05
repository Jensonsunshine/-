<?php
namespace app\index\controller;

class Upload
{

	/**
		* @api {post} /Upload/upload_file 上传文件
		* @apiGroup Upload
		* @apiVersion 0.1.0
		* @apiParam {object} file 文件对象
		* @apiSuccess {string} path 文件上传路径
		* @apiSuccessExample 正确返回值:
		*  HTTP/1.1 200 OK
		* {
		*   code:200,
		*   msg:'上传成功',
		*   data:{ 
		* 	  path：http://xxx.com/upload/xxx.jpg
		*   }
		* }
		* @apiErrorExample 错误返回值:
		*{
		*   code:200,
		*   msg:'上传失败',
		*   data:{ 
		*   }
		* }
	 */
	public function upload_file(){
			// 获取表单上传文件 例如上传了001.jpg
	    $file = request()->file('file');
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    if($file){
	        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	        if($info){
	            $path = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/'.$info->getSaveName();
	            $result = array(
	            	'code' => 200 ,
	            	'msg' => '上传成功',
	            	'path' => $path
	            );
	        }else{
	            // 上传失败获取错误信息
	            //echo $file->getError();
	            $result = array(
	            	'code' => 201 ,
	            	'msg' => '上传失败',
	            	'path' => ''
	            );
	        }
	    	echo json_encode($result);
	    }
	}
}