<?php
define('ACC',true);
require('../include/init.php');

$data=array();
if(empty($_POST['cat_name'])){
	echo '栏目不能为空';
}

if(empty($_POST['intro'])){
	echo '介绍不能为空';
}
$data['cat_name']=$_POST['cat_name'];
$data['parent_id']=$_POST['parent_id'];
$data['intro']=$_POST['intro'];

$cate = new CateModel($data);
if($cate->add($data)){
	echo '栏目添加成功';
}else{
	echo '栏目添加失败';
}


?>