<?php
/**
 * 永久数据被踢现象
 */

$mem = new  memcache();
$mem->connect("127.0.0.1",11211) or die ("Could not connect");
//$mem->set("ceshi","this is a test",0,0);
//$mem->add("ceshi2","this is the second test",0,10);
$val = $mem->get("ceshi");
$val2 = $mem->get("ceshi2");
echo $val."--".$val2.'<br/>';
//删除数据
$mem->delete("ceshi");
echo $mem->get("ceshi");

//保存数组
$arr = array('aaa', 'bbb', 'ccc', 'ddd');
$mem->set('arr', $arr, 0, 60);
$arr2 = $mem->get('arr');
echo "Get arr2 value: ";
print_r($arr2);
echo "<br />";
