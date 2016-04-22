<?php
define('ACC',true);
require('../include/init.php');
$cat_id=$_GET['cat_id']+0;

$cate=new CateModel();
$rs=$cate->find($cat_id);
$rs_all=$cate->select();
$rs_all=$cate->GetCatTree($rs_all,0);
include(ROOT.'/view/admin/templates/catedit.html')

?>