<?php
define('ACC',true);
require('../include/init.php');
$cate=new CateModel();
$rs=$cate->select();
$rs=$cate->GetCatTree($rs,0);
include(ROOT.'/view/admin/templates/cateadd.html');
?>