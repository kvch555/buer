<?php
class GoodsModel extends Model{

	protected $table="goods";
	protected $pk='goods_id';
	protected $fields=array('goods_id','goods_sn','cat_id',
'brand_id','goods_name','shop_price','market_price','goods_number','click_count','goods_weight','goods_brief','goods_desc','thumb_img','goods_img','ori_img','is_on_sale','is_delete','is_best','is_new','is_hot','add_time','last_update'
);

	//自动填充
	protected $_auto=array(
							array('is_hot','value',0),
							array('is_new','value',0),
							array('is_best','value',0),
							array('add_time','function','time')
						);

	//自动验证
	protected $_valid=array(
						array('goods_name',1,'必须有商品名','require',''),
						array('cat_id',1,'必须是整型值','number',''),
						array('is_new',0,'in_new只能是0或1','in','0,1'),
						array('goods_brief',2,'商品简介应在10到100字符','length','10,100')
						);

	/*
	更新回收站
	param int id
	return bool*/
	public function trash($id){
		return $this->update(array('is_delete'=>1),$id);
	}

	//显示商品
	public function getGoods(){
		$sql="select * from $this->table where is_delete=0";
		return $this->db->getAll($sql);
	}

	//显示回收站商品
	public function getTrash(){
		$sql="select * from $this->table where is_delete=1";
		return $this->db->getAll($sql);
	}

	//创建商品的货号
	public function createSn(){
		$sn='BL'.date('Ymd').mt_rand(10000,99999);
		$sql="select count(*) from $this->table where goods_sn='$sn'";
		return $this->db->getOne($sql)?$this->createSn():$sn;
	}

	/*取出指定条数的新品*/
	public function getNew($n=5){
		$sql="select goods_id,goods_name,shop_price,thumb_img,market_price from {$this->table} order by add_time limit {$n}";

		return $this->db->getAll($sql);
	}

	/*
	取出指定栏目的商品
	找出$cat_id的所有子孙栏目，
	查所有$cat_id及其子孙栏目下的商品	
	*/
	public function catGoods($cat_id,$offset=0,$limit=5){
		$category= new CateModel();
		$cats=$category->select();	//取出所有栏目
		$sons=$category->GetCatTree($cats,$cat_id);	//取出给定栏目的子孙栏目

		$sub=array($cat_id);

		if(!empty($sons)){
			foreach ($sons as $k => $v){
				$sub[]=$v['cat_id'];
			}
		}

		$in=implode(',',$sub);

		$sql="select goods_id,goods_name,shop_price,thumb_img,market_price from {$this->table} where cat_id in ({$in}) order by add_time limit {$offset},{$limit}";
		
		return $this->db->getAll($sql);
	}

	/*
	获取购物车商品的详细信息
	param array $items  购物车中的商品数组
	return 商品数组的详细信息
	*/
	public function getCartGoods($items){
		foreach($items as $k=>$v){		//循环购物车中的商品，每循环一个，到数据查一下对应的详细信息
			$sql="select goods_id,goods_name,thumb_img,shop_price,market_price from {$this->table} where goods_id ='{$k}'";
			$row=$this->db->getRow($sql);

			$items[$k]['thumb_img']=$row['thumb_img'];
			$items[$k]['market_price']=$row['market_price'];
		}

		return $items; 
	}

}
?>