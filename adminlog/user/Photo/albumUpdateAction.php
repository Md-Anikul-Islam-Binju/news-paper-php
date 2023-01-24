<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Manage Album</title>
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
	$iAlbumType=1;
	$sAlbumName="";$sAlbumDesc="";
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

	$iUpdateID=$_REQUEST["updateid"];//Collecting ID
	$iAlbumType=$_POST["cboAlbumType"];
	$sAlbumName=fFormatString($_POST["txtAlbumName"]);
	$sAlbumDesc=fFormatStringHTML($_POST["txtAlbumDescription"]);
	$sImageSMPath=$_FILES["txtImageSMPath"]["name"];

	/*$qUpdate="UPDATE p_album SET
			AlbumType=".$iAlbumType.",
			AlbumName='".$sAlbumName."'
			WHERE AlbumID=".$iUpdateID;*/
	$qUpdate="UPDATE p_album SET
			AlbumType=".$iAlbumType.",
			AlbumName='".$sAlbumName."', ";
	if($sImageSMPath!=""){$qUpdate.="ImagePath='".$sImageSMPath."', ";}
	$qUpdate.="Description='".$sAlbumDesc."'
			WHERE AlbumID=".$iUpdateID;
	//echo $qUpdate."<br><br>";
	$resultUpdate=mysqli_query($connEMM, $qUpdate) or die(mysqli_error($connEMM));

	if(isset($resultUpdate)){
		//Audit Trail
		$qAuditTrail="INSERT INTO com_audittrail_media(UserInfo, ActionType, ContentID, TableName,RemoteIP, RequestFileName, QueryDetails,DateTimeOccered)
		VALUES('".$_SESSION["sessUserName"]."', 2, ".$iUpdateID.", 'p_album', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qUpdate)."', '".$dtDateTime."')";
		mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);

		if($sImageSMPath!=""){
			//Renaming the uploaded file & Creating the NEW file name
			$sExtension=pathinfo($UploadImageAll.$sImageSMPath);
			$sNewName=fFormatImageName($sExtension["filename"]).".".$sExtension["extension"];
			//echo "sNewName: ".$sNewName."<br><br>";
			$dir=opendir($UploadPhotoAlbum);
			while($f=readdir($dir)){
				if($f==$sNewName){unlink($UploadPhotoAlbum.$sNewName) or die("File Delete Problem: ".mysqli_error($connEMM) );}//Delete if file exists
			}
			if(move_uploaded_file($_FILES["txtImageSMPath"]["tmp_name"], $UploadPhotoAlbum.$_FILES["txtImageSMPath"]["name"])){
				echo $sMsgUpload;
				//Renaming the uploaded file
				$dir=opendir($UploadPhotoAlbum);
				while($f=readdir($dir)){
					if ($f==$sImageSMPath){rename($UploadPhotoAlbum.$f, $UploadPhotoAlbum.$sNewName);}
				}
				//Update the new uploaded file name information into the database
				$sNewName=$sImgDir."/".$sNewName;
				$qUpdate="UPDATE p_album SET ImagePath='".$sNewName."' WHERE AlbumID=".$iUpdateID;
				mysqli_query($connEMM, $qUpdate) or die(mysqli_error($connEMM));
				closedir($dir);
			}else{
				echo $sMsgUploadFail;
				print_r($_FILES);
			}
		}

		echo $sMsgUpdate;
		header("Location: albumUpdateList.php");
		//header("Location: generateHTMLArchives.php");
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