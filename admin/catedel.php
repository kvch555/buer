<?php
define('ACC',true);
require('../include/init.php');
$cat_id=$_GET['cat_id']+0;

$cate = new CateModel();	
/*判断该栏目是否有子栏目
如果有子栏目，则该栏目不允许删除*/
$sons=$cate->getSon($cat_id);
if(!empty($sons)){
	echo '有子栏目不允许删除';
	exit;
}

if($cate->delete($cat_id)){
	echo '删除成功';
}else{
	echo '删除失败';
}
?>