<?php ob_start();session_cache_expire(30);session_start();require_once("common/mysqli_conneCT.php");require_once("common/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $sAdmnTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once("common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once("common/menuLeft.php"); ?></td>
<td align="center" valign="middle">
<div class="DContent">
<h1>Welcome to dashboard</h1>

<p>TheDash</p>
<!-- iframe src="https://www.thedash.com/dashboard/B1XpWXrKb/embed" width="100%" height="500px" style="margin:0;border-width:0;overflow:hidden;" scrolling="yes" ></iframe>
<table border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="left" valign="top">
	<p>Real-Time Time Frame</p>
	<iframe id="dMqhXbol82" width="500" height="350" style="margin:0;border-width:0;border:1px solid #ccc;overflow:hidden;" frameborder="0" hspace="0" vspace="0" marginheight="0" marginwidth="0" scrolling="no" src="https://www.embeddedanalytics.com/reports/displayreport?reportcode=dMqhXbol82&chckcode=gaJJEypPFUzgHMdJsGl4qV" title="Reporting Tool for Google Analytics and Google Adwords."></iframe>
</td>
<td align="right" valign="top">
	<p align="left">Real-Time</p>
	<iframe id="pXrSauy6t9" width="500" height="350" style="margin:0;border-width:0;overflow:hidden;" scrolling="no" src="https://www.embeddedanalytics.com/reports/displayreport?reportcode=pXrSauy6t9&chckcode=gaJJEypPFUzgHMdJsGl4qV" title="Reporting Tool for Google Analytics and Google Adwords."></iframe>
</td>
</tr>
</table -->
</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once("common/footer.php"); ?></td></tr>
</table>
</body>
</html>