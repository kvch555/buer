<?php
/****
燕十八 公益PHP讲堂

论  坛: http://www.zixue.it
微  博: http://weibo.com/Yshiba
YY频道: 88354001
****/


/***
====笔记部分====
购物流程页面
商城的核心功能
***/

define('ACC',true);
require('./include/init.php');

//设置一个动作参数，判断用户想干什么，比如是下订单/写地址/提交/清空购物车等
$act=isset($_GET['act'])?$_GET['act']:'buy';
$goods=new GoodsModel();

$cart=CartTool::getCart();	//获取购物车实例

if($act=='buy'){ //把商品加到购物车
	$goods_id=isset($_GET['goods_id'])?$_GET['goods_id']+0:0;
	$num=isset($_GET['num'])?$_GET['num']+0:1;
	if($goods_id){	//$goods_id为真，是想把商品放到购物车里
		$g=$goods->find($goods_id);
		if(!empty($g)){		//有此商品
			//需判断此商品，是否在回收站
			//此商品是否已下架
			if($g['is_delete']==1 || $g['is_on_sale']==0){
				$msg='此商品不能购买';
				include(ROOT.'view/front/msg.html');
				exit;
			}

			//先把商品加到购物车
			$cart->addItem($goods_id,$g['goods_name'],$g['shop_price'],$num);

			//判断库存够不够
			$items=$cart->all();

			if($items[$goods_id]['num'] > $g['goods_number']){
				//库存不够了，把刚才加到购物车的动作撤回
				$cart->decNum($goods_id,$num);

				$msg='库存不足';
				include(ROOT.'view/front/msg.html');
				exit;
			}
		}
	}

	$items=$cart->all();

	if(empty($items)){		//如果购物车为空，返回首页
		header('location: index.php');
		exit;
	}

	//把购物车里的商品详细信息取出来
	$items=$goods->getCartGoods($items);

	$total=$cart->getPrice();   //获取购物车中的商品总价格
	$market_total=0.0;

	foreach($items as $v){
		$market_total += $v['market_price'] * $v['num'];
	}

	$discount=$market_total-$total;

	$rate=round(($discount/$total)*100,2);

	include(ROOT.'view/front/jiesuan.html');
}else if($act=='clear'){
	$cart->clear();
	$msg='购物车已清空';
	include(ROOT.'view/front/msg.html');
	exit;
}else if($act=='tijiao'){
	$items=$cart->all();	//取出购物车中的商品

	//把购物车里的商品详细信息取出来
	$items=$goods->getCartGoods($items);

	$total=$cart->getPrice();   //获取购物车中的商品总价格
	$market_total=0.0;

	foreach($items as $v){
		$market_total += $v['market_price'] * $v['num'];
	}

	$discount=$market_total-$total;

	$rate=round(($discount/$total)*100,2);

	include(ROOT.'view/front/tijiao.html');
}else if($act=='done'){
	/*
	订单入库，最重要一个环节

	从表单读取送货地址，手机等信息
	从购物车读取总价格信息，
	写入orderinfo表
	*/
	$OI=new OIModel();
	if(!$OI->_validate($_POST)){	//如果数据检验没通过，报错退出
		$msg=implode(',',$OI->getErr());
		include(ROOT.'view/front/msg.html');
		exit;
	}

	//自动过滤
	$data=$OI->_facade($_POST);

	//自动填充
	$data=$OI->_autoFill($data);

	//写入总金额
	$data['order_amount']=$cart->getPrice();

	//写入用户名，从session读
	$data['user_id']=isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	$data['username']=isset($_SESSION['username'])?$_SESSION['username']:'匿名';

	//写入订单号
	$data['order_sn']=$OI->orderSn();
	$order_sn=$data['order_sn'];

	if(!$OI->add($data)){
		$msg='下订单失败';
		include(ROOT.'view/front/msg.html');
		exit;
	}

	//echo '订单写入成功';

	/*
	把订单的商品写入数据库
	1个订单里有N个商品，我们可以循环写入ordergoods表
	*/
	$items=$cart->all(); //返回订单中所有的商品

	foreach ($items as $k=>$v) {
		/*og_id
order_id
order_sn
goods_id
goods_name
goods_number
shop_price
subtotal*/
		$data=array();
		$data['order_sn']=$order_sn;
		$data['goods_id']=$k;
		$data['goods_name']=$v['name'];
		$data['goods_number']=$v['num'];
		$data['shop_price']=$v['price']*$v['num'];
	}

	//把商品的数量也要减少	

	//清空购物车
}
?>