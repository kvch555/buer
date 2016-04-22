<?php
define('ACC',true);
require('./include/init.php');

$user= new UserModel();

$data=$user->_facade($_POST); 	//自动过滤
$data=$user->_autoFill($data);	//自动填充

//检验用户是否存在
if($user->checkUser($data['username'])){
	$msg='用户已存在';
	include(ROOT.'view/front/msg.html');
	exit;
}

//自动验证
if(!$user->_validate($data)){
	$msg=implode(',',$user->getErr());
	include(ROOT.'view/front/msg.html');
	exit;
}

if($user->reg($data)){
	$msg='用户注册成功';
}else{
	$msg='用户注册失败';
}

include(ROOT.'view/front/msg.html');

?>