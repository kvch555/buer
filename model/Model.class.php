<?php
class Model{
	protected $table=NULL;
	protected $db=NULL;
	protected $pk='';
	protected $fields=array();
	protected $_auto=array();
	protected $_valid=array();
	protected $error=array();

	public function __construct(){
		$this->db=mysql::getIns();
	}

	public function table($table){
		$this->table=$table;
	}

	/*在model父类里，写最基本的增删改查操作
	param $id
	return bool
	*/
	public function add($data){
		return $this->db->autoExecute($this->table,$data);
	}

	/*param $id
	return int 影响的行数*/
	public function delete($id){
		$sql="delete from $this->table where $this->pk=$id";
		if($this->db->query($sql)){
			return $this->db->affected_rows();
		}else{
			return false;
		}
	}

	/*param array $data
	param int $id
	return int 影响行数*/
	public function update($data,$id){
		$rs=$this->db->autoExecute($this->table,$data,'update'," where $this->pk=$id");
		if($rs){
			return $this->db->affected_rows();
		}else{
			return false;
		}
	}

	/*return array*/
	public function select(){
		$sql="select * from $this->table";
		return $this->db->getAll($sql);
	}

	/*param $id
	return array*/
	public function find($id){
		$sql="select * from $this->table where $this->pk=$id";
		return $this->db->getRow($sql);
	}

	//自动过滤
	public function _facade($array=array()){
		$data=array();
		foreach($array as $k=>$v){
			if(in_array($k,$this->fields)){
				$data[$k]=$v;
			}
		}

		return $data;
	}

	//自动填充
	public function _autoFill($data){
		foreach($this->_auto as $k=>$v){
			if(!array_key_exists($v[0],$data)){
				switch ($v[1]) {
					case 'value':
						$data[$v[0]]=$v[2];
						break;
					case 'function':
						$data[$v[0]]=call_user_func($v[2]);
						break;
				}
			}
		}

		return $data;
	}

	/*
	规则: 1:必检字段
		  0:有字段检，无此字段则不检，如性别，没有，不检，有必是男女之一、
		  2:如有且内容不空，则检查，如签名档，非空，则检查长度
	格式	$this->_valid=array(
						array('验证的字段名',0/1/2(验证场景),'报错提示',required/in(某几种情况)/betweeen(范围)/length(某个范围)')
						);	

			例子:$_valid=array(
						array('goods_name',1,'必须有商品名','require'),
						array('cat_id',1,'必须是整型值','number'),
						array('is_new',0,'in_new只能是0或1','in','0,1'),
						array('goods_brief',2,'商品简介应在10到100字符','length','10,100'),
						);

	*/
	public function _validate($data){
		if(empty($this->_valid)){
			return true;
		}

		$this->error=array();

		foreach($this->_valid as $k=>$v){
			switch($v[1]){
				case 1:
					if(!isset($data[$v[0]])){
						$this->error[]=$v[2];
						return false;
					}

					if(!isset($v[4])){
						$v[4]='';
					}

					if(!$this->check($data[$v[0]],$v[3],$v[4])){
						$this->error[]=$v[2];
						return false;
					}
					break;
				case 0:
					if(isset($data[$v[0]])){
						if(!$this->check($data[$v[0]],$v[3],$v[4])){
							$this->error[]=$v[2];
							return false;
						}
					}
					break;
				case 2:
					if(isset($data[$v[0]])&&!empty($data[$v[0]])){
						if(!$this->check($data[$v[0]],$v[3],$v[4])){
							$this->error[]=$v[2];
							return false;
						}
					} 
					break;
			}
		}

		return true;
	}

	protected function check($value,$rule='',$param=''){
		switch ($rule) {
			case 'require':
				return !empty($value);
				break;	
			case 'number':
				return is_numeric($value);
				break;		
			case 'in':
				$tmp=explode(',',$param);
				return in_array($value,$tmp);
				break;
			case 'between':
				list($min,$max)=explode(',',$param);
				return $value>=$min && $value<=$max;
				break;
			case 'length':
				list($min,$max)=explode(',',$param);
				return mb_strlen($value,'GBK')>=$min && mb_strlen($value,'GBK')<=$max;
				break;
			case 'email':
				return (filter_var($value,FILTER_VALIDATE_EMAIL)!==false);
				break;
			default:
				return false;
				break;
		}
	}

	public function getErr(){
		return $this->error;
	}

	public function insert_id(){
		return $this->db->insert_id();
	}

}
?>