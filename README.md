PHP pdo mysql helper class  
==========================




Usage
=====
	Make sure you've change the configuration file config.php. 
	Include config.php to your php code

	SELECT
	======

		**standard query**
		//this will get all records with username wildan
        <$vr=array('username'=>'wildan');
			$custom=$db->fetch_custom("select * from admin where username=?",$vr);
			foreach ($custom as $key) {
				echo $key->username; //print username column
			}/>
		**join 2 table**
			< $qr="select admin.*,level.* from admin inner join level on admin.level=level.id_level";
			$cust=$db->fetch_custom($qr);
			foreach ($cust as $key) {
				echo $key->username.":".$key->name_level; 
			}/>
		**join 2 with condition table**
			< $qr="select admin.*,level.* from admin inner join level on admin.level=level.id_level and admin.level=?";
			$cust=$db->fetch_custom($qr,array('admin.level'=>2));
			foreach ($cust as $key) {
				echo $key->username.":".$key->name_level; //print username column and levelname
			}/>
		**fetch all record**
		<   //equal to select * from admin
			$rs=$db->fetch_all('admin');
			foreach ($rs as $key) {
				echo $key->username.":".$key->password."<br>";
			}/>
	
