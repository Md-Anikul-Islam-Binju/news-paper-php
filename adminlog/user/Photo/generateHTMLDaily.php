<?php ob_start();session_cache_expire(30);session_start();
include_once("../common/mysqli_conneCT.php");require_once("../common/config.php");

$sData="";$iCounter=1;
$qPhoto="SELECT p_photo.AlbumID, p_photo.ImagePath, p_photo.Caption, p_album.AlbumName FROM p_photo INNER JOIN p_album ON p_album.AlbumID=p_photo.AlbumID WHERE p_photo.Deletable=1 AND p_photo.ShowAtHome=1 ORDER BY p_photo.PhotoID DESC LIMIT 5";
$resultPhoto=mysqli_query($connEMM, $qPhoto);
//echo $qPhoto;

while($rsPhoto=mysqli_fetch_assoc($resultPhoto)){
	$sAlbumName=$rsPhoto["AlbumName"];
	$iAlbumID=$rsPhoto["AlbumID"];
	$sURL=$sSiteURL."photogallery/".fFormatURL($sAlbumName)."/".$iAlbumID;
	if($rsPhoto["Caption"]!=""){$sCaption=$rsPhoto["Caption"];}else{$sCaption=$rsPhoto["AlbumName"];}

	if($iCounter==1){$sData.='<div class="item active">';}else{$sData.='<div class="item">';}
	$sData.='<a href="'.$sURL.'">
	<img class="img-responsive" src="'.$sSiteURL.'media/PhotoGallery/'.$rsPhoto["ImagePath"].'" alt="'.$sCaption.'">';
	if($sCaption!=""){$sData.='<div class="carousel-caption"><p>'.$sCaption.'</p></div>';}
	$sData.='</a></div>
';
	$iCounter++;
}
mysqli_free_result($resultPhoto);

//echo $sData."<br><br><br>";
$myFile=$UploadXHTML_BN."p_PhotoDaily.htm";
$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);



$sData="";$iCounter=1;
$sData.='<div class="row">
';

$resultArchives=mysqli_query($connEMM, "SELECT p_album.AlbumID, p_album.AlbumName, p_photo.ImagePath FROM p_photo INNER JOIN p_album ON p_album.AlbumID=p_photo.AlbumID WHERE p_album.Deletable=1 AND p_photo.Deletable=1 AND p_photo.ImageType=1 GROUP BY p_album.AlbumID ORDER BY p_album.AlbumID DESC LIMIT 6") or die(" ");
while($rsArchives=mysqli_fetch_assoc($resultArchives)){
$sAlbumName=$rsArchives["AlbumName"];
$iAlbumID=$rsArchives["AlbumID"];
$sURL=$sSiteURL."photogallery/".fFormatURL($sAlbumName)."/".$iAlbumID;

$sData.='	<div class="col-sm-6"><div class="DPhotoGalleryList">
		<a href="'.$sURL.'">
			<img src="'.$sSiteURL.'media/PhotoGallery/'.$rsArchives["ImagePath"].'" alt="'.$sAlbumName.'" title="'.$sAlbumName.'" class="img-responsive">
			<p>'.$sAlbumName.'</p>
		</a>
	</div></div>
';
if( ($iCounter==2) ){
$sData.='</div>

<div class="row">
';
}
$iCounter++;
}mysqli_free_result($resultArchives);

$sData.='</div>';


$myFile=$UploadXHTML_BN."p_PhotoArchives.htm";
$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);

header("Location: ".$_SESSION["sessRedirectDailyPhoto"]);
mysqli_close($connEMM); ?>