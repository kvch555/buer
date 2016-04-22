<?php
define('ACC',true);
require('../include/init.php');

$goods= new GoodsModel();
$data=array();
$_POST['goods_weight'] *=$_POST['weight_unit'];
$data=$goods->_facade($_POST); 		//自动过滤
$data=$goods->_autoFill($data);		//自动填充

//添加自动商品货号
if(empty($data['good_sn'])){
	$data['goods_sn']=$goods->createSn();
}

//自动验证
if(!$goods->_validate($data)){
	echo '数据不合法<br />';
	echo implode(',',$goods->getErr());
	exit;
}

//上传图片
$uptool=new UpTool();
//$uptool->setSize(0.01); //设定图片不能大于0.001MB
//$uptool->setExt('doc');	   //设定上传图片后缀类型doc
$ori_img=$uptool->up('ori_img');

if(!$ori_img){				//判断上传是否成功
	echo $uptool->getErr();
	exit;
}

$data['ori_img']=$ori_img;

//设置中等缩略图路径
$ori_img=ROOT.$ori_img;
$goods_img=dirname($ori_img).'/goods_'.basename($ori_img);

//如果$_ori_img上传成功，再次生成中等大小缩略图 300*400
//根据原始地址定中等图的地址
//例:aa.jpeg-->goods_aa.jpeg
if(!ImageTool::thumb($ori_img,$goods_img,300,400)){
	echo '生成中等图失败';
	exit;
}
$data['goods_img']=str_replace(ROOT,'',$goods_img);

//再次生成浏览时用缩略图 160*220
//定好缩略图地址
//aa.jpeg-->thumb_aa.jpeg

//设置中等缩略图路径
$thumb_img=dirname($ori_img).'/thumb_'.basename($ori_img);

if(!ImageTool::thumb($ori_img,$thumb_img,160,220)){
	echo '生成缩略图失败';
	exit;
}
$data['thumb_img']=str_replace(ROOT,'',$thumb_img);


if($goods_id=$goods->add($data)){
	echo '商品发布成功';
}else{
	echo '商品发布失败';
}

