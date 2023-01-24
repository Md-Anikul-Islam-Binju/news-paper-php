<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Create Gallery</title>
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
	$iAlbumID=1;$iSubCategoryID=1;$iSpecialCategoryID=1;$iImageType=1;$iShowAtHome=1;
	$sCaption="";$sPhotographerBN="";
	$sImageSMPath="";$sImageSMPathNew="";

	$iUpdateID=0;
	if(isset($_REQUEST["updateid"])){
		$iUpdateID=fFormatString($_REQUEST["updateid"]);
		$iUpdateID=filter_var($iUpdateID, FILTER_SANITIZE_NUMBER_INT);
		$iUpdateID=filter_var($iUpdateID, FILTER_VALIDATE_INT);
		if(!is_numeric($iUpdateID)){$iUpdateID=0;}
		if($iUpdateID<0){$iUpdateID=0;}
	}

	if($_FILES["txtImageSMPath"]["name"]!=""){
		//Checking File Size
		$iSize=$_FILES["txtImageSMPath"]["size"]/1024;
		if(($iSize==0) || ($iSize<0) || ($iSize>$iMaxImgSizeGallery) ){
			echo $sMsgImgUpldSizeMaxGal;die();
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

	$iAlbumID=$_POST["cboAlbum"];
//	$iCategory=$_POST["cboCategory"];
//	$iSubCategoryID=$_POST["cboSubCategoryID"];
//	$iSpecialCategoryID=$_POST["cboSpecialCategoryID"];
	$sCaption=fFormatString($_POST["txtCaption"]);
//	$sPhotographerBN=fFormatString($_POST["txtPhotographer"]);
	$sImageSMPath=$_FILES["txtImageSMPath"]["name"];if($sImageSMPath!=""){$sImageSMPathNew=$sImgDir."/".$sImageSMPath;}
//	$iImageType=$_POST["rdoImageType"];
	$iShowAtHome=$_POST["rdoShowAtHome"];

	$qUpdate="UPDATE p_photo SET
		AlbumID=".$iAlbumID.",
		Caption='".$sCaption."',";
	if($sImageSMPath!=""){$qUpdate.="ImagePath='".$sImageSMPathNew."',";}
	$qUpdate.="DateTimeUpdated='".$dtDateTime."',
		ShowAtHome=".$iShowAtHome."
		WHERE PhotoID=".$iUpdateID;

	/*$qUpdate="UPDATE p_photo SET
		AlbumID=".$iAlbumID.",
		CategoryID=".$iCategory.",
		Caption='".$sCaption."',";
	if(sImageSMPath!=""){$qUpdate.="ImagePath='".sImageSMPath."',";}
	$qUpdate.="ImageType=".$iImageType.",
		ShowAtHome=".$iShowAtHome.",
		DateTimeUpdated='".$dtDateTime."'
		WHERE PhotoID=".$iUpdateID;*/
	//echo $qUpdate."<br><br>";
	$resultUpdate=mysqli_query($connEMM, $qUpdate) or die(mysqli_error($connEMM));


	if(isset($resultUpdate)){
		//Audit Trail
		$qAuditTrail="INSERT INTO com_audittrail_media(UserInfo, ActionType, ContentID, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
		VALUES('".$_SESSION["sessUserName"]."', 2, ".$iUpdateID.", 'p_photo', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qUpdate)."', '".$dtDateTime."')";
		mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);

		if($sImageSMPath!=""){
			if(is_dir($UploadPhotoGallery) && is_writable($UploadPhotoGallery)){
				if(move_uploaded_file($_FILES["txtImageSMPath"]["tmp_name"], $UploadPhotoGallery.$_FILES["txtImageSMPath"]["name"])){
					print_r($_FILES["txtImageSMPath"]);
					echo $sMsgUpload;

					//Renaming the uploaded file & Creating the NEW file name
					$sExtension=pathinfo($UploadPhotoGallery.$sImageSMPath);
					$sNewName=fFormatImageName($sExtension["filename"]).".".$sExtension["extension"];
					//echo "sNewName: ".$sNewName."<br><br>";

					$dir=opendir($UploadPhotoGallery);
					while($fileRen=readdir($dir)){
						if($fileRen==$sImageSMPath){
							$iFlag=rename($UploadPhotoGallery.$fileRen, $UploadPhotoGallery.$sNewName);

							if($iFlag==1){
								//If Rename was done properly
								//Update the new uploaded file name information into the database
								$sNewName=$sImgDir."/".$sNewName;
								$qUpdate="UPDATE p_photo SET ImagePath='".$sNewName."' WHERE PhotoID=".$iUpdateID;
								//echo "qUpdate: ".$qUpdate."<br>";
								mysqli_query($connEMM, $qUpdate) or die("Update ImagePath: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
							} // End of IF Flag
						}
					} // End of While
					closedir($dir);
				}else{
					echo $sMsgUploadFail;
					echo "error: ".$_FILES['txtImageSMPath']['error']."<br><br>";
					print_r($_FILES['txtImageSMPath']);
				}
			}else{
				echo $sMsgDirFail;
			}
		}

		echo $sMsgUpdate;
		$_SESSION["sessAlbumID"]=$iAlbumID;
		$_SESSION["sessRedirectPhoto"]=$_SESSION["sessRedirectDailyPhoto"];

		//header("Location: photoUpdateList.php");
		header("Location: generateHTMLDaily.php");
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