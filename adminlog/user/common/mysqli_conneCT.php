<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


define("DB_HOST","localhost");
define("DB_USER","dailytorunkantho_torunkanthoweb");
define("DB_PASSWORD","jZ&*W~gt11#f");
define("DB_NAME","dailytorunkantho_torunkanthoweb"); //Local


define("DB_HOSTAudit","localhost");
define("DB_USERAudit","dailytorunkantho_torunkanthopoll");
define("DB_PASSWORDAudit","ro0AA}+b+e&q");
define("DB_NAMEAudit","dailytorunkantho_torunkanthopoll");


//Local
/*define("DB_HOST","localhost");define("DB_USER","jugerchi_root");define("DB_PASSWORD","25B_09pPZ1H_d");define("DB_NAME","jugerchi_emm"); //Web
define("DB_HOSTAudit","localhost");define("DB_USERAudit","jugerchi_root");define("DB_PASSWORDAudit","25B_09pPZ1H_d");define("DB_NAMEAudit","jugerchi_emmaudit"); //Web*/


if(@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Please try after a while...")){
	$connEMM=@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Please try after a while...");
	if($connEMM){
		@mysqli_query($connEMM, "SET CHARACTER SET utf8");
		@mysqli_query($connEMM, "SET SESSION collation_connection='utf8_general_ci'");
	}else{
		trigger_error("Please try after a while...");
		exit();
	}
}else{
	trigger_error("Please try after a while...");
	exit();
}


if(@mysqli_connect(DB_HOSTAudit, DB_USERAudit, DB_PASSWORDAudit, DB_NAMEAudit) or die("Please try after a while...")){
	$connEMMAudit=@mysqli_connect(DB_HOSTAudit, DB_USERAudit, DB_PASSWORDAudit, DB_NAMEAudit) or die("Please try after a while...");
	if($connEMMAudit){
		@mysqli_query($connEMMAudit, "SET CHARACTER SET utf8");
		@mysqli_query($connEMMAudit, "SET SESSION collation_connection='utf8_general_ci'");
	}else{
		trigger_error("Please try after a while...");
		exit();
	}
}else{
	trigger_error("Please try after a while...");
	exit();
}


//Collecting the last iamge folder name
$resultImgFolder=mysqli_query($connEMM, "SELECT * FROM com_monthlyimagefoldername ORDER BY FolderID DESC LIMIT 1") or die(mysqli_error($connEMM));
$rsImgFolder=mysqli_fetch_assoc($resultImgFolder);
$sImgDir=$rsImgFolder["FolderName"];
mysqli_free_result($resultImgFolder);
?>