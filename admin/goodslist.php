<?php
define('ACC',true);
require('../include/init.php');
$goods=new GoodsModel();
$goodlist=$goods->getGoods();
include(ROOT.'/view/admin/templates/goodslist.html');
?>