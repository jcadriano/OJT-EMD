<?php
include('../../../../inc/config.inc');
#Enable Cookie
$tablenames = $_COOKIE['tablename']; 
$relay_types = $_COOKIE['relay_type']; 
$product_names = $_COOKIE['product_name']; 
$product_types = $_COOKIE['product_type']; 
$selected_dates = $_COOKIE['selected_date']; 
$relay_types = $_COOKIE['relay_type']; 
$productnames = $_COOKIE['productname']; 
$db_tables = $_COOKIE['db_table']; 
$producttypes = $_COOKIE['producttype']; 
$startdates = $_COOKIE['startdate']; 
$enddates = $_COOKIE['enddate']; 
 echo$relay_types."tablename";
?>
<!DOCTYPE html>
<html>
<title>Piece Parts</title>
<head>
  <meta charset='utf-8'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link href='./plugin/datatable/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
  <link href='./plugin/datatable/datatables.min.css' rel='stylesheet' type='text/css'>
  <script src='./plugin/datatable/datatables.min.js'></script>
  <script src='./plugin/datatable/jquery-1.12.4.js'></script>
  <script src='./plugin/datatable/jquery.dataTables.min.js'></script>
</head>
 <style>
.tables {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}


.tables tr:nth-child(even){background-color: #f2f2f2;}

.tables tr:hover {background-color: #ddd;}

.tables th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #089ccd;
    color: white;
}
</style> 
 <!-- script for press -->
<script type='text/javascript'>
$(document).ready(function(){
    $('#example').DataTable();
});
</script>
<!-- script for press END -->
<body>
<div class='input-container'> 
<div class='input-table'>
<table border=1  id="example" class="display tables"  style="width:100%;">
<?php
if($productname == 'ST Terminal Assy'){ 
?>
 <thead>
            <tr>
				<th>Date(1)</th>
				<th>Operator Name(2)</th>
				<th>Shift(3)</th>
				<th >Production Lot No.(4)</th>
				<th>Product Quantity(5) </br> (pcs)</th>
				<th>Accumulated Output Quantity(6) </br> (pcs)</th>
				<th>Accumulated Punches(7) </br> (K Punches)</th>
				<th>Input Material Lot No.(8)/Raw Material</th>
				<th>Remarks(9)</th>
				<th>Status</th>
				<th>Action</th>
            </tr>	
		</thead>
        <tbody>
    <?
$lotquery = mssql_query("SELECT ".$tablenames.".id, ".$tablenames.".date, ".$tablenames.".operator_name, ".$tablenames.".shift, ".$tablenames.".lot_no, ".$tablenames.".product_quantity, ".$tablenames.".accumulated_quantity, ".$tablenames.".accumulated_punches, ".$tablenames.".raw_material, ".$tablenames.".contact_point, ".$tablenames.".remarks, ".$tablenames.".status_id, lot_status_tbl.status FROM ".$tablenames." LEFT JOIN lot_status_tbl ON ".$tablenames.".status_id = lot_status_tbl.status_id WHERE relay_type = $relay_types AND date BETWEEN '".$startdates."' AND '".$enddates."' ORDER BY date ASC");
					 $i=1; 
					while($lotresult = mssql_fetch_assoc( $lotquery )){
					echo '<tr>';
					echo '<td>'.$lotresult['date'].'</td>';
					echo '<td>'.$lotresult['operator_name'].'</td>';
					echo '<td>'.$lotresult['shift'].'</td>';
					echo '<td>'.$lotresult['lot_no'].'</td>';
					echo '<td>'.$lotresult['product_quantity'].'</td>';
					echo '<td>'.$lotresult['accumulated_quantity'].'</td>';
					echo '<td>'.$lotresult['accumulated_punches'].'</td>';
					echo '<td>'.$lotresult['raw_material'].'</td>';
					echo '<td>'.$lotresult['contact_point'].'</td>';
					echo '<td>'.$lotresult['remarks'].'</td>';
					echo '<td>'.$lotresult['status'].'</td>';
				
?>
			<td>
		
			<a class="btn_update" href="#editModal<?php echo $i;?>" data-sfid='"<?php echo $lotresult['id'];?>"' data-toggle="modal"><button class='btn-success'>Edit</button></a>
	
			<div class="modal fade" id="editModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Record of Lot History</h4>
      </div>
      <div class="modal-body">
								<fieldset>
                                <div class="modal-body">
								  <table border='0' width='100%' >
										<tr>
										<td align='left' style='padding-left: 50px;'>Lot Number:</td>
										<td><?php echo $lotresult['lot_no']; ?></td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Date of Manufacture:</td>
										<td><?php echo $lotresult['date']; ?></td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Product Quantity:</td>
										<td><?php echo $lotresult['product_quantity']; ?></td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Operator Name:</td>
										<td><input style='width: 100%; text-align: center;' type='text' id='operatorname<?php echo $i;?>' value='<?php echo $lotresult['operator_name']; ?>'</td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Shift:</td>
										<td><input style='width: 100%; text-align: center;' type='text' id='shift<?php echo $i;?>' value='<?php echo $lotresult['shift']; ?>'</td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Accumulated Punches:</td>
										<td><input style='width: 100%; text-align: center;' type='text' id='accpunches<?php echo $i;?>' value='<?php echo $lotresult['accumulated_punches']; ?>'</td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Raw Material:</td>
										<td><input style='width: 100%; text-align: center;' type='text' id='rawmaterial<?php echo $i;?>' value='<?php echo $lotresult['raw_material']; ?>'</td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>status:</td>
										<td>			
										<?php
										$statusquery = mssql_query("SELECT * FROM lot_status_tbl") ;
										echo"<select id='press_lot_status'".$i."' style='width: 100%; text-align-last:center;'>";
											while($statusresult = mssql_fetch_assoc( $statusquery )) { 
										?>
											<option value="<?php echo $statusresult['status_id']; ?>"<?php if($statusresult['status_id'] == $lotresult['status_id']){ echo 'selected="selected"';}?>><?php echo $statusresult['status']; ?></option>
										<?php
										}
										?>
										</select>
										</td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Remarks:</td>
										<td>
				
										<textarea rows="4" cols="50" id='remarkss<?php echo $i;?>' style='width: 100%; text-align: left;'><?php
										$breaks = array("<br />","<br>","<br/>");  
										$text = str_ireplace($breaks, " ", $lotresult['remarks']); 
										echo $text;?></textarea>
									
										</td>
										<input type='hidden' id='selecteddate<?php echo $i;?>' value='<?php echo $selected_dates; ?>'>
										<input type='hidden' id='relaytype<?php echo $i;?>' value='<?php echo $relay_types; ?>'>
										<input type='hidden' id='dbtable<?php echo $i;?>' value='<?php echo $tablenames; ?>'>
										<input type='hidden' id='productname<?php echo $i;?>' value='<?php echo $product_names; ?>'>
										<input type='hidden' id='producttype<?php echo $i;?>' value='<?php echo $product_types; ?>'>
										<input type='hidden' id='record_id<?php echo $i;?>' value='<?php echo $lotresult['id']; ?>'>
										<input type='hidden' id='contactpoint<?php echo $i;?>' value=''>
										
										</tr>
								  </table>		

								
                                 </div>
                                </fieldset>
      <div class="modal-footer">
		 <button class="btn-success"  id="submit<?php echo $i;?>">Submit</button>
            <a href="#" class="btn-close" id="close" data-dismiss="modal"><button class='btn-primary'>Close</button></a>
	 
       </div>
	 </div>
    </div>
  </div>
</div>

			</td>
	
				

		
										</tr>
								  </table>		

				
                                 </div>
                         
    
      <div class="modal-footer">
	     <!--    <button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Cancel</button> <a href="#" class="btn btn-danger"  id="modalDelete" >Delete</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
		<button class="btn-success" id="submit<?php echo $i;?>">Submit</button>
      <a href="#" class="" data-dismiss="modal">Close</a>
       </div>
	 </div>
    </div>
  </div>
</div>
            </td>
										
										</tr>
										  </tbody>
										  <?}?>
<?}else{?>
 <thead>
            <tr>
				<th>Date</th>
				<th>(*)Operator Name</th>
				<th>Shift</th>
				<th>Procuction Lot No.</th>
				<th>(*)Product Quantity </br> (pcs)</th>
				<th>(*)Accumulated Output Quantity </br> (pcs)</th>
				<th>(*)Accumulated Punches </br> (K Punches)</th>
				<th>(*)Input Material Lot No.</th>
				<th>Remarks</th>
				<th>Status</th>
				<th>Action</th>
            </tr>
		
			
	
		</thead>
		  <tbody>
    <?php
$lotquery = mssql_query("SELECT ".$tablenames.".id, ".$tablenames.".date, ".$tablenames.".operator_name, ".$tablenames.".shift, ".$tablenames.".lot_no, ".$tablenames.".product_quantity, ".$tablenames.".accumulated_quantity, ".$tablenames.".accumulated_punches, ".$tablenames.".raw_material, ".$tablenames.".remarks, ".$tablenames.".status_id, lot_status_tbl.status FROM ".$tablenames." LEFT JOIN lot_status_tbl ON ".$tablenames.".status_id = lot_status_tbl.status_id WHERE relay_type = $relay_types AND date BETWEEN '".$startdates."' AND '".$enddates."' ORDER BY date ASC");
					 $i=1; 
					while($lotresult = mssql_fetch_assoc( $lotquery )){
					echo '<tr>';
					echo '<td>'.$lotresult['date'].'</td>';
					echo '<td>'.$lotresult['operator_name'].'</td>';
					echo '<td>'.$lotresult['shift'].'</td>';
					echo '<td>'.$lotresult['lot_no'].'</td>';
					echo '<td>'.$lotresult['product_quantity'].'</td>';
					echo '<td>'.$lotresult['accumulated_quantity'].'</td>';
					echo '<td>'.$lotresult['accumulated_punches'].'</td>';
					echo '<td>'.$lotresult['raw_material'].'</td>';
					echo '<td>'.$lotresult['remarks'].'</td>';
					echo '<td>'.$lotresult['status'].'</td>';
?>
<td>
<a class="btn_update" href="#editModal<?php echo $i;?>" data-sfid='"<?php echo $lotresult['id'];?>"' data-toggle="modal"><button class='btn-success'>Edit</button></a>

<div class="modal fade" id="editModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Record of Lot History</h4>
      </div>
      <div class="modal-body">
								<fieldset>
                                <div class="modal-body">
								  <table border='1' width='100%' >
										<tr>
										<td align='left' style='padding-left: 50px;'>Lot Number:</td>
										<td><?php echo $lotresult['lot_no']; ?></td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Date of Manufacture:</td>
										<td><?php echo $lotresult['date']; ?></td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Product Quantity:</td>
										<td><?php echo $lotresult['product_quantity']; ?></td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Operator Name:</td>
										<td><input style='width: 100%; text-align: center;' type='text' id='operatorname<?php echo $i;?>' value='<?php echo $lotresult['operator_name']; ?>'</td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Shift:</td>
										<td><input style='width: 100%; text-align: center;' type='text' id='shift<?php echo $i;?>' value='<?php echo $lotresult['shift']; ?>'</td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Accumulated Punches:</td>
										<td><input style='width: 100%; text-align: center;' type='text' id='accpunches<?php echo $i;?>' value='<?php echo $lotresult['accumulated_punches']; ?>'</td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Raw Material:</td>
										<td><input style='width: 100%; text-align: center;' type='text' id='rawmaterial<?php echo $i;?>' value='<?php echo $lotresult['raw_material']; ?>'</td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>status:</td>
										<td>			
										<?php
										$statusquery = mssql_query("SELECT * FROM lot_status_tbl") ;
										echo"<select id='press_lot_status$i' style='width: 100%; text-align-last:center;'>";
											while($statusresult = mssql_fetch_assoc( $statusquery )) { 
										?>
											<option value="<?php echo $statusresult['status_id']; ?>"<?php if($statusresult['status_id'] == $lotresult['status_id']){ echo 'selected="selected"';}?>><?php echo $statusresult['status']; ?></option>
										<?php
										}
										?>
										</select>
										</td>
										</tr>
										<tr>
										<td align='left' style='padding-left: 50px;'>Remarks:</td>
										<td>
				
										<textarea rows="4" cols="50" id='remarkss<?php echo $i;?>' style='width: 100%; text-align: left;'><?php
										$breaks = array("<br />","<br>","<br/>");  
										$text = str_ireplace($breaks, " ", $lotresult['remarks']); 
										echo $text;?></textarea>
									
										</td>
										<input type='hidden' id='selecteddate<?php echo $i;?>' value='<?php echo $selected_dates; ?>'>
										<input type='hidden' id='relaytype<?php echo $i;?>' value='<?php echo $relay_types; ?>'>
										<input type='hidden' id='dbtable<?php echo $i;?>' value='<?php echo $tablenames; ?>'>
										<input type='hidden' id='productname<?php echo $i;?>' value='<?php echo $product_names; ?>'>
										<input type='hidden' id='producttype<?php echo $i;?>' value='<?php echo $product_types; ?>'>
										<input type='hidden' id='record_id<?php echo $i;?>' value='<?php echo $lotresult['id']; ?>'>
										<input type='hidden' id='contactpoint<?php echo $i;?>' value=''>
										
										</tr>
								  </table>		

								
                                 </div>
                                </fieldset>
          
    
      <div class="modal-footer">
	  <!--    <button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Cancel</button> <a href="#" class="btn btn-danger"  id="modalDelete" >Delete</a>
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      <button type="button" class="btn btn-primary">Save changes</button>-->
      <button class="btn-success" id="submit<?php echo $i;?>">Submit</button>
      <a href="#" class="btn-close" id="close" data-dismiss="modal"><button class='btn-primary'>Close</button></a>
      </div>
	 </div>
    </div>
  </div>
</div>
</td>
<script>
function PressLotHistoryLink(){
var PressLink = "../../../../Lot History Systemv2/pages/Master/PieceParts/Press/press_lothistory.php"
	$.ajax({
			type: "GET",
			url:PressLink, 
			cache: false,
			success: function(data){
			$('#PageContainer').html(data);		
			} 
		  });	
}
$(document).ready(function(){
$("#submit<?php echo $i;?>").on('click',function(){

	event.preventDefault();
	$('body').removeClass('modal-body');
	$('.modal-backdrop').remove();
	var operatorname = $("#operatorname<?php echo $i;?>").val();
	var shift = $("#shift<?php echo $i;?>").val();
	var accpunches = $("#accpunches<?php echo $i;?>").val();
	var rawmaterial = $("#rawmaterial<?php echo $i;?>").val();
	var press_lot_status = $("#press_lot_status<?php echo $i;?>").val();
	var remarkss = $("#remarkss<?php echo $i;?>").val();
	var selecteddate = $("#selecteddate<?php echo $i;?>").val();
	var relaytype = $("#relaytype<?php echo $i;?>").val();
	var productname = $("#productname<?php echo $i;?>").val();
	var producttype = $("#producttype<?php echo $i;?>").val();
	var record_id = $("#record_id<?php echo $i;?>").val();
	var contactpoint = $("#contactpoint<?php echo $i;?>").val();
	var dbtable = $("#dbtable<?php echo $i;?>").val();
	


	// var dataString = $("#EditPressRecord<?php echo $i;?>");
		// alert(dataString);
		swal({
			title: 'Are you sure you want to save your data?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, save it!'
			}).then((result) => {
			if (result.value) {
					alert("wew");
			$.ajax({
				url:'../../../Lot History Systemv2/ajax/Master/PieceParts/Press/editpressrecord.php',
				method: 'POST',
				// data:dataString.serialize(),
				// data: "OperatorName=" + OperatorName + "&Shift=" + Shift + "&AccPunches=" + AccPunches + "&RawMaterial=" + RawMaterial + "&Press_lot_status=" + Press_lot_status + "&Selecteddate=" + Selecteddate + "&Relaytype=" + Relaytype + "&Dbtable=" + Dbtable + "&Productname=" + Productname + "&Producttype=" + Producttype + "&Record_id=" + Record_id + "&Contactpoint=" + Contactpoint,
				// data: "operatorname=" + operatorname + "&shift=" + shift + "&accpunches=" + accpunches + "&rawmaterial=" + rawmaterial + "&press_lot_status=" + press_lot_status + "&remarks=" + remarks + "&selecteddate=" + selecteddate + "&relaytype=" + relaytype + "&dbtable=" + dbtable,
				data: "operatorname=" + operatorname + "&shift=" + shift + "&accpunches=" + accpunches + "&rawmaterial=" + rawmaterial + "&press_lot_status=" + press_lot_status + "&remarkss=" + remarkss + "&selecteddate=" + selecteddate + "&relaytype=" + relaytype + "&dbtable=" + dbtable + "&record_id=" + record_id,
				success:function(data){
				alert(data);
					
				switch(data)
				{
					case 'Success':
								swal(
									'Success',
									'Your file has been saved successfully',
									'success'
								)
						    setTimeout(function(){
						
							},1000);
							PressLotHistoryLink();
					break;
					case 'Failed':
					alert('MASTER OF ALL');
					break;
				};
				}
			});	
			}
			else{
			swal(
				 'Cancelled',
				 'Your file has been saved successfully',
				 'warning'
				)
			}
})

});	
});
</script>
<?php $i++; } ?>	
</tr>
</tbody>			
<?}?>
      
     
    </table>






<?php
echo $datacount;
//echo $startdate;
//echo $enddate;
	/*<textarea rows="4" cols="50" name='remarks' style='width: 100%; text-align: left;'><?php $converted = trim($lotresult['remarks'],chr(0xC2).chr(0xA0));echo $converted;?></textarea>*/
?>
 
</body>

</html>

