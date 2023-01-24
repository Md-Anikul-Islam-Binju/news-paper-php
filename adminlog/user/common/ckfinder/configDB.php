<?define("DB_HOST","localhost");define("DB_USER","coxsb2a6_coxsbaz");define("DB_PASSWORD","TM5OxY{r]Gw]");define("DB_NAME","coxsb2a6_coxs"); //Local
define("DB_HOSTAudit","localhost");define("DB_USERAudit","coxsb2a6_coxsbaz");define("DB_PASSWORDAudit","TM5OxY{r]Gw]");define("DB_NAMEAudit","coxsb2a6_coxs_audit"); //Local
/*define("DB_HOST","localhost");define("DB_USER","jugerchi_root");define("DB_PASSWORD","25B_09pPZ1H_d");define("DB_NAME","jugerchi_emm"); //Web
define("DB_HOSTAudit","localhost");define("DB_USERAudit","jugerchi_root");define("DB_PASSWORDAudit","25B_09pPZ1H_d");define("DB_NAMEAudit","jugerchi_emmaudit"); //Web*/

global $connEMM, $connEMMAudit, $dtDateTime;

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


//Collecting the last iamge folder name
$resultImgFolder=mysqli_query($connEMM, "SELECT * FROM com_monthlyimagefoldername ORDER BY FolderID DESC LIMIT 1") or die(mysqli_error($connEMM));
$rsImgFolder=mysqli_fetch_assoc($resultImgFolder);
$sImgDir=$rsImgFolder["FolderName"];
mysqli_free_result($resultImgFolder);

//Local
// $sSiteURL="http://localhost/District/Coxsbazar-CoxsbazarSoikat/";
// $sCurrURL="http://localhost/District/Coxsbazar-CoxsbazarSoikat".$_SERVER["REQUEST_URI"];

//Web
$sSiteURL="https://www.coxsbazarsoikat.com/";
$sCurrURL="https://www.coxsbazarsoikat.com".$_SERVER["REQUEST_URI"];



$dtTimeDifference=6*60*60;
$dtDate=gmdate("Y-m-d", time()+$dtTimeDifference);
$dtDateTime=gmdate("Y-m-d G:i:s", time()+$dtTimeDifference);
$dtDateTimeRSS=gmdate("D, d M Y", time()+$dtTimeDifference);


$iMaxImgSizeContentSM=150; /*KiloByte*/
$iMaxImgSizeContentBG=200; /*KiloByte*/
$iMaxImgSizeGallery=200; /*KiloByte*/
$iMaxImgSizeAdvt=300; /*KiloByte*/
$iMaxImgSizeDoc=2048; /*KiloByte - 2MB*/
$iMaxImgSizeAudio=2020480; /*KiloByte 20MB*/

//Image Width & height in pixel
$iImgThumbWidth=138;
$iImgThumbHeight=78;
$iImgSmWidth=245;
$iImgSmHeight=138;
$iImgBgWidth=700;


$sPath=$_SERVER["DOCUMENT_ROOT"];
// $sProjDir="/District/Coxsbazar-CoxsbazarSoikat/"; //Local
// $sPathProjDir=$sPath."/District/Coxsbazar-CoxsbazarSoikat/"; //Local
$sProjDir="/"; //Web
$sPathProjDir=$sPath."/"; //Web




/*If the database and MonthlyImageFolder information is missing the following value will be initialize*/
if(!isset($sImgDir)){$sImgDir="";}
/*Local & Web*/
$UploadImageAll=$sPath.$sProjDir."media/imgAll/".$sImgDir."/";
//$UploadImageAll=$sSiteURL."media/imgAll/".$sImgDir."/";
//echo $UploadImageAll;
?>