<?php ob_start();session_cache_expire(30);session_start();require_once("../../common/mysqli_conneCT.php");require_once("../../common/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sub-Category - Insert (Bangla)</title>
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
	$iCategoryID=1;$iPriority=1;$iShow=1;
	$sSubCategoryName="";$sSlug="";$sEndNote="";$sRemarks="";$sImagePathIcon="";$sImagePathMenu="";$sImagePathCoverHome="";$sImagePathCoverInner="";

	if($_FILES["txtImageIcon"]["name"]!=""){
		//Checking File Size
		$iSize=$_FILES["txtImageIcon"]["size"]/1024;
		if(($iSize==0) || ($iSize<0) || ($iSize>$iMaxImgSizeContentSM) ){
			echo $sMsgImgUpldSizeMaxSM;die();
		}

		//Checking File Extension
		$iInvalid=array('jpg', 'jpeg', 'jpe', 'gif', 'png', 'bmp');
		$sFileName=$_FILES["txtImageIcon"]["name"];
		$ext=pathinfo($sFileName, PATHINFO_EXTENSION);
		//echo "sFileName: ".$sFileName." - Ext: ".$ext."<br>";
		if(!in_array($ext, $iInvalid)){echo $sMsgImgInvalidImageExt;die();}

		//Checking Image dimension
		list($iWidth, $iHeight, $iType, $iAttr)=getimagesize($_FILES["txtImageIcon"]["tmp_name"]);
		if( ($iWidth=="") || ($iHeight=="")){echo $sMsgImgInvalidImage;die();}
	}
	if($_FILES["txtImageMenu"]["name"]!=""){
		//Checking File Size
		$iSize=$_FILES["txtImageMenu"]["size"]/1024;
		if(($iSize==0) || ($iSize<0) || ($iSize>$iMaxImgSizeContentSM) ){
			echo $sMsgImgUpldSizeMaxSM;die();
		}

		//Checking File Extension
		$iInvalid=array('jpg', 'jpeg', 'jpe', 'gif', 'png', 'bmp');
		$sFileName=$_FILES["txtImageMenu"]["name"];
		$ext=pathinfo($sFileName, PATHINFO_EXTENSION);
		//echo "sFileName: ".$sFileName." - Ext: ".$ext."<br>";
		if(!in_array($ext, $iInvalid)){echo $sMsgImgInvalidImageExt;die();}

		//Checking Image dimension
		list($iWidth, $iHeight, $iType, $iAttr)=getimagesize($_FILES["txtImageMenu"]["tmp_name"]);
		if( ($iWidth=="") || ($iHeight=="")){echo $sMsgImgInvalidImage;die();}
	}
	if($_FILES["txtImageCoverHome"]["name"]!=""){
		//Checking File Size
		$iSize=$_FILES["txtImageCoverHome"]["size"]/1024;
		if(($iSize==0) || ($iSize<0) || ($iSize>$iMaxImgSizeContentSM) ){
			echo $sMsgImgUpldSizeMaxSM;die();
		}

		//Checking File Extension
		$iInvalid=array('jpg', 'jpeg', 'jpe', 'gif', 'png', 'bmp');
		$sFileName=$_FILES["txtImageCoverHome"]["name"];
		$ext=pathinfo($sFileName, PATHINFO_EXTENSION);
		//echo "sFileName: ".$sFileName." - Ext: ".$ext."<br>";
		if(!in_array($ext, $iInvalid)){echo $sMsgImgInvalidImageExt;die();}

		//Checking Image dimension
		list($iWidth, $iHeight, $iType, $iAttr)=getimagesize($_FILES["txtImageCoverHome"]["tmp_name"]);
		if( ($iWidth=="") || ($iHeight=="")){echo $sMsgImgInvalidImage;die();}
	}
	if($_FILES["txtImageCoverInner"]["name"]!=""){
		//Checking File Size
		$iSize=$_FILES["txtImageCoverInner"]["size"]/1024;
		if(($iSize==0) || ($iSize<0) || ($iSize>$iMaxImgSizeContentBG) ){
			echo $sMsgImgUpldSizeMaxBG;die();
		}

		//Checking File Extension
		$iInvalid=array('jpg', 'jpeg', 'jpe', 'gif', 'png', 'bmp');
		$sFileName=$_FILES["txtImageCoverInner"]["name"];
		$ext=pathinfo($sFileName, PATHINFO_EXTENSION);
		//echo "sFileName: ".$sFileName." - Ext: ".$ext."<br>";
		if(!in_array($ext, $iInvalid)){echo $sMsgImgInvalidImageExt;die();}

		//Checking Image dimension & FB compatibility
		list($iWidth, $iHeight, $iType, $iAttr)=getimagesize($_FILES["txtImageCoverInner"]["tmp_name"]);
		if( ($iWidth=="") || ($iHeight=="")){echo $sMsgImgInvalidImage;die();}
		elseif( ($iWidth<600) || ($iHeight<315)){echo $sMsgImgInvalidFB;die();}
	}

	$iCategoryID=$_POST["cboCategory"];
	$sSubCategoryName=fFormatString($_POST["txtSubCategoryName"]);
	$sSlug=fFormatString($_POST["txtSlug"]);
	$sSlug=fFormatSlug($sSlug);
	$sEndNote=fFormatString($_POST["txtEndNote"]);
	$sRemarks=fFormatStringHTML($_POST["txtRemarks"]);
	$iPriority=fFormatString($_POST["txtPriority"]);
	$sImagePathIcon=$_FILES["txtImageIcon"]["name"];
	$sImagePathMenu=$_FILES["txtImageMenu"]["name"];
	$sImagePathCoverHome=$_FILES["txtImageCoverHome"]["name"];
	$sImagePathCoverInner=$_FILES["txtImageCoverInner"]["name"];
	$iShow=$_POST["rdoShow"];

	$qInsert="INSERT INTO bn_bas_subcategory(CategoryID, SubCategoryName, Slug, EndNote, Remarks, Priority, ShowData, ImagePathIcon) VALUES(".$iCategoryID.", '".$sSubCategoryName."', '".$sSlug."', '".$sEndNote."', '".$sRemarks."', ".$iPriority.", ".$iShow.", '".$sImagePathIcon."')";

	if(mysqli_query($connEMM, $qInsert)){
		$iThisContentID=mysqli_insert_id($connEMM);//Inserted ID

		//Audit Trail
		$qAuditTrail="INSERT INTO com_audittrail_gen_bn(UserInfo, ActionType, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
		VALUES('".$_SESSION["sessUserName"]."', 1, 'bn_bas_subcategory', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qInsert)."', '".$dtDateTime."')";
		mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);

		if($sImagePathIcon!=""){
			if(move_uploaded_file($_FILES["txtImageIcon"]["tmp_name"], $UploadCategory.$_FILES["txtImageIcon"]["name"])){
				echo $sMsgUpload;
				//Renaming the uploaded file
				$sFileName=pathinfo($UploadCategory.$sImagePathIcon);$sDateTime=date("YmdHis");$sNewName=$sFileName["filename"].$sDateTime.".".$sFileName["extension"];

				$dir=opendir($UploadCategory);
				while($fileRen=readdir($dir)){
					if($fileRen==$sImagePathIcon){
						$iFlag=rename($UploadCategory.$fileRen, $UploadCategory.$sNewName);
						if($iFlag==1){
							//If Rename was done properly -- Update the new uploaded file name information into the database
							$qUpdate="UPDATE bn_bas_subcategory SET ImagePathIcon='".$sNewName."' WHERE SubCategoryID=".$iThisContentID;
							//echo $qUpdate."<br>";
							mysqli_query($connEMM, $qUpdate) or die("Update ImagePath Icon: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
						}
					}
				}
				closedir($dir);
			}else{
				echo $sMsgUploadFail;
				print_r($_FILES);
			}
		}

		if($sImagePathMenu!=""){
			if(move_uploaded_file($_FILES["txtImageMenu"]["tmp_name"], $UploadCategory.$_FILES["txtImageMenu"]["name"])){
				echo $sMsgUpload;
				//Renaming the uploaded file
				$sFileName=pathinfo($UploadCategory.$sImagePathMenu);$sDateTime=date("YmdHis");$sNewName=$sFileName["filename"].$sDateTime.".".$sFileName["extension"];

				$dir=opendir($UploadCategory);
				while($fileRen=readdir($dir)){
					if($fileRen==$sImagePathMenu){
						$iFlag=rename($UploadCategory.$fileRen, $UploadCategory.$sNewName);
						if($iFlag==1){
							//If Rename was done properly -- Update the new uploaded file name information into the database
							$qUpdate="UPDATE bn_bas_subcategory SET ImagePathMenu='".$sNewName."' WHERE SubCategoryID=".$iThisContentID;
							//echo $qUpdate."<br>";
							mysqli_query($connEMM, $qUpdate) or die("Update ImagePath Menu: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
						}
					}
				}
				closedir($dir);
			}else{
				echo $sMsgUploadFail;
				print_r($_FILES);
			}
		}

		if($sImagePathCoverHome!=""){
			if(move_uploaded_file($_FILES["txtImageCoverHome"]["tmp_name"], $UploadCategory.$_FILES["txtImageCoverHome"]["name"])){
				echo $sMsgUpload;
				//Renaming the uploaded file
				$sFileName=pathinfo($UploadCategory.$sImagePathCoverHome);$sDateTime=date("YmdHis");$sNewName=$sFileName["filename"].$sDateTime.".".$sFileName["extension"];

				$dir=opendir($UploadCategory);
				while($fileRen=readdir($dir)){
					if($fileRen==$sImagePathCoverHome){
						$iFlag=rename($UploadCategory.$fileRen, $UploadCategory.$sNewName);
						if($iFlag==1){
							//If Rename was done properly -- Update the new uploaded file name information into the database
							$qUpdate="UPDATE bn_bas_subcategory SET ImagePathCoverHome='".$sNewName."' WHERE SubCategoryID=".$iThisContentID;
							//echo $qUpdate."<br>";
							mysqli_query($connEMM, $qUpdate) or die("Update ImagePath Cover Home: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
						}
					}
				}
				closedir($dir);
			}else{
				echo $sMsgUploadFail;
				print_r($_FILES);
			}
		}

		if($sImagePathCoverInner!=""){
			if(move_uploaded_file($_FILES["txtImageCoverInner"]["tmp_name"], $UploadCategory.$_FILES["txtImageCoverInner"]["name"])){
				echo $sMsgUpload;
				//Renaming the uploaded file
				$sFileName=pathinfo($UploadCategory.$sImagePathCoverInner);$sDateTime=date("YmdHis");$sNewName=$sFileName["filename"].$sDateTime.".".$sFileName["extension"];
				$dir=opendir($UploadCategory);
				while($fileRen=readdir($dir)){
					if($fileRen==$sImagePathCoverInner){
						$iFlag=rename($UploadCategory.$fileRen, $UploadCategory.$sNewName);
						if($iFlag==1){
							//If Rename was done properly -- Update the new uploaded file name information into the database
							$qUpdate="UPDATE bn_bas_subcategory SET ImagePathCoverInner='".$sNewName."' WHERE SubCategoryID=".$iThisContentID;
							//echo $qUpdate."<br>";
							mysqli_query($connEMM, $qUpdate) or die("Update ImagePath Cover Inner: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
						}
					}
				}
				closedir($dir);
			}else{
				echo $sMsgUploadFail;
				print_r($_FILES);
			}
		}

		echo $sMsgInsert;
		$_SESSION["sessCategoryID"]=$iCategoryID;
		header("Location: subCatInsert.php");
	}else{
		if(mysqli_errno($connEMM)==1062){header("Location:".$_SERVER["HTTP_REFERER"]."?msg=duplicate");}
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