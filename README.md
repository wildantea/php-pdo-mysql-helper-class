PHP pdo mysql helper class
==========================


I add some codes to supports transaction.

roydu
2014-04-18


Usage
=====
	Make sure you've change the configuration file config.php.
	Include config.php to your php code

SELECT
------

**standard query**
```
//this will get all records with username wildan
$data=array('username'=>'wildan');
$custom=$db->query("select * from admin where username=?",$data);
	foreach ($custom as $key) {
		echo $key->username; //print username column
	}
```
**join 2 table**
```
//get all record from 2 tables with join
$qr="select admin.*,level.* from admin inner join level on admin.level=level.id_level";
$cust=$db->query($qr);
	foreach ($cust as $key) {
		echo $key->username.":".$key->name_level;
	}
```
**join 2 tables with condition**
```
//get all record with condition (admin.level=2)
$qr="select admin.*,level.* from admin inner join level on admin.level=level.id_level and admin.level=?";
$cust=$db->query($qr,array('admin.level'=>2));
	foreach ($cust as $key) {
		echo $key->username.":".$key->name_level; //print username column and levelname
	}
```
**Retrieving All Rows From A Table**
```
//equal to select * from admin
$rs=$db->fetchAll('admin');
	foreach ($rs as $key) {
		echo $key->username.":".$key->password."<br>";
	}
```
**Retrieving A Single Row From A Table**
```
//only return one row
//select * from admin where id_user=4
$rs=$db->fetchSingleRow('admin','id_user',4);
	echo $rs->username;
```
**CHECK EXIST**
```
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
	echo "wrong";
}
```
**Search Record**
```
1. search one cond
//search data
//select username,password from admin where username like %wild%
$find=$db->search('admin',array('username','password'),array('username'=>'wild'));
foreach ($find as $key) {
	echo $key->username;
}
2. search multi cond
//select username,password from admin where username like %wild% OR password LIKE %ad%
$find=$db->search('admin',array('username','password'),array('username'=>'wild','password'=>'ad'));
foreach ($find as $key) {
	echo $key->username;
}
```
INSERT
------
```
//equal to insert into admin (username,password,level) values('admin',md5('admin'),1)
$data=array('username'=>'admin',
	'password'=>md5('admin'),
	'level'=>1);
$db->insert('admin',$data);

```
INSERT Multipe array in one query
------
```
//insert multiple array data with single query
$level = array('Operator',"Front Staff");
foreach ($level as $lv) {
	$array_data[] = array(
		'name_level' => $lv
	);
}
$db->insertMulti('level',$array_data);


```
GET LAST INSERT ID
------
```
//equal to insert into admin (username,password,level) values('admin',md5('admin'),1)
$data=array('username'=>'admin',
	'password'=>md5('admin'),
	'level'=>1);
$db->insert('admin',$data);
$last_id = $db->getLastInsertId(); //this will get the last insert id from admin table

```

UPDATE
------
```
//equal to update admin set username='wildan',level=1 where id_user=1
$data=array('username'=>'wildan',
	'level'=>1);
$db->update('admin',$data,'id_user',1);

```
DELETE
------
```
//delete from admin where id_user=1
$db->delete('admin','id_user',1);
```


COMPLEX QUERY
------
```
//if you have complex query, you can use query. You can use custom query as complex as u want, and also absolutely with prepared statement for security reason. below is the sample how to use custom query.

//fetch data
$data = array('id'=>1,'level'=>1);
$db->query("select * from admin where id=? and level=?",$data);

//insert data,
$data=array('username'=>'admin',
	'password'=>md5('admin'),
	'level'=>1);
$db->query("insert into admin (username,password) values(?,?)",$data);


//custom query update data,
$data=array('username'=>'wildan',
	'level'=>2,
	'id'=>1);
$db->query("update admin set username=?,level=? where id=?",$data);

//delete data
$data=array('id'=>1);
$db->query("delete from admin where id=?",$data);

```

#### Developed By
----------------
 * wildantea - <wildannudin@gmail.com>
