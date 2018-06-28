<?php
	$dbname = 'LotHistorySystem';				// Your database name.
	mssql_select_db($dbname) or DIE('Database name is not available!');

	/**
	 * Gets all the needed data and prints it on the web page.
	 * Array elements are separated with an asterisk '*' to separate the values.
	 */

	$line_no = $_POST['line_no'];
	$processSwitch = $_POST['process'];

	// echo "===> " . $processSwitch . " <=== <br>";

	switch ($processSwitch) {
		case 'Armature Assembly':
			$armArray = $_POST['arm_lotNum'];
			$armQtyArray = $_POST['arm_qty'];

			$mcpArray = $_POST['mcp_lotNum'];
			$mcpBagArray = $_POST['mcp_bagNum'];
			$mcpQtyArray = $_POST['mcp_qty'];

			$csArray = $_POST['cs_lotNum'];
			$csQtyArray = $_POST['cs_qty'];

			$date = $_POST['date'];
			$month = $_POST['month'];
			$year = $_POST['year'];
			$optr_name = $_POST['optr_name'];
			$shift = $_POST['shift'];
			$relay_id = $_POST['relay_type'];
			$lot_no = $_POST['lotNum'];
			$qty = $_POST['quantity'];

			$arm_value = implode("*", $armArray);
			$armQty_value = implode("*", $armQtyArray);
			$mcp_value = implode("*", $mcpArray);
			$mcpBag_value = implode("*", $mcpBagArray);
			$mcpQty_value = implode("*", $mcpQtyArray);
			$cs_value = implode("*", $csArray);
			$csQty_value = implode("*", $csQtyArray);


			$insert_toDB =  "INSERT INTO assembly_armatureassy_tbl (relay_id, line_no, month, year, date, operator_name, shift, lot_number, quantity, supplied_armature, armature_qty, supplied_contact_point, cp_bag_number, cp_quantity, supplied_contact_spring, contact_spring_quantity) VALUES ('$relay_id', '$line_no', '$month', '$year', '$date', '$optr_name', '$shift', '$lot_no', '$qty', '$arm_value', '$armQty_value', '$mcp_value', '$mcpBag_value', '$mcpQty_value', '$cs_value', '$csQty_value')"; 

			mssql_query($insert_toDB) or die ("<script> swal ('Oops..', 'Something went wrong. Please contact the IT Group.', 'error') </script>");

			break;
		
		case 'M&A Assembly':
			$coilArray = $_POST['coil_lotNum'];
			$yokeArray = $_POST['yoke_lotNum'];
			$coreArray = $_POST['core_lotNum'];
			$armAssyArray = $_POST['armAssy_lotNum'];

			echo "M&A Machine No.: " . $_POST['machine_no'] . "<br>";
			echo "Manual No.: " . $_POST['manual_no'] . "<br>";
			echo "Date: " . $_POST['date'] . "<br>";
			echo "Name: " . $_POST['optr_name'] . "<br>";
			echo "Shift: " . $_POST['shift'] . "<br>";
			echo "Relay Type: " . $_POST['relay_type'] . "<br>";
			echo "Lot No.: " . $_POST['lotNum'] . "<br>";
			echo "Qty: " . $_POST['quantity'] . "<br>";

			echo "Coil No.:";
			$coil_value = implode("*", $coilArray);
			echo $coil_value;

			echo "<br> Yoke No.:";
			$yoke_value = implode("*", $yokeArray);
			echo $yoke_value;

			echo "<br> Core No.:";
			$core_value = implode("*", $coreArray);
			echo $core_value;

			echo "<br> Arm Assy No.:";
			$armAssy_value = implode("*", $armAssyArray);
			echo $armAssy_value;

			break;

		case 'ST Break Terminal Assembly':
			$stBreakArray = $_POST['stBreak_lotNum'];
			$stBreakQtyArray = $_POST['stBreak_qty'];
			$bcpArray = $_POST['bcp_lotNum'];
			$bcpBagArray = $_POST['bcp_bagNum'];
			$bcpQtyArray = $_POST['bcp_qty'];

			echo "Date: " . $_POST['date'] . "<br>";
			echo "Name: " . $_POST['optr_name'] . "<br>";
			echo "Shift: " . $_POST['shift'] . "<br>";
			echo "Relay Type: " . $_POST['relay_type'] . "<br>";
			echo "Lot No.: " . $_POST['lotNum'] . "<br>";
			echo "Qty: " . $_POST['quantity'] . "<br>";

			echo "ST Terminal Break No.:";
			$stBreak_value = implode("*", $stBreakArray);
			echo $stBreak_value;

			echo "<br> ST Terminal Qty:";
			$stBreakQty_value = implode("*", $stBreakQtyArray);
			echo $stBreakQty_value;

			echo "<br> Break CP Lot No.:";
			$bcp_value = implode("*", $bcpArray);
			echo $bcp_value;

			echo "<br> Break CP Bag No.:";
			$bcpBag_value = implode("*", $bcpBagArray);
			echo $bcpBag_value;

			echo "<br> Break CP Qty:";
			$bcpQty_value = implode("*", $bcpQtyArray);
			echo $bcpQty_value;
			
			break;

		case 'ST Make Terminal Assembly':
			$stMakeArray = $_POST['stMake_lotNum'];
			$stMakeQtyArray = $_POST['stMake_qty'];
			$movecpArray = $_POST['movecp_lotNum'];
			$movecpBagArray = $_POST['movecp_bagNum'];
			$movecpQtyArray = $_POST['movecp_qty'];

			echo "Date: " . $_POST['date'] . "<br>";
			echo "Name: " . $_POST['optr_name'] . "<br>";
			echo "Shift: " . $_POST['shift'] . "<br>";
			echo "Relay Type: " . $_POST['relay_type'] . "<br>";
			echo "Lot No.: " . $_POST['lotNum'] . "<br>";
			echo "Qty: " . $_POST['quantity'] . "<br>";

			echo "ST Terminal Make No.:";
			$stMake_value = implode("*", $stMakeArray);
			echo $stMake_value;

			echo "<br> ST Terminal Qty:";
			$stMakeQty_value = implode("*", $stMakeQtyArray);
			echo $stMakeQty_value;

			echo "<br> Make CP Lot No.:";
			$movecp_value = implode("*", $movecpArray);
			echo $movecp_value;

			echo "<br> Make CP Bag No.:";
			$movecpBag_value = implode("*", $movecpBagArray);
			echo $movecpBag_value;

			echo "<br> Make CP Qty:";
			$movecpQty_value = implode("*", $movecpQtyArray);
			echo $movecpQty_value;

			break;

		case 'ST Base Assembly':
			$baseLotArray = $_POST['base_lotNum'];
			$baseQtyArray = $_POST['base_qty'];

			echo "Machine No.: " . $_POST['machine_no'] . "<br>";
			echo "Date: " . $_POST['date'] . "<br>";
			echo "Name: " . $_POST['optr_name'] . "<br>";
			echo "Shift: " . $_POST['shift'] . "<br>";
			echo "ST Make Ass'y Lot #: " . $_POST['sma_lotNum'] . "<br>";
			echo "ST Make Ass'y Type: " . $_POST['sma_type'] . "<br>";
			echo "ST Make Ass'y Qty: " . $_POST['sma_quantity'] . "<br>";

			echo "ST Break Ass'y Lot #: " . $_POST['sba_lotNum'] . "<br>";
			echo "ST Break Ass'y Type: " . $_POST['sba_type'] . "<br>";
			echo "ST Break Ass'y Qty: " . $_POST['sba_quantity'] . "<br>";

			echo "ST Base Lot:";
			$baseLot_value = implode("*", $baseLotArray);
			echo $baseLot_value;

			echo "<br> ST Base Qty:";
			$baseQty_value = implode("*", $baseQtyArray);
			echo $baseQty_value;

			break; 

		default:
			echo "GG sir";
			break;
	}
	
?>