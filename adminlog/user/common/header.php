<?php if(!isset($_SESSION["sessUserName"])){
	if(trim(isset($_SESSION["sessUserName"]))==""){
		//session_start();
		$_SESSION["sessUserName"]=NULL;
		session_unset();
		session_destroy();
		if(isset($connEMM)){mysqli_close($connEMM);}
		header("location: ".$sAdmnURL);
		exit();
	}
} ?>
<div class="DHeader">
	<div class="DHeaderToggle"><div class="DHeaderToggleContent"><a href="<?php echo $sSiteURL; ?>" title="Project Home"><i class="fa fa-building fa-4x"></i></a></div></div>
	<div class="DHeaderHome"><a href="<?php echo $sAdmnURL; ?>home.php" title="Admin Home"><i class="fa fa-home fa-4x"></i></a></div>
	<div align="center" class="DHeaderHeading"><h1><?php echo $sAdmnTitle; ?></h1></div>
	<div class="DHeaderLogOut"><a href="<?php echo $sAdmnURL; ?>adminlogout.php" title="Logout"><i class="fa fa-cog fa-4x"></i></a></div>
	<div class="DHeaderUser"><i class="fa fa-user-secret fa-2x"></i> <?php echo $_SESSION["sessUserName"]; ?></div>
	<div class="DHeaderIP_Time">
		<a href="#" title="Current Date & Time"><i class="fa fa-calendar"></i> <?php echo $dtDateTime; ?></a><br>
		<a href="#" title="IP Address"><i class="fa fa-wifi"></i> <?php echo $_SERVER["REMOTE_ADDR"]; ?></a>
	</div>
</div>