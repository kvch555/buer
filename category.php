<?php
define('ACC',true);
require('./include/init.php');

$cat_id=isset($_GET['cat_id'])?$_GET['cat_id']+0:0;

$cat=new CateModel();
$category=$cat->find($cat_id);

if(empty($category)){
	header('location:index.php');
	exit;
}

//取出树状导航
$cats=$cat->select();
$sort=$cat->GetCatTree($cats,0,1);

//取出面包屑导航
$nav=$cat->getTree($cat_id);


//取出栏目下的商品
$goods=new GoodsModel();
$goodslist=$goods->catGoods($cat_id);

include(ROOT .'/view/front/lanmu.html');
?>