<?php
include "config.php";



echo "<h3>CHECK EXIST</h3><br>";
//select username,password where username='$username' and password='$password'
//return true if exist
//case login system 
$data=array(
  'username'=>$_POST['username'],
	'password'=>md5($_POST['password'])
			);
$s=$db->checkExist('admin',$data);
if ($s==true) {
	echo "good";
} else {
	echo "bad";
}
echo "<p>";


echo "<p>";
echo "<h3>fetch all</h3><br>";
//select * from admin
$rs=$db->fetchAll('admin');
foreach ($rs as $key) {
	echo $key->username.":".$key->password."<br>";
}

echo "<p>";
echo "<h3>select single row</h3><br>";
//only return one row
//select * from admin where id_user=4
$rs=$db->fetchSingleRow('admin','id_user',4);
echo $rs->username;



echo "<p>";
echo "<h3>select search data</h3><br>";
//search data 
//select username,password from admin where username like %wild%
$find=$db->search('admin',array('username','password'),array('username'=>'wild'));
foreach ($find as $key) {
	echo $key->username;
}

echo "<p>";
echo "<h3>CUSTOM QUERY</h3>";
//custom query 
$vr=array('name'=>'wildan');
$custom=$db->query("select * from admin where username=?",$vr);
foreach ($custom as $key) {
	echo $key->username;
}
echo "<p>";
//join table
$qr="select admin.*,level.* from admin inner join level on admin.level=level.id_level and admin.level=?";
$cust=$db->query($qr,array('admin.level'=>2));
foreach ($cust as $key) {
	echo $key->username.":".$key->name_level;
}

$qr="select admin.*,level.* from admin inner join level on admin.level=level.id_level";
$cust=$db->query($qr);
foreach ($cust as $key) {
	echo $key->username.":".$key->name_level;
}
?>
