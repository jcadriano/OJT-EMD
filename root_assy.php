<?php
//Include database config file
include('../inc/config.inc');
?>
<!doctype html>
<html>
<title>Lot History System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
//define root folder
 $root = ($_SERVER['DOCUMENT_ROOT']);
//call header page
include($root.'/Lot History System/global/header_page.php');
?>
<body>
<!--<div class="w3-container">-->
<div align="center">
  <h3>Please select the product category</h3>
  <p>Select the product category of the item you wish to input on the system.</p>

<!-- Link for EX Relay type --->  
<div class="relayCat"> 
<button id="exbtn" onclick="window.location='#openEXModal'"><span>EX</span></button>
	<div id="openEXModal" class="modalDialog">
		<div>	
			<a href="#close" title="Close" class="close">X</a>
			<table>
				<tr>
					<td colspan='2' align='center'>
						<form name="exrelay" method="post" action="ex_form_tryV1.php">
							<h2>EX Relay</h2>
					</td>
				</tr>
				<tr>
					<td>
 						<label for='exselect'>Select EX Line No.:</label>
					</td>
					<td>
						<?php
						$exquery = mssql_query("SELECT line_no, line_name, EX_relay FROM assembly_relay_master_tbl WHERE EX_relay ='True'") ;
							//$result = mssql_query($exquery);
							echo"<select id='exselect' name='ex_line'>";
							while($exresult = mssql_fetch_assoc( $exquery )) { 
									echo '<option value="'.$exresult['line_no'].'">' . $exresult['line_name'] . '</option>';   
							}
							echo '</select>';
						?>
					</td>
				</tr>
				<tr>
					<td>
						<label for='exprocess'>Select Process:</label>
					</td>
					<td>
						<?php
						$exquery = mssql_query("SELECT process_id, process_type, EX_relay FROM assembly_process_master_tbl WHERE EX_relay ='True'") ;
							//$result = mssql_query($exquery);
							echo"<select id='exselect' name='ex_line_process'>";
							while($exresult = mssql_fetch_assoc( $exquery )) { 
									echo '<option value="'.$exresult['process_type'].'">' . $exresult['process_type'] . '</option>';   
							}
							echo '</select>';
						?>
					</td>
				</tr>
				<tr>
					<td>
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan='2' align='center'>
						<input type='submit' class='relaySubmit' name='submit_exline' text='Submit' />
					</td>
				</tr>
						</form>
			</table>
			
		</div>
	</div>


&nbsp;&nbsp;
<button id="embtn" onclick="window.location='#openEMModal'"><span>EM</span></button>
	<div id="openEMModal" class="modalDialog">
		<div>	
			<a href="#close" title="Close" class="close">X</a>
			<table>
			<tr>
			<td colspan='2' align='center'>
			<form name="emrelay" method="get" action="em_form.php">
			<h2>EM Relay</h2>
			</td>
			</tr>
			<tr>
			<td>
 			<label for='emselect'>Select EM Line No.:</label>
			</td>
			<td>
			<?php
			$emquery = mssql_query("SELECT line_no, line_name, em_relay FROM assembly_relay_master_tbl WHERE em_relay ='True'") ;
				//$result = mssql_query($emquery);
				echo"<select id='emselect' name='em_line'>";
				while($emresult = mssql_fetch_assoc( $emquery )) { 
						echo '<option value="'.$emresult['line_no'].'">' . $emresult['line_name'] . '</option>';   
				}
				echo '</select>';
			?>
			</td>

			<tr>
			<td>
			<label for='emprocess'>Select Process:</label>
			</td>
			<td>
			<?php
			$emquery = mssql_query("SELECT process_id, process_type, em_relay FROM assembly_process_master_tbl WHERE em_relay ='True'") ;
				echo"<select id='emselect' name='em_line'>";
				while($emresult = mssql_fetch_assoc( $emquery )) { 
						echo '<option value="'.$emresult['process_type'].'">' . $emresult['process_type'] . '</option>';   
				}
				echo '</select>';
			?>
			</td>
			</tr>
			<tr>
			<td>
			&nbsp;
			</td>
			</tr>
			<tr>
			<td colspan='2' align='center'>
			<input type='submit' class='relaySubmit' name='submit_emline' temt='Submit' />
			</td>
			</tr>
			</table>
			</form>
			
		</div>
	</div>



&nbsp;&nbsp;
<button id="elbtn" onclick="window.location='#openELModal'"><span>EL</span></button>
<div id="openELModal" class="modalDialog">
		<div>	
			<a href="#close" title="Close" class="close">X</a>
			<table>
			<tr>
			<td colspan='2' align='center'>
			<form name="elrelay" method="get" action="el_form.php">
			<h2>EM Relay</h2>
			</td>
			</tr>
			<tr>
			<td>
 			<label for='elselect'>Select EL Line No.:</label>
			</td>
			<td>
			<?php
			$elquery = mssql_query("SELECT line_no, line_name, el_relay FROM assembly_relay_master_tbl WHERE el_relay ='True'") ;
				echo"<select id='elselect' name='el_line'>";
				while($elresult = mssql_fetch_assoc( $elquery )) { 
						echo '<option value="'.$elresult['line_no'].'">' . $elresult['line_name'] . '</option>';   
				}
				echo '</select>';
			?>
			</td>

			<tr>
			<td>
			<label for='elprocess'>Select Process:</label>
			</td>
			<td>
			<?php
			$elquery = mssql_query("SELECT process_id, process_type, el_relay FROM assembly_process_master_tbl WHERE el_relay ='True'") ;
				echo"<select id='elselect' name='el_line'>";
				while($elresult = mssql_fetch_assoc( $elquery )) { 
						echo '<option value="'.$elresult['process_type'].'">' . $elresult['process_type'] . '</option>';   
				}
				echo '</select>';
			?>
			</td>
			</tr>
			<tr>
			<td>
			&nbsp;
			</td>
			</tr>
			<tr>
			<td colspan='2' align='center'>
			<input type='submit' class='relaySubmit' name='submit_elline' temt='Submit' />
			</td>
			</tr>
			</table>
			</form>
			
		</div>
	</div>

</br></br>


<button id="eubtn" onclick="window.location='#openEUModal'"><span>EU</span></button>
<div id="openEUModal" class="modalDialog">
		<div>	
			<a href="#close" title="Close" class="close">X</a>
			<table>
			<tr>
			<td colspan='2' align='center'>
			<form name="eurelay" method="get" action="eu_form.php">
			<h2>EU Relay</h2>
			</td>
			</tr>
			<tr>
			<td>
 			<label for='euselect'>Select EU Line No.:</label>
			</td>
			<td>
			<?php
			$euquery = mssql_query("SELECT line_no, line_name, eu_relay FROM assembly_relay_master_tbl WHERE eu_relay ='True'") ;
				echo"<select id='euselect' name='eu_line'>";
				while($euresult = mssql_fetch_assoc( $euquery )) { 
						echo '<option value="'.$euresult['line_no'].'">' . $euresult['line_name'] . '</option>';   
				}
				echo '</select>';
			?>
			</td>

			<tr>
			<td>
			<label for='euprocess'>Select Process:</label>
			</td>
			<td>
			<?php
			$euquery = mssql_query("SELECT process_id, process_type, eu_relay FROM assembly_process_master_tbl WHERE eu_relay ='True'") ;
				echo"<select id='euselect' name='eu_line'>";
				while($euresult = mssql_fetch_assoc( $euquery )) { 
						echo '<option value="'.$euresult['process_type'].'">' . $euresult['process_type'] . '</option>';   
				}
				echo '</select>';
			?>
			</td>
			</tr>
			<tr>
			<td>
			&nbsp;
			</td>
			</tr>
			<tr>
			<td colspan='2' align='center'>
			<input type='submit' class='relaySubmit' name='submit_euline' temt='Submit' />
			</td>
			</tr>
			</table>
			</form>
			
		</div>
	</div>

&nbsp;&nbsp; 
<button id="epbtn" onclick="window.location='#openEPModal'"><span>EP</span></button>
<div id="openEPModal" class="modalDialog">
		<div>	
			<a href="#close" title="Close" class="close">X</a>
			<table>
			<tr>
			<td colspan='2' align='center'>
			<form name="eprelay" method="get" action="ep_form.php">
			<h2>EP Relay</h2>
			</td>
			</tr>
			<tr>
			<td>
 			<label for='epselect'>Select EP Line No.:</label>
			</td>
			<td>
			<?php
			$epquery = mssql_query("SELECT line_no, line_name, ep_relay FROM assembly_relay_master_tbl WHERE ep_relay ='True'") ;
				echo"<select id='epselect' name='ep_line'>";
				while($epresult = mssql_fetch_assoc( $epquery )) { 
						echo '<option value="'.$epresult['line_no'].'">' . $epresult['line_name'] . '</option>';   
				}
				echo '</select>';
			?>
			</td>

			<tr>
			<td>
			<label for='epprocess'>Select Process:</label>
			</td>
			<td>
			<?php
			$epquery = mssql_query("SELECT process_id, process_type, ep_relay FROM assembly_process_master_tbl WHERE ep_relay ='True'") ;
				echo"<select id='epselect' name='ep_line'>";
				while($epresult = mssql_fetch_assoc( $epquery )) { 
						echo '<option value="'.$epresult['process_type'].'">' . $epresult['process_type'] . '</option>';   
				}
				echo '</select>';
			?>
			</td>
			</tr>
			<tr>
			<td>
			&nbsp;
			</td>
			</tr>
			<tr>
			<td colspan='2' align='center'>
			<input type='submit' class='relaySubmit' name='submit_epline' temt='Submit' />
			</td>
			</tr>
			</table>
			</form>
			
		</div>
	</div>

&nbsp;&nbsp;
<button id="etbtn" onclick="window.location='#openETModal'"><span>ET</span></button>
<div id="openETModal" class="modalDialog">
		<div>	
			<a href="#close" title="Close" class="close">X</a>
			<table>
			<tr>
			<td colspan='2' align='center'>
			<form name="etrelay" method="get" action="et_form.php">
			<h2>ET Relay</h2>
			</td>
			</tr>
			<tr>
			<td>
 			<label for='etselect'>Select ET Line No.:</label>
			</td>
			<td>
			<?php
			$etquery = mssql_query("SELECT line_no, line_name, et_relay FROM assembly_relay_master_tbl WHERE et_relay ='True'") ;
				echo"<select id='etselect' name='et_line'>";
				while($etresult = mssql_fetch_assoc( $etquery )) { 
						echo '<option value="'.$etresult['line_no'].'">' . $etresult['line_name'] . '</option>';   
				}
				echo '</select>';
			?>
			</td>

			<tr>
			<td>
			<label for='etprocess'>Select Process:</label>
			</td>
			<td>
			<?php
			$etquery = mssql_query("SELECT process_id, process_type, et_relay FROM assembly_process_master_tbl WHERE et_relay ='True'") ;
				echo"<select id='etselect' name='et_line'>";
				while($etresult = mssql_fetch_assoc( $etquery )) { 
						echo '<option value="'.$etresult['process_type'].'">' . $etresult['process_type'] . '</option>';   
				}
				echo '</select>';
			?>
			</td>
			</tr>
			<tr>
			<td>
			&nbsp;
			</td>
			</tr>
			<tr>
			<td colspan='2' align='center'>
			<input type='submit' class='relaySubmit' name='submit_etline' temt='Submit' />
			</td>
			</tr>
			</table>
			</form>
			
		</div>
	</div>

</div>

</div>
<?php
include($root.'/Lot History System/global/footer_page.html');
?>
</body>
</html>