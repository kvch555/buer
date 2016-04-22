<?php
define('ACC',true);
require('../include/init.php');

$goods_id=$_GET['goods_id']+0;
$goods=new GoodsModel();
$g=$goods->find($goods_id);

if(empty($g)){
	echo '商品不存在';
	exit;
}
?>