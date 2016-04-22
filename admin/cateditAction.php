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

/*一个栏目A，不能修改成为A的子孙栏目的子栏目
思考:如果B是A的后代，则A不能成为B的子栏目。
反之，B是A的后代，则A是B的祖先
*/
$tree=$cate->getTree($data['parent_id']);
$flag=true;
foreach($tree as $v){
	if($v['cat_id']==$cat_id){
		$flag=false;
		break;
	}
}
if(!$flag){
	echo "父栏目选取错误";
	exit;
}


if($cate->update($data,$cat_id)){
	echo '更新成功';
	exit;
}else{
	echo '更新失败';
	exit;
}

?>