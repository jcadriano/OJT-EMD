<?php
	$hostname = 'TS0B175';        			// Your MySQL hostname. Usualy named as 'localhost', so you're NOT necessary to change this even this script has already online on the internet.
	$dbname   = 'LotHistorySystem';				// Your database name.
	$username = 'sa';             			// Your database username.
	$password = '1tgr0up';               	// Your database password. If your database has no password, leave it empty.

	// Let's connect to host
	mssql_connect($hostname, $username, $password) or DIE('Connection to host failed, perhaps the service is down!');				// Your database name.
	mssql_select_db($dbname) or DIE('Database name is not available!');

	$sql = mssql_query("SELECT * FROM assembly_armatureassy_tbl;") or die ("<h1> HAHAHA </h1>");

	while ($res = mssql_fetch_array($sql)) {
		$formatted_date = $res['date'];
		$arm_lotNum = $res['supplied_armature'];
		$arm_qty = $res['armature_qty'];
		$mcp_lotNum = $res['supplied_contact_point'];
		$mcp_bagNum = $res['cp_bag_number'];
		$mcp_qty = $res['cp_quantity'];
		$cs_lotNum = $res['supplied_contact_spring'];
		$cs_qty = $res['contact_spring_quantity'];

		$split_arm_lotNum = explode('*', $arm_lotNum);
		$split_arm_qty = explode('*', $arm_qty);
		$split_mcp_lotNum = explode('*', $mcp_lotNum);
		$split_mcp_bagNum = explode('*', $mcp_bagNum);
		$split_mcp_qty = explode('*', $mcp_qty);
		$split_cs_lotNum = explode('*', $cs_lotNum);
		$split_cs_qty = explode('*', $cs_qty);

		$max = max(count($split_arm_lotNum), count($split_arm_qty), count($split_mcp_lotNum), count($split_mcp_bagNum), count($split_mcp_qty), count($split_cs_lotNum), count($split_cs_qty));
		// echo "<h1>" . $max . "</h1>";

		echo "<tr class='query'>";
		echo "<td rowspan='$max'><p>" . date("m-d-Y", strtotime($formatted_date)) . "</p></td>";
		echo "<td rowspan='$max'>" . $res['operator_name'] . "</td>";

		if ($res['shift'] == 'Day Shift') {
			echo "<td rowspan='$max' style='background-color: #FDDB54; color: #000000;'><p>" . $res['shift'] . "</p></td>";
		} else {
			echo "<td rowspan='$max' style='background-color: #000000; color: #FFFFFF;'>" . $res['shift'] . "</td>";
		}

		echo "<td rowspan='$max'>" . $res['relay_id'] . "</td>";
		echo "<td rowspan='$max'>" . $res['lot_number'] . "</td>";
		echo "<td rowspan='$max'>" . $res['quantity'] . "</td>";
     
		for ($i=0; $i <= $max-1; $i++) { 
			echo  "<td>" . $split_arm_lotNum[$i] . "</td>";
			echo  "<td>" . $split_arm_qty[$i] . "</td>";
			echo  "<td>" . $split_mcp_lotNum[$i] . "</td>";
			echo  "<td>" . $split_mcp_bagNum[$i] . "</td>";
			echo  "<td>" . $split_mcp_qty[$i] . "</td>";
			echo  "<td>" . $split_cs_lotNum[$i] . "</td>";
			echo  "<td>" . $split_cs_qty[$i] . "</td>";
			echo "</tr>";

			echo "<tr class='query'>";

			if ($i == $max) {
				echo "</tr>";
			}
		}
	}
?>