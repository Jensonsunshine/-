<?php
use think\Route;
/**
 * 用户路由
 */
Route::rule('Users/user_login','index/Users/user_login'); // 登录
Route::rule('Users/usual_question','index/Users/usual_question'); //常见问题
Route::rule('Users/user_res','index/Users/user_res');
Route::rule('Users/user_bill','index/Users/user_bill');//资金明细
Route::rule('Users/user_info','index/Users/user_info');
Route::rule('Users/edit_user_info','index/Users/edit_user_info');
Route::rule('Users/add_label','index/Users/add_label');
Route::rule('Users/add_label','index/Users/update_label');
Route::rule('Users/add_label','index/Users/del_label');
Route::rule('Users/detailed','index/Users/detailed');
/**
 * 上传文件
 */
Route::rule('Upload/upload_file','index/Upload/upload_file');
/**
 * 我的发布
 */
Route::rule('Main/pro_info','index/Main/pro_info');
Route::rule('Main/my_release','index/Main/my_release');
/**
 * 支付
 */
Route::rule('Pay/test_recharge','index/Pay/test_recharge');
Route::rule('Pay/recharge','index/Pay/recharge');
Route::rule('Pay/test_cash','index/Pay/test_cash');
Route::rule('Pay/notice','index/Pay/notice');
Route::rule('Pay/pay','index/Pay/pay');
//详情
Route::rule('Orders/order_detail','index/Orders/order_detail');
//编辑详情
Route::rule('Orders/order_edit','index/Orders/order_edit');
//打赏
Route::rule('Orders/order_reward','index/Orders/order_reward');
//已打赏列表
Route::rule('Orders/order_reward_list','index/Orders/order_reward_list');
//转发
Route::rule('Orders/order_resend','index/Orders/order_resend');
//删除
Route::rule('Orders/order_status','index/Orders/order_status');
//修改转发状态
Route::rule('Orders/order_is_share','index/Orders/order_is_share');
//由我转发的
Route::rule('Orders/order_myshare','index/Orders/order_myshare');
//删除项目
Route::rule('Orders/order_delete','index/Orders/order_delete');
//删除项目
Route::rule('Orders/order_talks','index/Orders/order_talks');

