<?php
	$$hostname = 'TS0B175';        			// MySQL hostname. 
	$dbname   = 'LotHistorySystem';			// Database name.
	$username = 'sa';             			// Database username.
	$password = '1tgr0up';               	// Database password. If your database has no password, leave it empty.

	// Connect to host
	mssql_connect($hostname, $username, $password) or DIE('Connection to host failed, perhaps the service is down!');
	mssql_select_db($dbname) or DIE('Database name is not available!');

	$processNew = $_POST['process'];

	

	switch ($processNew) {
		case 'Armature Assembly':
			$update_relayType = $_POST['relay_typeNew'];
			$armArray = $_POST['arm_lotNumNew'];
			$arm_value = $_POST['arm_value'];
			$armQtyArray= $_POST['arm_qtyNew'];

			$update_arm_qtyNew = implode("*", $armQtyArray);
			$update_arm_lotNumNew = implode("*", $armArray);
			// echo $update_relayType;
			$update_lotNum = $_POST['lot_numberNew'];

			$updateDB = "UPDATE assembly_armatureassy_tbl SET relay_id = '$update_relayType', supplied_armature = '$update_arm_lotNumNew',armature_qty = '$update_arm_qtyNew' WHERE lot_number = '$update_lotNum'; ";
			mssql_query($updateDB) or die ("<script> swal ('Oops..', 'Something went wrong. Please contact the IT Group.', 'error') </script>");
			// echo $updateDB;
			break;
		
		default:
			echo "<h1> :( </h1>";
			break;
	}
?>