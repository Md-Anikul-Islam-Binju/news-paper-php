<div class="DFooter">
<p><?php echo $sAdmnTitle; ?></p>
<p>For best view of this application please adjust your resolution 1024px X 768px or higher.</p>
<p>Copyright &copy; <?php echo date("Y"); ?></p>
</div>
<?php
if(isset($connEMM)){
	mysqli_close($connEMM);
}else{
	/*if(isset($_SESSION["sessUserName"])){session_start();session_destroy();}
	$_SESSION["sessUserName"]=NULL;
	session_unset();*/
} ?>