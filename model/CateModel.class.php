<?php
class CateModel extends Model{

	protected $table='category';

	public function add($data){
		return $this->db->autoExecute($this->table,$data);
	}

	public function select(){
		return $this->db->getAll("select cat_id,cat_name,parent_id from $this->table");
	}

	public function find($cat_id){
		$sql="select * from $this->table where cat_id=$cat_id";
		return $this->db->getRow($sql);
	}

	/*getCatTree
	parm:array $arr,int $id
	return $id栏目的子孙数*/
	public function GetCatTree($arr,$id=0,$lev=0){
		$tree=array();

		foreach($arr as $k=>$v){
			if($v['parent_id']==$id){
				$v['lev']=$lev;
				$tree[]=$v;
				$tree=array_merge($tree,$this->getCatTree($arr,$v['cat_id'],$lev+1));
			}
		}
		return $tree;
	}

	/*param:int $id
	return $id栏目下的子栏目*/
	public function getSon($id){
		$sql="select cat_id,cat_name,parent_id from $this->table where parent_id=$id";
		return $this->db->getRow($sql);
	}

	/*	param int $id
		return array $id栏目的家谱树*/
	public function getTree($id=0){
		$tree=array();
		$cats=$this->select();

		while($id>0){
			foreach ($cats as $v) {
				if($v['cat_id']==$id){
					$tree[]=$v;
					$id=$v['parent_id'];
					break;
				}
			}
		}		

		return array_reverse($tree);
	}

	public function delete($cat_id){
		$sql="delete from $this->table where cat_id=$cat_id";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function update($data,$cat_id=0){
		$this->db->autoExecute($this->table,$data,'update'," where cat_id=$cat_id");
		return $this->db->affected_rows();
	} 
}
?>