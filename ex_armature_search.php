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
    <link rel="stylesheet" type="text/css" href="../css/assyTrial.css">
    <script src="../jquery/sweetalert.js"></script>

</head>
<body>

	<?php 
        //define root folder
        // $root = ($_SERVER['DOCUMENT_ROOT']);
        //call header page
        // include($root.'/developmental/jc/Lot History System TRIAL/global/header_page.php');

		$hostname = 'TS0B175';        			// MySQL hostname. 
		$dbname   = 'LotHistorySystem';			// Database name.
		$username = 'sa';             			// Database username.
		$password = '1tgr0up';               	// Database password. If your database has no password, leave it empty.

		// Connect to host
		mssql_connect($hostname, $username, $password) or DIE('Connection to host failed, perhaps the service is down!');
		mssql_select_db($dbname) or DIE('Database name is not available!');

		$selected_date = $_POST['selected_date'];
		echo "<h1 style='text-align: center;'>"  . $selected_date . "</h1>";

		// Query for getting the search results, alert when something goes wrong 
		$sql = mssql_query("SELECT * FROM assembly_armatureassy_tbl WHERE CONCAT(month, '/' , year) = '$selected_date';") or die ("<script> swal ('Oops..', 'Something went wrong. Please contact the IT Group.', 'error') </script>");

		// Start of printing the table
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

		/** Sets the ID to return the correct values for the edit button. ID is set to var(btn)+ctr(0), e.g. btn0
		 *  The ctr (counter) increments for every iteration, ID then becomes btn1, btn2, etc...
		 */
		$var = "btn";
		$ctr = 0;

		while ($res = mssql_fetch_array($sql)) {
			$id = $var . $ctr;

			$formatted_date = $res['date'];
			$operator_name = $res['operator_name'];
			$relay_type = $res['relay_id'];
			$lot_number = $res['lot_number'];
			$quantity = $res['quantity'];

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

			// Gets the length (count) of the array values then gets the max length to know the value of the rowspan.
			$max = max(count($split_arm_lotNum), count($split_arm_qty), count($split_mcp_lotNum), count($split_mcp_bagNum), count($split_mcp_qty), count($split_cs_lotNum), count($split_cs_qty));

			echo "<tr class='query'>";
			echo "<td rowspan='$max'><p>" . date("m-d-Y", strtotime($formatted_date)) . "</p></td>";
			echo "<td rowspan='$max'>" . $operator_name . "</td>";

			if ($res['shift'] == 'Day Shift') {
				echo "<td rowspan='$max' style='background-color: #FDDB54; color: #000000;'><p>" . $res['shift'] . "</p></td>";
			} else {
				echo "<td rowspan='$max' style='background-color: #000000; color: #FFFFFF;'>" . $res['shift'] . "</td>";
			}

			echo "<td rowspan='$max'>" . $relay_type . "</td>";
			echo "<td rowspan='$max'>" . $lot_number . "</td>";
			echo "<td rowspan='$max'>" . $quantity . "</td>";

			echo  "<td>" . $split_arm_lotNum[0] . "</td>";
			echo  "<td class='smaller'>" . $split_arm_qty[0] . "</td>";
			echo  "<td>" . $split_mcp_lotNum[0] . "</td>";
			echo  "<td class='smaller'>" . $split_mcp_bagNum[0] . "</td>";
			echo  "<td class='smaller'>" . $split_mcp_qty[0] . "</td>";
			echo  "<td>" . $split_cs_lotNum[0] . "</td>";
			echo  "<td class='smaller'>" . $split_cs_qty[0] . "</td>";
	?>
			<td rowspan='<?php echo $max; ?>'> <button class='formBtn btn btn-primary' type='button' data-toggle='modal' data-target='#<?php echo $id; ?>'> Edit </button> </td>

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

				$ctr++; // Counter increments

				// ===================================================| MODAL |===================================================
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
					       		echo "<form id='save'>";

					       			// Query to show the database records that are for editing in a modal form, where the DB row lot number is equal to the input lot number.
					       			$query_row = mssql_query("SELECT * FROM assembly_armatureassy_tbl WHERE lot_number = '$lot_number'; ");

					        		while ($row_result = mssql_fetch_array($query_row)) {
					        			echo "<div class='form-group row'>";
					        				echo "<label for='operator_name' class='col-sm-4 col-form-label'> Operator Name: </label>";
					        				echo "<div class='col-sm-8'>";
					        					echo "<input class='form-control' type='text' name='operator_name' value='$operator_name' readonly='readonly'>";
					        				echo "</div>";
					        			echo "</div>";

					        			echo "<div class='form-group row'>";
					        				echo "<label for='relay_typeNew' class='col-sm-4 col-form-label'> Relay Type: </label>";
					        				echo "<div class='col-sm-8'>";
					        					echo "<input class='form-control' type='text' name='relay_typeNew' value='$relay_type'>";
					        				echo "</div>";
					        			echo "</div>";

					        			echo "<div class='form-group row'>";
					        				echo "<label for='lot_number' class='col-sm-4 col-form-label'> Lot Number: </label>";
					        				echo "<div class='col-sm-8'>";
					        					echo "<input class='form-control' type='text' name='lot_numberNew' value='$lot_number' readonly='readonly'>";
					        				echo "</div>";
					        			echo "</div>";
					        			
					        			echo "<div class='form-group row'>";
					        				echo "<label for='quantityNew' class='col-sm-4 col-form-label'> Quantity: </label>";
					        				echo "<div class='col-sm-8'>";
					        					echo "<input class='form-control' type='text' name='quantityNew' value='$quantity'>";
					        				echo "</div>";
					        			echo "</div>";

					        			
					        			echo "<div class='form-group row'>";
					        				echo "<label for='arm_lotNumNew' class='col-sm-3 col-form-label'> Armature Lot Number: </label>";
					        				echo "<div class='col-sm-1'>";
					        					echo "<button type='button' class='add btn btn-info btn-sm'> + </button>";
					        					echo "<button type='button' class='btn btn-danger btn-sm'>  -  </button>";
					        				echo "</div>";
					        				echo "<div class='col-sm-8'>";
					        			for ($i=0; $i < $max; $i++) {
					        				echo "<input class='form-control' type='text' name='arm_lotNumNew[]' value='$split_arm_lotNum[$i]'>";
					        			}
					        			echo "</div>";
					        			echo "</div>";

					        			echo "<div class='form-group row'>";
					        				echo "<label for='arm_qtyNew' class='col-sm-4 col-form-label'> Armature Quantity: </label>";
					        				echo "<div class='col-sm-8'>";
					        			for ($i=0; $i < $max; $i++) { 
					        				echo "<input class='form-control' type='text' name='arm_qtyNew[]' value='$split_arm_qty[$i]'>";
					        			}
					        			echo "</div>";
					        			echo "</div>"; 

					        			echo "<div class='form-group row'>";
					        				echo "<label for='mcp_lotNumNew' class='col-sm-4 col-form-label'> Movable Contact Point Lot Number: </label>";
					        				echo "<div class='col-sm-8'>";
					        			for ($i=0; $i < $max; $i++) { 
					        				echo "<input class='form-control' type='text' name='mcp_lotNumNew' value='$split_mcp_lotNum[$i]'>";
					        			}
					        			echo "</div>";
					        			echo "</div>"; 

					        			echo "<div class='form-group row'>";
					        				echo "<label for='mcp_bagNumNew' class='col-sm-4 col-form-label'> Movable Contact Bag Number: </label>";
					        				echo "<div class='col-sm-8'>";
					        			for ($i=0; $i < $max; $i++) { 
					        				echo "<input class='form-control' type='text' name='mcp_bagNumNew' value='$split_mcp_bagNum[$i]'>";
					        			}
					        			echo "</div>";
					        			echo "</div>";

					        			echo "<div class='form-group row'>";
					        				echo "<label for='mcp_qtyNew' class='col-sm-4 col-form-label'> Movable Contact Point Quantity: </label>";
					        				echo "<div class='col-sm-8'>";
					        			for ($i=0; $i < $max; $i++) { 
					        				echo "<input class='form-control' type='text' name='mcp_qtyNew' value='$split_mcp_qty[$i]'>";
					        			}
					        			echo "</div>";
					        			echo "</div>";

					        			echo "<div class='form-group row'>";
					        				echo "<label for='cs_lotNumNew' class='col-sm-4 col-form-label'> Contact Spring Lot Number: </label>";
					        				echo "<div class='col-sm-8'>";
					        			for ($i=0; $i < $max; $i++) { 
					        				echo "<input class='form-control' type='text' name='cs_lotNumNew' value='$split_cs_lotNum[$i]'>";
					        			}
					        			echo "</div>";
					        			echo "</div>";

					        			echo "<div class='form-group row'>";
					        				echo "<label for='cs_qtyNew' class='col-sm-4 col-form-label'> Contact Spring Quantity: </label>";
					        				echo "<div class='col-sm-8'>";
					        			for ($i=0; $i < $max; $i++) { 
					        				echo "<input class='form-control' type='text' name='cs_qtyNew' value='$split_cs_qty[$i]'>";
					        			}
					        			echo "</div>";
					        			echo "</div>";
					        		}

					        		$process = $_POST['process'];
					        		echo "<input type='hidden' name='process' value='$process'>";

					      	echo "</div>";

					     	echo " <div class='modal-footer'>";
					        	echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
					        	echo "<button type='submit' class='btn btn-success' name='submit'> Save changes </button>";
					      	echo "</div>";
					      	echo "</form>";

					    echo "</div>";
					echo "</div>";
				echo "</div>";

		} // end of while loop

		echo "</tr> </tbody> </table>";
	?>

	<div id="showDebug"></div>

	<script>
		$(document).ready(function () {
			$('#save').on('submit', function (e) {
				// alert('clicked');
				event.preventDefault();
				$('.modal').modal('hide');

				var saveChanges = $('#save');
				$.ajax ({
					type: 'POST',
					url: 'ex_form_update.php',
					data: saveChanges.serialize(),
					success: function(data) {
	                    swal ({
	                        title: 'Great!',
	                        text: 'Record has been modified.',
	                        type: 'success',
	                        showConfirmButton: false,
	                        timer: 1500
	                    });

	                    $('#showDebug').html(data);
	                }
				});
				setTimeout(location.reload.bind(location),1500);
			});
		});

		$('.add').on('click', function () {
			alert('add button clicked');
		});
	</script>

</body>
</html>