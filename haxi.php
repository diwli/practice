<?php
header("Content-type:text/html;Charset = utf-8");	
/**
* 一致性hash的php实现
*/

// 需要一个将字符串转换为整数的功能
interface hash{
	function _hash($str);
}
interface distribution{
	function lookup($key);
}

class Consistent implements hash,distribution{
	protected $_nodes = array();
	public function _hash($str){
		return sprintf("%u",crc32($str));   //以整数值返回字符串的 32 位循环冗余校验码多项式。
	}
	public function lookup($key){
		$point = $this->_hash($key);
		$node = current($this->_nodes);
		foreach ($this->_nodes as $key => $value) {
			if($point <= $key){
				$node = $value;
				break;
			}
		}
		return $node;
	}

	public function addNode($node){
		$this->_nodes[$this->_hash($node)] =  $node;		
	}

	public function sortNode(){
		ksort($this->_nodes);
		echo "所有服务器如下：<br/>";
		print_r($this->_nodes);
	}
}

$con = new Consistent();
$con->addNode("A");
$con->addNode("B");
$con->addNode("C");
$con->sortNode();
echo "当前键计算的hash落点是".$con->_hash("name")."<br/>";
echo $con->lookup('name');
