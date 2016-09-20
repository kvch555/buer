<?php
class UserModel extends Model{
	protected $table='orderinfo';
	protected $pk='order_id';
	protected $fields=array('order_id','order_sn','user_id','username','zone','address','zipcode','reciver','email','tel','mobile','building','best_time','add_time','order_amount','pay');

	//自动填充
	protected $_auto=array(
							array('add_time','function','time')
						);

	//自动验证
	protected $_valid=array(
						array('reciver',1,'收货人不能为空','require',''),
						array('email',1,'email非法','email',''),
						array('payment',1,'必须先支付方式','in','4,5')  //代表在线支付与到付
						);

}



?>