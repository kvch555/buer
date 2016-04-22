<?php
/****
燕十八 公益PHP讲堂

论  坛: http://www.zixue.it
微  博: http://weibo.com/Yshiba
YY频道: 88354001
****/


defined('ACC')||exit('ACC DENNIE');
// 递归转义数组
function _addslashes($arr) {
    foreach($arr as $k=>$v) {
        if(is_string($v)) {
            $arr[$k] = addslashes($v);
        } else if(is_array($v)) {  // 再加判断,如果是数组,调用自身,再转
            $arr[$k] = _addslashes($v);
        }
    }
    
    return $arr;
}

//方便打印
function dump($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

/*截取长度*/
function mstrlen($str,$len=10){
    if(strlen($str)>$len){
        $str=mb_substr($str,0,$len,'UTF8').".....";
    }
    return $str;
}