<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Web Radio - Insert</title>
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
	$iCategory=$_REQUEST["cboCategory"];
	$sMP3Clip=$_FILES["txtMP3Clip"]["name"];

	if($sMP3Clip!=""){
		if($_FILES["txtMP3Clip"]["error"]>0){
			echo "Error Code: ".$_FILES["txtMP3Clip"]["error"]."<br>";
		}else{
			//Recognizing the media file type
			$sExtension=pathinfo($UploadWebRadio.$sMP3Clip);
			if($iCategory==1){
				//$sNewName="BanglaRadio.".$sExtension["extension"];
				$sNewName="BanglaRadio.mp3";
			}else{
				//$sNewName="EnglishRadio.".$sExtension["extension"];
				$sNewName="EnglishRadio.mp3";
			}
			echo "File Name:<b> ".$sNewName."</b><br>";
			//Uploading the new file
			echo "Uploading into:<b> ".$UploadWebRadio.$sNewName."</b><br>";
			if(file_exists($UploadWebRadio.$sNewName)){
			//If file already exists, this script will delete the file first
				echo "<b>".$UploadWebRadio.$sNewName."</b> already exists...<br>";
				unlink($UploadWebRadio.$sNewName);
				echo "<b>".$UploadWebRadio.$sNewName."</b> was Deleted...<br>";
			}
			if(move_uploaded_file($_FILES["txtMP3Clip"]["tmp_name"], $UploadWebRadio.$_FILES["txtMP3Clip"]["name"])){
				echo $UploadWebRadio.$sNewName." File was successfully <b>UPLOADED</b>...<br>";
				//Renaming the uploaded file
				//Creating the NEW file name
				$dir=opendir($UploadWebRadio);
				while($fileRen=readdir($dir)){
					if($fileRen==$sMP3Clip){$iFlag=rename($UploadWebRadio.$fileRen, $UploadWebRadio.$sNewName);} //Rename the media file
				}
				closedir($dir);
				echo $UploadWebRadio.$sNewName." File was successfully <b>RENAMED</b>...<br>";
				echo "Uploaded into the server successfully.<br><br>";
				//header("Location: webRadioInsert.php");
			}else{
				echo $sMsgUploadFail;
				print_r($_FILES);
			}
		}
	}else{ //End of If there is no file for upload
		echo "<h3 style=color:#ff0000>There is no file for uploading</h3>";
	}
} ?>
	<meta http-equiv="refresh" content="5;webRadioInsert.php">

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>