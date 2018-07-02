	<!-- This section is the set of buttons, and functions that can be found on top on the table form -->
	<section class="above_table">
		<!-- Hidden input fields for line number and process -->
		<input type='hidden' name='process' value='<?php echo $process;?>'>
		<input type='hidden' name='line_no' value='<?php echo $lineNum;?>'>
		
		<!-- Buttons used for adding and deleting a table row -->
		<div id="buttons">
			<button type="button" id="addRow" class="formBtn btn btn-info"> Add Row </button>
			<button type="button" id="delRow" class="formBtn btn btn-danger"> Delete Row </button>
		</div>
	</section>

	<table class="sheet">
	<thead>
		<tr>
			<th rowspan="2"> Date </th>
			<th rowspan="2"> Operator Name </th>
			<th rowspan="2" id="shiftContainer"> Shift </th>
			<th colspan="3"> Output </th>
			<th colspan="7"> Supplied Materials </th>
		</tr>
		<tr>
			<!-- Under Output -->
			<th> Relay Type </th>
			<th> Lot No. </th>
			<th> Quantity </th>

			<!-- Under Supplied Materials -->
			<th> Arm. Lot No. </th>
			<th> Arm. Qty </th>
			<th> Mov. Contact Point Lot No. </th>
			<th> Mov. C.P Bag No. </th>
			<th> Mov. C.P Qty </th>
			<th> Contact Spring Lot No. </th>
			<th> C.S Qty </th>
		</tr>
	</thead>

	<tbody class="submittedRecord">
		
	</tbody>

	<tfoot>
		<tr class="newRow">
			<td rowspan="1" class="expand"> <!-- date -->
				<!-- Gets the system date and returns it to the page -->
				<?php
					$date = date("m-d-Y");
					echo "<p>" . $date . "</p>"; 
				?> 

				<!-- Hidden fields for date, month and year -->
				<input type="hidden" name="date" value="<?php echo $date; ?>">
				<input type="hidden" name="month" value="<?php echo $month = date("m"); ?>">
				<input type="hidden" name="year" value="<?php echo $year = date("Y"); ?>">
			</td> 
			<td rowspan="1" class="expand"> <!-- name -->
				<input type="text" name="optr_name" id="optr_name" required="required">
			</td>
			<td rowspan="1" class="expand" id="shifting"> <!-- shift -->
			</td> 
			
			<td rowspan="1" class="large expand"> 
				<input type="text" name="relay_type" required="required"> 
			</td> <!-- relay type -->
			
			<td rowspan="1" class="large expand"> 
				<input type="text" name="lotNum" required="required"> 
			</td> <!-- lot no -->
			
			<td rowspan="1" class="expand smaller"> 
				<input type="text" min="1" name="quantity" class="number" required="required"> 
			</td> <!-- qty -->
			
			<td> <input type="text" name="arm_lotNum[]" required="required"> </td> <!-- armature lot no -->
			<td class="smaller"> <input type="text" class="number" name="arm_qty[]" required="required"> </td> <!-- armature qty -->
			<td> <input type="text" name="mcp_lotNum[]" required="required"> </td> <!-- mcp lot no -->
			<td class="smaller"> <input type="text" class="number" name="mcp_bagNum[]" required="required"> </td> <!-- mcp bag no -->
			<td class="smaller"> <input type="text" class="number" name="mcp_qty[]" required="required"> </td> <!-- mcp qty -->
			<td> <input type="text" name="cs_lotNum[]" required="required"> </td> <!-- cs lot no -->
			<td class="smaller"> <input type="text" class="number" name="cs_qty[]" required="required"> </td> <!-- cs qty -->
		</tr>
	</tfoot>
	</table>

	<script>
		// ==========================================| AUTO RELOAD SHIFT FIELD |==========================================
        // This loads the 'shifting.php' file to the '#shifting' <td>, this is done every one second to automatically determine the shifting schedule.
        var auto_refresh = setInterval( function() {
                $('#shifting').load('shifting.php').fadeIn('slow');
        }, 1000);

		// ===========================================| ADD ROW |===========================================
		$('#addRow').click (function () {
			var newRow = "<tr class='newRow'>" + 
						 	" <td> " + 
						 		"<input type='text' name='arm_lotNum[]' placeholder='Arm. Lot #'> " + 
						 	" </td> " + 
						 	" <td> " + 
						 		"<input type='text' class='number' name='arm_qty[]' placeholder='Arm. Qty'> " + 
						 	" </td> " +
						 	" <td> " + 
						 		"<input type='text' name='mcp_lotNum[]' placeholder='Mov. CP Lot #'> " + 
						 	" </td> " +
						 	" <td> " + 
						 		"<input type='text' class='number' name='mcp_bagNum[]' placeholder='Mov. CP Bag #'> " + 
						 	" </td> " +
						 	" <td> " + 
						 		"<input type='text' class='number' name='mcp_qty[]' placeholder='Mov. CP Qty'> " + 
						 	" </td> " +
						 	" <td> " + 
						 		"<input type='text' name='cs_lotNum[]' placeholder='CS Lot #'> " + 
						 	" </td> " +
						 	" <td> " + 
						 		"<input type='text' class='number' name='cs_qty[]' placeholder='CS Qty'> " + 
						 	" </td> " +
						 "</tr>";
			var rowspan = parseInt($('.expand').attr('rowspan')) + 1; //rowspan increments

            $('.expand').attr('rowspan', rowspan);
            $('.sheet tr:eq(-1)').after(newRow); //add new row at end
		});

		// ===========================================| DELETE ROW |===========================================\
		$('#delRow').on('click', function() {
		    var lenRow = $('.sheet tr.newRow').length;
		    if (lenRow == 1 || lenRow <= 1) {

		        swal({
					title: "Oops...",
					text: "Can't remove all rows!",
					type: "error"
				});

		    } else {
		        $('.sheet tr.newRow:last').remove();
		    }
		}); 

		// ===========================================| ADD COMMAS |===========================================
        $('input.number').keyup(function(event) {
            // alert('working');

            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function(index, value) {
                return value.replace (/\D/g, "").replace (/\B(?=(\d{3})+(?!\d))/g, ",");
            });
        });

        // =============================================| SEARCH |=============================================
        // $('#search').on('click', function () {
        // 	alert('Search clicked');
        // 	window.location.href='ex_armature_search.php';
        // });

		// ===========================================| ARMATURE LOT NO. |===========================================
		// $('#arm_addField').click (function () {
		// 	var newRow = "<tr class='arm_newField'> <td> <input type='text' name='arm_lotNum[]' placeholder=' arm new field'> </td> </tr>";
		// 	var rowspan = parseInt($('.expand').attr('rowspan')) + 1;

		// 	$('.expand').attr('rowspan', rowspan);
		// 	$('.sheet tr:eq(-1)').after(newRow);
		// });	

		// $('#arm_delField').on('click', function() {
		//     var lenRow = $('.sheet tr.arm_newField').length;
		//     //alert(lenRow);
		//     if (lenRow == 1 || lenRow <= 1) {
		//         alert("Can't remove all row!");
		//     } else {
		//         $('.sheet tr.arm_newField:last').remove();
		//     }
		// }); 

		// ===========================================| MCP LOT NO. |===========================================
		// $('#mcp_addField').click (function () {
		// 	var newRow = "<tr class='mcp_newField'> <td> <input type='text' name='mcp_lotNum[]' placeholder=' mcp new field'> </td> </tr>";
		// 	var rowspan = parseInt($('.expand').attr('rowspan')) + 1;

		// 	$('.expand').attr('rowspan', rowspan);
		// 	$('.sheet tr:eq(-1)').after(newRow);
		// });	

		// $('#mcp_delField').on('click', function() {
		//     var lenRow = $('.sheet tr.mcp_newField').length;
		//     //alert(lenRow);
		//     if (lenRow == 1 || lenRow <= 1) {
		//         alert("Can't remove all row!");
		//     } else {
		//         $('.sheet tr.mcp_newField:last').remove();
		//     }
		// });

		// ===========================================| CS LOT NO. |===========================================
		// $('#cs_addField').click (function () {
		// 	var newRow = "<tr class='cs_newField'> <td style='visibility: hidden;'></td> <td style='visibility: hidden;'></td> <td> <input type='text' name='cs_lotNum[]' placeholder='cs new field'> </td> </tr>";
		// 	var rowspan = parseInt($('.expand').attr('rowspan')) + 1;

		// 	$('.expand').attr('rowspan', rowspan);
		// 	$('.sheet tr:eq(-1)').after(newRow);
		// });	

		// $('#cs_delField').on('click', function() {
		//     var lenRow = $('.sheet tr.cs_newField').length;
		//     //alert(lenRow);
		//     if (lenRow == 1 || lenRow <= 1) {
		//         alert("Can't remove all row!");
		//     } else {
		//         $('.sheet tr.cs_newField:last').remove();
		//     }
		// });

	</script>

	