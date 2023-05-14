<?php
class connect
{
	var $db=null;
	public function __construct() 
	{
		$dsn='mysql:host=localhost;dbname=quanlithucpham';
		$user='root';
		$pass='';
		$this->db=new PDO($dsn,$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
	}
//	https://megacode.vn/files/view/php-phuong-thuc-getinstance-la-gi-va-tai-sao-dung-getinstance-4922.html
//	lấy đúng 1 ID nên lấy fetch vô luôn
	public function getInstance($select)
	{
		$results=$this->db->query($select);
		$result=$results->fetch();
		return $result;
	}
	
//	Lấy nhiều rows
	public function getList($select)
	{
		$results=$this->db->query($select);
		return($results);
	}
	public function exec($query)
	{
		$results=$this->db->exec($query);
		return($results);
	}
	
}
?>

