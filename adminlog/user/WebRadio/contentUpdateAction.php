<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Web Radio - Update (Bangla)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMMEn;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

<?php
if(isset($_POST["btnSubmit"])){
	$iIsAudio=0;$sSoundPath="";$sVideoPath="";

	$iUpdateID=0;
	if(isset($_REQUEST["updateid"])){
		$iUpdateID=fFormatString($_REQUEST["updateid"]);
		$iUpdateID=filter_var($iUpdateID, FILTER_SANITIZE_NUMBER_INT);
		$iUpdateID=filter_var($iUpdateID, FILTER_VALIDATE_INT);
		if(!is_numeric($iUpdateID)){$iUpdateID=0;}
		if($iUpdateID<0){$iUpdateID=0;}
	}

	if($_FILES["txtSoundClip"]["name"]!=""){
		//Validate file size
		$iSize=$_FILES["txtSoundClip"]["size"]/1024;
		if($iSize>$iMaxImgSizeAudio){echo $sMsgImgUpldSizeMaxAudio;die();}

		//Validate file type
		$iInvalid=array('ogg');
		$sSoundPath=$_FILES["txtSoundClip"]["name"];
		$iIsAudio=1;
		$ext=pathinfo($sSoundPath, PATHINFO_EXTENSION);
		//echo "sFileName: ".$sSoundPath."<br>";
		//echo "ext: ".$ext."<br>";
		if(!in_array($ext, $iInvalid)){echo $sMsgImgInvalidAudio;die();}else{$iIsAudio=0;}
	}

	$sVideoPath=fFormatStringHTML($_POST["txtYouTubeVideoID"]);
	//SQL
	if($iIsAudio==1){
		$qUpdate="UPDATE bn_content SET SoundPath='".$sSoundPath."', VideoPath='".$sVideoPath."' WHERE ContentID=".$iUpdateID;
	}else{
		$qUpdate="UPDATE bn_content SET VideoPath='".$sVideoPath."' WHERE ContentID=".$iUpdateID;
	}
	//echo $qUpdate."<br>";
	$resultUpdate=mysqli_query($connEMM, $qUpdate) or die(mysqli_error($connEMM));

	if(mysqli_query($connEMM, $qUpdate)){
		//Audit Trail
		$qAuditTrail="INSERT INTO com_audittrail_media(UserInfo, ActionType, ContentID, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
		VALUES('".$_SESSION["sessUserName"]."', 2, ".$iUpdateID.", 'bn_content', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qUpdate)."', '".$dtDateTime."')";
		mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);

		if($sSoundPath!=""){
			if(move_uploaded_file($_FILES["txtSoundClip"]["tmp_name"], $UploadWebRadio.$_FILES["txtSoundClip"]["name"])){
				echo $sMsgUpload;
				if(isset($_SESSION["sessSoundPathBN"])){
					//After uploading new image previous file (if exists) will be deleted
					$dir=opendir($UploadWebRadio);
					while($fileDel=readdir($dir)){
						if($fileDel==$_SESSION["sessSoundPathBN"]){
							unlink($UploadWebRadio.$fileDel);
						}
					}
				}
				//Renaming the uploaded file
				//Creating the NEW file name
				//$sFileName=pathinfo($UploadWebRadio.$sSoundPath);
				$sExtension=pathinfo($UploadWebRadio.$sSoundPath);
				$sNewName=fFormatImageName($sExtension["filename"]).".".$sExtension["extension"];
				//echo "sNewName: ".$sNewName."<br><br>";

				$dir=opendir($UploadWebRadio);
				while($fileRen=readdir($dir)){
					if($fileRen==$sSoundPath){
						$iFlag=rename($UploadWebRadio.$fileRen, $UploadWebRadio.$sNewName);

						if($iFlag==1){
							//If Rename was done properly
							//Update the new uploaded file name information into the database
							$sNewName=$sImgDir."/".$sNewName;
							$qUpdate="UPDATE bn_content SET SoundPath='".$sNewName."' WHERE ContentID=".$iUpdateID;
							//echo "qUpdate: ".$qUpdate."<br>";
							mysqli_query($connEMM, $qUpdate) or die("Update SoundPath: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
						} // End of IF Flag
					}
				} // End of While
				closedir($dir);
			}else{
				echo $sMsgUploadFail;
				print_r($_FILES);
			}
		}

		echo $sMsgUpdate;
		header("Location: ".$_SESSION["sessRedirectPageAudio"]);
	}else{
		echo $sMsgUpdateFail;
	}
} ?>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>