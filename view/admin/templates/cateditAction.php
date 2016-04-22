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

$cat_id=$_POST['cat_id']+0;

$cate = new CateModel($data);
if($cate->update($data,$cat_id)){
	echo '修改成功';
}else{
	echo '修改失败';
}

?>