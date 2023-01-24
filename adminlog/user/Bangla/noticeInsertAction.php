<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Notice</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
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
	$sHeading="";$sNoticeBrief="";$sNoticeDetails="";$sImageSMPath="";

	if($_FILES["txtImageSMPath"]["name"]!=""){
		//Checking File Size
		$iSize=$_FILES["txtImageSMPath"]["size"]/1024;
		if(($iSize==0) || ($iSize<0) || ($iSize>$iMaxImgSizeContentSM) ){
			echo $sMsgImgUpldSizeMaxSM;die();
		}

		//Checking File Extension
		$iInvalid=array('jpg', 'jpeg', 'jpe', 'gif', 'png', 'bmp');
		$sFileName=$_FILES["txtImageSMPath"]["name"];
		$ext=pathinfo($sFileName, PATHINFO_EXTENSION);
		//echo "sFileName: ".$sFileName." - Ext: ".$ext."<br>";
		if(!in_array($ext, $iInvalid)){echo $sMsgImgInvalidImageExt;die();}

		//Checking Image dimension
		list($iWidth, $iHeight, $iType, $iAttr)=getimagesize($_FILES["txtImageSMPath"]["tmp_name"]);
		if( ($iWidth=="") || ($iHeight=="")){echo $sMsgImgInvalidImage;die();}
	}

	$sHeading=fFormatString($_POST["txtHeading"]);
	$sNoticeBrief=fFormatStringHTML($_POST["txtNoticeBrief"]);
	$sNoticeDetails=fFormatStringHTML($_POST["txtNoticeDetails"]);
	$sImageSMPath=$_FILES["txtImageSMPath"]["name"];if($sImageSMPath!=""){$sImageSMPathNew=$sImgDir."/SM/".$sImageSMPath;}

	$qInsert="INSERT INTO bn_notice(NoticeHeading, NoticeBrief, NoticeDetails, ImageSMPath, DateTimeInserted)
	VALUES('".$sHeading."', '".$sNoticeBrief."', '".$sNoticeDetails."', '".$sImageSMPathNew."', '".$dtDateTime."')";
	$resultInsert=mysqli_query($connEMM, $qInsert) or die(mysqli_error($connEMM));


	if($resultInsert){
		$iThisContentID=mysqli_insert_id($connEMM); //Inserted ID

		//Audit Trail
		$qAuditTrail="INSERT INTO com_audittrail_gen_bn(UserInfo, ActionType, ContentID, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
		VALUES('".$_SESSION["sessUserName"]."', 1, ".$iThisContentID.", 'bn_notice', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qInsert)."', '".$dtDateTime."')";
		mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);


		if($sImageSMPath!=""){
			if(move_uploaded_file($_FILES["txtImageSMPath"]["tmp_name"], $UploadImageAllSM.$_FILES["txtImageSMPath"]["name"])){
				echo $sMsgUpload;

				//Renaming the uploaded file & Creating the NEW file name
				$sExtension=pathinfo($UploadImageAllSM.$sImageSMPath);
				$sNewNameSM=fFormatImageName($sExtension["filename"]).".".$sExtension["extension"];
				//echo "sNewNameSM: ".$sNewNameSM."<br><br>";

				$dir=opendir($UploadImageAllSM);
				while($fileRen=readdir($dir)){
					if($fileRen==$sImageSMPath){
						$iFlag=rename($UploadImageAllSM.$fileRen, $UploadImageAllSM.$sNewNameSM);
						if($iFlag==1){
							//If Rename was done properly
							//Update the new uploaded file name information into the database
							$sNewName=$sImgDir."/SM/".$sNewName;
							$qUpdate="UPDATE bn_notice SET ImageSMPath='".$sNewName."' WHERE NoticeID=".$iThisNoticeID;
							mysqli_query($connEMM, $qUpdate) or die("Update ImagePath: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
						} // End of IF Flag
					}
				} // End of While
				closedir($dir);
			}else{
				echo $sMsgUploadFail;
				print_r($_FILES);
			}
		}

		echo $sMsgInsert;
		header("Location: noticeInsert.php");
	}else{
		echo $sMsgInsertFail;
	}
} ?>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>