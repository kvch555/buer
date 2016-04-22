<?php
define('ACC',true);
require('./include/init.php');

if(isset($_POST['act'])){
	//说明点击了登陆按钮过来的
	//收用户/密码，验证----
	$u=$_POST['username'];
	$p=$_POST['passwd'];

	//合法性检测自己做

	//核对用户名，密码
	$user=new UserModel();
	$row=$user->checkUser($u,$p);
	if(empty($row)){
		$msg='用户名密码不匹配!';
	}else{
		$msg="登陆成功";
		$_SESSION = $row;

		if(isset($_POST['remember'])){
			setcookie('remuser',$u,time()+14*24*3600);
		}else{
			setcookie('remuser','',0);
		}
	}
	include(ROOT.'view/front/msg.html');
}else{
	//准备登陆
	$remuser=isset($_COOKIE['remuser'])?$_COOKIE['remuser']:'';
	include(ROOT .'/view/front/denglu.html');
}

?>