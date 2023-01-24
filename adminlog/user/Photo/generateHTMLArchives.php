<?php ob_start();session_cache_expire(30);session_start();
include_once("../common/mysqli_conneCT.php");require_once("../common/config.php");

$sData="";$iCounter=1;
$sData.='<div class="row">
';

$resultArchives=mysqli_query($connEMM, "SELECT p_album.AlbumID, p_album.AlbumName, p_photo.ImagePath FROM p_photo INNER JOIN p_album ON p_album.AlbumID=p_photo.AlbumID WHERE p_album.Deletable=1 AND p_photo.Deletable=1 AND p_photo.ImageType=1 GROUP BY p_album.AlbumID ORDER BY p_album.AlbumID DESC LIMIT 6") or die(" ");
while($rsArchives=mysqli_fetch_assoc($resultArchives)){
$sAlbumName=$rsArchives["AlbumName"];
$iAlbumID=$rsArchives["AlbumID"];
$sURL=$sSiteURL."photogallery/".fFormatURL($sAlbumName)."/".$iAlbumID;

$sData.='	<div class="col-sm-4"><div class="DPhotoGalleryList">
		<a href="'.$sURL.'">
			<img src="'.$sSiteURL.'media/PhotoGallery/'.$rsArchives["ImagePath"].'" alt="'.$sAlbumName.'" title="'.$sAlbumName.'" class="img-responsive">
			<p>'.$sAlbumName.'</p>
		</a>
	</div></div>
';
if( ($iCounter==3) ){
$sData.='</div>

<div class="row">
';
}
$iCounter++;
}mysqli_free_result($resultArchives);

$sData.='</div>';


$myFile=$UploadXHTML_BN."p_PhotoArchives.htm";
$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);

header("Location: ".$_SESSION["sessAlbum"]);
mysqli_close($connEMM); ?>