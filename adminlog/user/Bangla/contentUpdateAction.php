<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Content - Update (Bangla)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<?php require_once($sAdmnPath."common/resizeLib.php"); ?>
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
	$iCategory=1;$iTopHome=1;$iTopInner=1;$iSubCategoryID=1;$iSubCategoryIDPos=1;$iSpecialCategoryID=1;$iSpecialCategoryIDPos=1;
	$iDistrictID=19;$iShowContent=1;$iShowInScroll=1;$iPreviousContentID=0;
	$sSubHeading="";$sHeading="";$sWriter="";$sInitial="";$sSource="";$sContentBrief="";$sContentDetails="";
	$sImageSMPath="";$sImageSMPathNew="";$sImageSMPathCaption="";$sImageBGPath="";$sImageBGPathNew="";$sImageBGPathCaption="";
	$sTags="";$sSoundPath="";$sVideoPath="";$sURLAlies="";$iPreviousContentID=0;
	$sNewNameSM="";$sNewNameSMDir="";$sNewNameBG="";$sNewNameBGDir="";
	$sPathImageBG="";$sPathImageThumb="";$sNewNameThumb="";$iImgBgHeight=1;$iRatio=1;


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

	if($_FILES["txtImageBGPath"]["name"]!=""){
		//Checking File Size
		$iSize=$_FILES["txtImageBGPath"]["size"]/1024;
		if(($iSize==0) || ($iSize<0) || ($iSize>$iMaxImgSizeContentBG) ){
			echo $sMsgImgUpldSizeMaxBG;die();
		}

		//Checking File Extension
		$iInvalid=array('jpg', 'jpeg', 'jpe', 'gif', 'png', 'bmp');
		$sFileName=$_FILES["txtImageBGPath"]["name"];
		$ext=pathinfo($sFileName, PATHINFO_EXTENSION);
		//echo "sFileName: ".$sFileName." - Ext: ".$ext."<br>";
		if(!in_array($ext, $iInvalid)){echo $sMsgImgInvalidImageExt;die();}

		//Checking Image dimension & FB compatibility
		list($iWidth, $iHeight, $iType, $iAttr)=getimagesize($_FILES["txtImageBGPath"]["tmp_name"]);
		//echo "iWidth: ".$iWidth." - iHeight: ".$iHeight."<br>";
		if( ($iWidth=="") || ($iHeight=="")){echo $sMsgImgInvalidImage;die();}
		elseif( ($iWidth<600) || ($iHeight<315)){echo $sMsgImgInvalidFB;die();}
	}

	$iCategory=$_POST["cboCategory"];
	$iTopHome=$_POST["cboTopHome"];
	$iTopInner=$_POST["cboTopInner"];
	if(isset($_POST["cboSubCategoryID"])){$iSubCategoryID=$_POST["cboSubCategoryID"];}else{$iSubCategoryID=1;}
	$iSubCategoryIDPos=$_POST["cboSubCategoryIDPos"];
	$iSpecialCategoryID=$_POST["cboSpecialCategoryID"];
	$iSpecialCategoryIDPos=$_POST["cboSpecialCategoryIDPos"];
	$iDistrictID=$_POST["cboDistrictID"];
	$sSubHeading=fFormatString($_POST["txtSubHeading"]);
	$sHeading=fFormatString($_POST["txtHeading"]);
	$sWriter=fFormatString($_POST["txtWriter"]);
	$sInitial=fFormatString($_POST["txtInitial"]);
	$sSource=fFormatString($_POST["txtSource"]);
	$sContentBrief=fFormatStringHTML($_POST["txtContentBrief"]);
	$sContentDetails=fFormatStringHTML($_POST["txtContentDetails"]);
	$sImageSMPath=$_FILES["txtImageSMPath"]["name"];if($sImageSMPath!=""){$sImageSMPathNew=$sImgDir."/SM/".$sImageSMPath;}
	$sImageSMPathCaption=fFormatString($_POST["txtImageSMPathCaption"]);
	$sImageBGPath=$_FILES["txtImageBGPath"]["name"];if($sImageBGPath!=""){$sImageBGPathNew=$sImgDir."/".$sImageBGPath;}
	$sImageBGPathCaption=fFormatString($_POST["txtImageBGPathCaption"]);
	//$sTagName=fFormatString($_POST["txtTagName"]);
	if(isset($_POST["txtTagNames"])){
		$sTags=implode(',',$_POST["txtTagNames"]);
	}
	$sVideoPath=fFormatString($_POST["txtYouTubeVideoID"]);
	$iShowContent=$_POST["rdoShowContent"];
	$iShowInScroll=$_POST["rdoShowInScroll"];
	if(isset($_POST["txtPrevContentID"])){if(is_numeric($_POST["txtPrevContentID"])){$iPreviousContentID=$_POST["txtPrevContentID"];}}//If data not found
	$sURLAlies=fFormatURL($sHeading);


	$qUpdate="UPDATE bn_content SET
			CategoryID=".$iCategory.",
			TopHome=".$iTopHome.",
			TopInner=".$iTopInner.",
			SubCategoryID=".$iSubCategoryID.",
			SubCategoryIDPos=".$iSubCategoryIDPos.",
			SpecialCategoryID=".$iSpecialCategoryID.",
			SpecialCategoryIDPos=".$iSpecialCategoryIDPos.",
			DistrictID=".$iDistrictID.",
			ContentSubHeading='".$sSubHeading."',
			ContentHeading='".$sHeading."',
			Writers='".$sWriter."',
			Initial='".$sInitial."',
			Source='".$sSource."',
			ContentBrief='".$sContentBrief."',
			ContentDetails='".$sContentDetails."',";
			if($sImageSMPath!=""){$qUpdate.="ImageSMPath='".$sImageSMPathNew."',";}
			$qUpdate.="ImageSMPathCaption='".$sImageSMPathCaption."',";
			if($sImageBGPath!=""){$qUpdate.="ImageBGPath='".$sImageBGPathNew."',";}
			if($sURLAlies!=""){$qUpdate.="URLAlies='".$sURLAlies."',";}
			$qUpdate.="ImageBGPathCaption='".$sImageBGPathCaption."',
			TagName='".$sTags."',
			VideoPath='".$sVideoPath."',
			ShowContent=".$iShowContent.",
			ShowInScroll=".$iShowInScroll.",
			PrevContentID=".$iPreviousContentID."
		WHERE ContentID=".$iUpdateID;
	//echo $qUpdate."<br><br>";

	if(mysqli_query($connEMM, $qUpdate)){
		//Audit Trail
		$qAuditTrail="INSERT INTO com_audittrail_bncontent(UserInfo, ActionType, ContentID, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
		VALUES('".$_SESSION["sessUserName"]."', 2, ".$iUpdateID.", 'bn_content', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qUpdate)."', '".$dtDateTime."')";
		mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);

		//Update Content Hit Counter
		$qTotalHitUpdate="UPDATE bn_totalhit SET TotalHit=TotalHit+1 WHERE ContentID=".$iUpdateID;
		mysqli_query($connEMM, $qTotalHitUpdate) or die("<b>Update TotalHit Error</b>: ".mysqli_error($connEMM));

		//Fix URL-Alice
		$qFixULRAlice="SELECT URLAlies FROM bn_content WHERE ContentID=".$iUpdateID;
		$resultFixULRAlice=mysqli_query($connEMM, $qFixULRAlice) or die("<b>URL Alice Error</b>: ".mysqli_error($connEMM));
		$rsFixULRAlice=mysqli_fetch_assoc($resultFixULRAlice);
		if($rsFixULRAlice["URLAlies"]==""){
			$sURLAlies=fFormatURL($sHeading);
			$qUpdate="UPDATE bn_content SET URLAlies='".$sURLAlies."' WHERE ContentID=".$iUpdateID;
			//echo "qUpdate: ".$qUpdate."<br>";
			mysqli_query($connEMM, $qUpdate) or die("Update URLAlies: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
		}
		mysqli_free_result($resultFixULRAlice);


		//Fix TopHome
		if($iTopHome==2){
			$qTopHome="UPDATE bn_content SET TopHome=3 WHERE TopHome=2 AND CategoryID=".$iCategory." AND ContentID!=".$iUpdateID;
			//echo "qTopHome: ".$qTopHome."<br>";
			mysqli_query($connEMM, $qTopHome) or die("Update TopHome: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
		}

		//Fix InnerTop
		if($iTopInner>1){
			if($iTopInner==2){
				$qTopInner="UPDATE bn_content SET TopInner=1 WHERE CategoryID=".$iCategory." AND TopInner=2 AND ContentID!=".$iUpdateID;
				//$qTopInner="UPDATE bn_content SET TopInner=3 WHERE ContentID!=".$iUpdateID;
				//echo "qTopInner: ".$qTopInner."<br>";
				mysqli_query($connEMM, $qTopInner) or die("Update TopInner: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
			}
			if($iTopInner==3){
				//$qTopInner="UPDATE bn_content SET TopInner=1 WHERE CategoryID=".$iCategory." AND TopInner=2 AND ContentID!=".$iUpdateID;
				$qTopInner="UPDATE bn_content SET TopInner=1 WHERE ContentID IN
	(SELECT ContentID FROM
		(SELECT ContentID, CategoryID, TopHome, TopInner FROM bn_content WHERE CategoryID=".$iCategory." AND TopInner=2 AND ContentID!=".$iUpdateID." ORDER BY ContentID DESC LIMIT 5, 10)
	AS t)";
				//echo "qTopInner: ".$qTopInner."<br>";
				mysqli_query($connEMM, $qTopInner) or die("Update TopInner: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
			}
		}

		//Fix Top-SubCategory
		if($iSubCategoryIDPos==2){
			$qSubCategoryIDPos="UPDATE bn_content SET SubCategoryIDPos=3 WHERE SubCategoryID=".$iSubCategoryID." AND SubCategoryIDPos=2 AND ContentID!=".$iUpdateID;
			//echo "qSubCategoryIDPos: ".$qSubCategoryIDPos."<br>";
			mysqli_query($connEMM, $qSubCategoryIDPos) or die("Update TopInner: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
		}


		if($sImageSMPath!=""){
			if(move_uploaded_file($_FILES["txtImageSMPath"]["tmp_name"], $UploadImageAllSM.$_FILES["txtImageSMPath"]["name"])){
				echo $sMsgUpload;
				if(isset($_SESSION["sessImageSMPathBN"])){
					//After uploading new image previous file (if exists) will be deleted
					$dir=opendir($UploadImageAllSM);
					while($fileDel=readdir($dir)){
						if($fileDel==$_SESSION["sessImageSMPathBN"]){
							unlink($UploadImageAllSM.$fileDel);
						}
					}
				}

				//Renaming the uploaded file & Creating the NEW file name
				$sExtensionSM=pathinfo($UploadImageAllSM.$sImageSMPath);
				$sNewNameSM=fFormatImageName($sExtensionSM["filename"]).".".$sExtensionSM["extension"];
				//echo "sNewNameSM: ".$sNewNameSM."<br><br>";

				$dir=opendir($UploadImageAllSM);
				while($fileRen=readdir($dir)){
					if($fileRen==$sImageSMPath){
						$iFlag=rename($UploadImageAllSM.$fileRen, $UploadImageAllSM.$sNewNameSM);

						if($iFlag==1){
							//If Rename was done properly
							//Update the new uploaded file name information into the database
							$sNewNameSMDir=$sImgDir."/SM/".$sNewNameSM;
							$qUpdate="UPDATE bn_content SET ImageSMPath='".$sNewNameSMDir."' WHERE ContentID=".$iUpdateID;
							//echo "qUpdate: ".$qUpdate."<br>";
							mysqli_query($connEMM, $qUpdate) or die("Update ImagePathSM: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));

							//***Resize SM Image***
							//1 Initialise / load image
							$sPathImageSM=$sPathProjDir."media/imgAll/".$sImgDir."/SM/".$sNewNameSM;
							//echo "sPathImageSM: ".$sPathImageSM."<br>";
							$resizeObj=new resize($sPathImageSM);
							//2 Resize image (options: exact, portrait, landscape, auto, crop)
							//echo "iImgSmWidth: ".$iImgSmWidth." - iImgSmHeight: ".$iImgSmHeight."<br>";
							$resizeObj->resizeImage($iImgSmWidth, $iImgSmHeight, 'exact');
							//4 Save image
							$resizeObj->saveImage($UploadImageAllSM.$sNewNameSM, 100);
							//***End***
						} //End of IF Flag
					}
				} //End of While


				//***Resize & Create Thumb Image***
				//echo "<b>-> In SM Img... There is no Thumb image Previously</b><br>";
				//1 Initialise / load image
				$sPathImageThumb=$sPathProjDir."media/imgAll/".$sImgDir."/SM/".$sNewNameSM;
				//echo "sPathImageThumb: ".$sPathImageThumb."<br>";
				//echo "iImgThumbWidth: ".$iImgThumbWidth." - iImgThumbHeight: ".$iImgThumbHeight."<br>";
				$resizeObjTh=new resize($sPathImageThumb);
				//2 Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObjTh->resizeImage($iImgThumbWidth, $iImgThumbHeight, 'exact');
				//3 New Name of the image
				$sNewNameThumb=fFormatImageName($sExtensionSM["filename"])."-thumb.".$sExtensionSM["extension"];
				//echo "sNewNameThumb: ".$sNewNameThumb."<br>";
				//4 Save image
				$resizeObjTh->saveImage($UploadImageAllSM.$sNewNameThumb, 100);

				$sNewNameThumb=$sImgDir."/SM/".$sNewNameThumb;
				//echo "sNewNameThumb: ".$sNewNameThumb."<br>";
				$qUpdate="UPDATE bn_content SET ImageThumbPath='".$sNewNameThumb."' WHERE ContentID=".$iUpdateID;
				//echo "qUpdate: ".$qUpdate."<br><br><br><br>";
				$rsRenameImage=mysqli_query($connEMM, $qUpdate) or die("Update ImagePathThumb: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
				//***End***

				closedir($dir);
			}else{
				echo $sMsgUploadFail;
				print_r($_FILES);
			}
		}


		if($sImageBGPath!=""){
			if(move_uploaded_file($_FILES["txtImageBGPath"]["tmp_name"], $UploadImageAll.$_FILES["txtImageBGPath"]["name"])){
				echo $sMsgUpload;
				if(isset($_SESSION["sessImageBGPathEN"])){
					//After uploading new image previous file (if exists) will be deleted
					$dir=opendir($UploadImageAll);
					while($fileDel=readdir($dir)){
						if($fileDel==$_SESSION["sessImageBGPathEN"]){
							unlink($UploadImageAll.$fileDel);
						}
					}
				}

				//Renaming the uploaded file & Creating the NEW file name
				$sExtensionBG=pathinfo($UploadImageAll.$sImageBGPath);
				$sNewNameBG=fFormatImageName($sExtensionBG["filename"]).".".$sExtensionBG["extension"];
				//echo "sNewNameBG: ".$sNewNameBG."<br><br>";

				$dir=opendir($UploadImageAll);
				while($fileRen=readdir($dir)){
					if($fileRen==$sImageBGPath){
						$iFlag=rename($UploadImageAll.$fileRen, $UploadImageAll.$sNewNameBG);

						if($iFlag==1){
							//If Rename was done properly
							//Update the new uploaded file name information into the database
							$sNewNameBGDir=$sImgDir."/".$sNewNameBG;
							$qUpdate="UPDATE bn_content SET ImageBGPath='".$sNewNameBGDir."' WHERE ContentID=".$iUpdateID;
							$rsRenameImage=mysqli_query($connEMM, $qUpdate) or die("Update ImagePathBG: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));


							//***Resize BG Image***
							//1 Initialise / load image
							$sPathImageBG=$sPathProjDir."media/imgAll/".$sImgDir."/".$sNewNameBG;
							//echo "sPathImageBG: ".$sPathImageBG."<br>";
							list($iWidthBG, $iHeightBG, $iTypeBG, $iAttrBG)=getimagesize($sPathImageBG);
							if($iWidthBG>$iImgBgWidth){
								$iRatio=$iHeightBG/$iWidthBG;
								$iImgBgHeight=$iImgBgWidth*$iRatio;
								$iImgBgHeight=intval($iImgBgHeight); //Integer Number

								$resizeObj=new resize($sPathImageBG);
								//2 Resize image (options: exact, portrait, landscape, auto, crop)
								//echo "iImgBgWidth: ".$iImgBgWidth." - iImgBgHeight: ".$iImgBgHeight."<br>";
								$resizeObj->resizeImage($iImgBgWidth, $iImgBgHeight, 'exact');
								//4 Save image
								$resizeObj->saveImage($UploadImageAll.$sNewNameBG, 100);
								//***End***
							}

						} //End of IF Flag
					}
				} //End of While
				closedir($dir);
			}else{
				echo $sMsgUploadFail;
				print_r($_FILES);
			}


			//Resize & Create Thumb Image
			if( ($sImageSMPath=="") && ($_SESSION["sessImageThumbPathEN"]=="") ){
				//If SM image is uploaded, Thumb image has already generated
				//echo "<b>-> In BG Img... There is no Thumb image Previously</b><br>";
				//1 Initialise / load image
				//If user did not uploaded small image previously
				$sPathImageThumb=$sPathProjDir."media/imgAll/".$sImgDir."/".$sNewNameBG;
				//echo "sPathProjDir: ".$sPathImageThumb."<br>";
				//echo "iImgThumbWidth: ".$iImgThumbWidth." - iImgThumbHeight: ".$iImgThumbHeight."<br>";
				$resizeObjTh=new resize($sPathImageThumb);
				//echo "Obj resize<br>";
				//2 Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObjTh->resizeImage($iImgThumbWidth, $iImgThumbHeight, 'exact');
				//echo "Function resizeImage<br>";
				//3 New Name of the image
				$sNewNameThumb=fFormatImageName($sExtensionBG["filename"])."-thumb.".$sExtensionBG["extension"];
				//echo "sNewNameThumb: ".$sNewNameThumb."<br>";
				//4 Save image
				$resizeObjTh->saveImage($UploadImageAll.$sNewNameThumb, 100);

				$sNewNameThumb=$sImgDir."/".$sNewNameThumb;
				//echo "sNewNameThumb: ".$sNewNameThumb."<br>";
				$qUpdate="UPDATE bn_content SET ImageThumbPath='".$sNewNameThumb."' WHERE ContentID=".$iUpdateID;
				//echo "qUpdate: ".$qUpdate."<br><br><br><br>";
				$rsRenameImage=mysqli_query($connEMM, $qUpdate) or die("Update ImagePathThumb: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
			}

			//Resize & Create Small Image
			if($_SESSION["sessImageSMPathBN"]==""){
				//echo "<b>-> There is no Small image Previously</b><br>";
				//If user did not uploaded small image previously
				if($sImageSMPath==""){//If user do not uploaded small image with this content
					//1 Initialise / load image
					$sPathImageBG=$sPathProjDir."media/imgAll/".$sImgDir."/".$sNewNameBG;
					//echo "sPathProjDir: ".$sPathImageBG."<br>";
					$resizeObj=new resize($sPathImageBG);
					//echo "1b. Obj resize<br>";
					//2 Resize image (options: exact, portrait, landscape, auto, crop)
					//echo "iImgSmWidth: ".$iImgSmWidth." - iImgSmHeight: ".$iImgSmHeight."<br>";
					$resizeObj->resizeImage($iImgSmWidth, $iImgSmHeight, 'exact');
					//echo "2. Function resizeImage<br>";
					//3 New Name of the image
					$sNewNameBG=fFormatImageName($sExtensionBG["filename"])."-SM.".$sExtensionBG["extension"];
					//echo "3. sNewNameBG: ".$sNewNameBG."<br>";
					//4 Save image
					$resizeObj->saveImage($UploadImageAll.$sNewNameBG, 100);

					$sNewNameBG=$sImgDir."/".$sNewNameBG;
					//echo "4a. sNewNameBG: ".$sNewNameBG."<br>";
					$qUpdate="UPDATE bn_content SET ImageSMPath='".$sNewNameBG."' WHERE ContentID=".$iUpdateID;
					//echo "4b. qUpdate: ".$qUpdate."<br><br><br><br>";
					$rsRenameImage=mysqli_query($connEMM, $qUpdate) or die("Update ImagePathSM: ".mysqli_errno($connEMM).": ".mysqli_error($connEMM));
				}
			}

		}
		echo $sMsgUpdate;
		header("Location: generateHTMLAction.php?CatID=$iCategory&SubCatID=$iSubCategoryID&SpeCatID=$iSpecialCategoryID&DistID=$iDistrictID");
		//header("Location: ".$_SESSION["sessRedirectPageBN"]);
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