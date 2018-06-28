<!doctype html>
 <html>
 <head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 </head>
<?php
//link the css on the page
//define web server
$webSV = $_SERVER['SERVER_NAME'];
echo "<link href='http://".$webSV."/developmental/jc/lot history system TRIAL/css/style.css' rel='stylesheet' type='text/css' />";
//echo "<script src='http://".$webSV."/lot history system/jquery/jquery1.9.1.js'></script>";
?>
<title>Lot History System</title>
<body>
<form>
<!------------------- MENU BAR ---------------------->
<div class="menu-container">
	<div class="nav-container">
		<div class="header-logo">
			<?php
						//Global header image
						$webSV = $_SERVER['SERVER_NAME'];
						echo "<img src='http://".$webSV."/developmental/jc/lot history system TRIAL/images/logo.jpg' alt='EMTEPH Lot History System'>";
					?>
		</div>
		<div class="header-login">
		<!--display current user-->
			<?php 
						$username = $_SESSION['username'];
						if(empty($username)){
							echo "You are not signed in";
							}
						else{	
							echo 'Logged in as  '.$_SESSION['firstname'].'&nbsp'.$_SESSION['lastname'];  
					    }
					?>			
		</div>
	</div>
	<div class="menu-bar">
		<a href="<?php echo "http://".$webSV."/developmental/jc/lot history system TRIAL/index.php"; ?>" class="menu-btn">Home</a>
		<a href="#" class="menu-btn">Manual</a>
		<a href="<?php echo "http://".$webSV."/developmental/jc/lot history system TRIAL/pages/control_page.php"; ?>" class="menu-btn">Data Control</a>
		<a href="#" class="menu-btn">About</a>
		<?php
					//if($username = " "){
						if(empty($_SESSION['username'])){
					
							echo "<a class='menu-btn' href='./loginpage2.html'>Login</a>";
							
						}
						else{
							echo "<a class='menu-btn' href='./logoutpage.php'>Logout</a>";
						}
		?></a>		
	</div>	
</div>
<!---------------------- MENU BAR END ---------------------->
</form>
</body>
</html>
