<?php
defined('ACC')||exit('ACC Deined');

class UserModel extends Model{
	protected $table='user';
	protected $pk='user_id';
	protected $fields=array('user_id','username','email','passwd','regtime','lastlogin');


	//自动填充
	protected $_auto=array(
							array('regtime','function','time')
						);

	//自动验证
	protected $_valid=array(
						array('username',1,'请输入用户名','require',''),
						array('username',1,'用户必须在4-16字符内','length','4,16'),
						array('email',1,'email非法','email',''),
						array('passwd',1,'passwd不能为空','require','')
				
						);

	public function reg($data){
		if(!empty($data['passwd'])){
			$data['passwd']=$this->encPassword($data['passwd']);
		}

		return $this->add($data);
	}

	//加密密码md5
	protected function encPassword($p){
		return md5($p);
	}

	//根据用户名查询用户信息
	public function checkUser($username,$passwd=''){
		if($passwd==''){
			$sql="select count(*) from {$this->table} where username='{$username}'";
			return $this->db->getOne($sql);
		}else{
			$sql="select user_id,username,email,passwd from {$this->table} where username='{$username}'";
			$row=$this->db->getRow($sql);

			if(empty($row)){
				return false;
			}

			if($row['passwd']!=$this->encPassword($passwd)){
				return false;
			}
			unset($row['passwd']);
			return $row;
		}
		
	}

}

?>