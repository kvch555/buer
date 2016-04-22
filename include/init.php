<?php
/****
燕十八 公益PHP讲堂

论  坛: http://www.zixue.it
微  博: http://weibo.com/Yshiba
YY频道: 88354001
****/



/*
file init.php
作用:框架初始化
*/


// 初始化当前的绝对路径
// 换成正斜线是因为 win/linux都支持正斜线,而linux不支持反斜线
define('ROOT',str_replace('\\','/',dirname(dirname(__FILE__))) . '/');
define('DEBUG',true);
defined('ACC')||exit('ACC DENNIE');

require(ROOT . 'include/lib_base.php');

function __autoload($class){
	if(strtolower(substr($class,'-5'))=='model'){
		require(ROOT.'model/'.$class.'.class.php');
	}else if(strtolower(substr($class,'-4'))=='tool'){
		require(ROOT.'tool/'.$class.'.class.php');
	}else{
		require(ROOT.'include/'.$class.'.class.php');
	}
}

// 过滤参数,用递归的方式过滤$_GET,$_POST,$_COOKIE,暂时不会
$_GET = _addslashes($_GET);
$_POST = _addslashes($_POST);
$_COOKIE = _addslashes($_COOKIE);


//开启session_start()
session_start();


// 设置报错级别
if(defined('DEBUG')) {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}



