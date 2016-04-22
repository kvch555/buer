<?php
define('ACC',true);
require('./include/init.php');

//取出5条新品
$goods=new GoodsModel();
$newlist=$goods->getNew(5);

//取出指定栏目的商品

//女士大栏目下的商品
$female_id=4;
$fe_list=$goods->catGoods($female_id);

include(ROOT .'/view/front/index.html');

?>