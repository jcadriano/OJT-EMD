<!DOCTYPE html>
<html>
<head>
	<title> EX Armature Records </title>
	<meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <script src="../jquery/jquery-3.3.1.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">	
    <script src="../jquery/bootstrap.js"></script>									
    <!-- <script src="../jquery/jquery-3.3.7.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="../css/assyTrial.css">
    <script src="../jquery/sweetalert.js"></script>

</head>
<body>

	<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->




	<?php 
        //define root folder
        // $root = ($_SERVER['DOCUMENT_ROOT']);
        //call header page
        // include($root.'/developmental/jc/Lot History System TRIAL/global/header_page.php');

		$hostname = 'TS0B175';        			// Your MySQL hostname. Usualy named as 'localhost', so you're NOT necessary to change this even this script has already online on the internet.
		$dbname   = 'LotHistorySystem';				// Your database name.
		$username = 'sa';             			// Your database username.
		$password = '1tgr0up';               	// Your database password. If your database has no password, leave it empty.

		// Let's connect to host
		mssql_connect($hostname, $username, $password) or DIE('Connection to host failed, perhaps the service is down!');				// Your database name.
		mssql_select_db($dbname) or DIE('Database name is not available!');

		$selected_date = $_POST['selected_date'];
		echo "<h1>"  . $selected_date . "</h1>";

		$sql = mssql_query("SELECT * FROM assembly_armatureassy_tbl WHERE CONCAT(month, '/' , year) = '$selected_date';") or die ("<h1> HAHAHA </h1>");

		echo "<table class='sheet'>";

		echo "<thead>";
		echo "<tr>";
			echo "<th rowspan='2'> Date </th>";
			echo "<th rowspan='2'> Operator Name </th>";
			echo "<th rowspan='2'> Shift </th>";
			echo "<th colspan='3'> Output </th>";
			echo "<th colspan='7'> Supplied Materials </th>";
			echo "<th rowspan='2'> Action </th>";
		echo "</tr>";
		echo "<tr>";
			// Under Output
			echo "<th> Relay Type </th>";
			echo "<th> Lot No. </th>";
			echo "<th> Quantity </th>";

			// Under Supplied Materials
			echo "<th> Arm. Lot No. </th>";
			echo "<th> Arm. Qty </th>";
			echo "<th> Mov. Contact Point Lot No. </th>";
			echo "<th> Mov. C.P Bag No. </th>";
			echo "<th> Mov. C.P Qty </th>";
			echo "<th> Contact Spring Lot No. </th>";
			echo "<th> C.S Qty </th>";
		echo "</tr>";
		echo "</thead>";

		echo "<tbody class='submittedRecord'>";

		$var = "btn";
		$ctr = 0;
		while ($res = mssql_fetch_array($sql)) {
			

			$id = $var . $ctr;
			// echo $id;

			$formatted_date = $res['date'];
			$operator_name = $res['operator_name'];
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

			echo  "<td>" . $split_arm_lotNum[0] . "</td>";
			echo  "<td class='smaller'>" . $split_arm_qty[0] . "</td>";
			echo  "<td>" . $split_mcp_lotNum[0] . "</td>";
			echo  "<td class='smaller'>" . $split_mcp_bagNum[0] . "</td>";
			echo  "<td class='smaller'>" . $split_mcp_qty[0] . "</td>";
			echo  "<td>" . $split_cs_lotNum[0] . "</td>";
			echo  "<td class='smaller'>" . $split_cs_qty[0] . "</td>";
	?>
			<td rowspan='<?php echo $max; ?>'> <button class='formBtn btn btn-primary' type='button' data-toggle='modal' data-target='#<?php echo $id;?>'> Edit <?php echo $ctr; ?> </button> </td>

			<?php
			echo "</tr>";
	     
			for ($i=1; $i <= $max-1; $i++) { 
				echo "<tr class='query'>";
				echo  "<td>" . $split_arm_lotNum[$i] . "</td>";
				echo  "<td class='smaller'>" . $split_arm_qty[$i] . "</td>";
				echo  "<td>" . $split_mcp_lotNum[$i] . "</td>";
				echo  "<td class='smaller'>" . $split_mcp_bagNum[$i] . "</td>";
				echo  "<td class='smaller'>" . $split_mcp_qty[$i] . "</td>";
				echo  "<td>" . $split_cs_lotNum[$i] . "</td>";
				echo  "<td class='smaller'>" . $split_cs_qty[$i] . "</td>";
				echo "</tr>";

				

				if ($i == $max) {
					echo "</tr>";
				}
			}

			$ctr++;  

			// FOR MODAL
			echo "<div class='modal fade' id='$id' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
			  echo "<div class='modal-dialog' role='document'>";
			    echo "<div class='modal-content'>";
			      echo "<div class='modal-header'>";
			        echo "<h5 class='modal-title' id='exampleModalLabel'> Edit Record </h5>";
			        echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
			          echo "<span aria-hidden='true'>&times;</span>";
			        echo "</button>";
			      echo "</div>";
			      echo "<div class='modal-body'>";
			       echo " <form>";
			        	
			        		$query_row = mssql_query("SELECT * FROM assembly_armatureassy_tbl WHERE id = '$ctr';");

			        		while ($row_result = mssql_fetch_array($query_row)) {
			        			echo $row_result['operator_name'];
			        		}
			        	
			        echo "</form>";
			      echo "</div>";
			     echo " <div class='modal-footer'>";
			        echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
			        echo "<button type='button' class='btn btn-primary'> Save changes </button>";
			      echo "</div>";
			    echo "</div>";
			  echo "</div>";
			echo "</div>";



		}
		echo "</tr> </tbody> </table>";



	?>



</body>
</html>