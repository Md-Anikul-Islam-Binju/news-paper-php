<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Poll - Insert</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMMEn;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<!-- DatePicker -->
<?php echo $jsjQueryUI; ?>
<?php echo $cssjQueryUI; ?>
<script type="text/javascript">
function setfocus(){document.frmInsert.txtQuestionBN.focus();}$(document).ready(function(){$("#frmInsert").validate();});
$(function(){$("#txtTodayDate").datepicker();});
</script>
</head>
<body onload="setfocus();">
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<form id="frmInsert" name="frmInsert" method="post" action="pollDetailsInsertAction.php" enctype="multipart/form-data">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="2">Poll - Insert</th></tr>
	<tr>
		<td align="right" valign="middle">Visible Date:</td>
		<td align="left" valign="middle">
		<input type="Text" id="txtTodayDate" name="txtTodayDate" maxlength="10" size="25" class="required" value="<?php echo date("m/d/Y"); ?>" required autofocus><?php echo $sMsgRequired; ?>
		</td>
	</tr>
	<tr>
		<td align="right" valign="middle">Question (Bangla):</td>
		<td align="left" valign="middle"><input type="text" name="txtQuestionBN" id="txtQuestionBN" maxlength="300" class="inpBN required" value=""><?php echo $sMsgRequired; ?></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Question (English):</td>
		<td align="left" valign="middle"><input type="text" name="txtQuestionEN" id="txtQuestionEN" maxlength="300" value=""></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Remarks:</td>
		<td align="left" valign="middle"><textarea name="txtRemarks" class="txtBN1"></textarea></td>
	</tr>
	<tr><td colspan="2" align="center" valign="middle"><input type="submit" name="btnSubmit" value="Insert" class="inpSubmit"></td></tr>
	</table>
	</form>

	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr class="TrHeadings">
		<th>Visible Date</th>
		<th>Question (Bangla)</th>
		<th>Question (English)</th>
		<th>Remarks</th>
		<th>Result</th>
		<th class="Td50">UPDATE</th>
		<th class="Td50">DELETE</th>
	</tr>
	<?php $rowsPerPage=20;$pageNum=1;
	if(isset($_GET["page"])){$pageNum=$_GET["page"];}
	$offset=($pageNum-1)*$rowsPerPage;
	$qPollDetails="SELECT * FROM poll_question WHERE Deletable=1 ORDER BY PollID DESC LIMIT $offset, $rowsPerPage";
	$resultPollDetails=mysqli_query($connEMM, $qPollDetails) or die(mysqli_error($connEMM));
	while($rsPollDetails=mysqli_fetch_assoc($resultPollDetails)){ ?>
	<tr class="TrUpdateListSelect">
		<td align="left" class="tdBn"><?php echo $rsPollDetails["PollDate"]; ?></td>
		<td align="left" class="tdBn"><?php echo $rsPollDetails["PollQuestionBN"]; ?></td>
		<td align="left"><?php echo $rsPollDetails["PollQuestionEN"]; ?></td>
		<td align="left" class="tdBn"><?php echo $rsPollDetails["Remarks"]; ?></td>
		<td align="left" class="tdBn">00</td>
		<td align="center"><a href="pollDetailsUpdate.php?updateid=<?php echo $rsPollDetails["PollID"]; ?>">Update</a></td>
		<td align="center"><a href="pollDetailsDelete.php?deleteid=<?php echo $rsPollDetails["PollID"]; ?>" onclick="return confirmDelete();">Delete</a></td>
	</tr>
	<?php }mysqli_free_result($resultPollDetails); ?>

	<tr><td valign="top" colspan="8">
	<?php $qCoutner="SELECT COUNT(PollID) AS numrows FROM poll_question WHERE Deletable=1";
	$result=mysqli_query($connEMM, $qCoutner) or die("Error, query failed");
	$row=mysqli_fetch_assoc($result);
	$numrows=$row["numrows"];
	$maxPage=ceil($numrows/$rowsPerPage);
	$self=$_SERVER["PHP_SELF"];
	$nav="";

	for($page=1;$page<=$maxPage;$page++){if($page==$pageNum){$nav.=" $page ";}else{$nav.=" <a href=\"$self?page=$page\">$page</a> ";}}
	if($pageNum>1){
		$page=$pageNum-1;
		$prev=" <a href=\"$self?page=$page\">[Prev]</a> ";
		$first=" <a href=\"$self?page=1\">[First Page]</a> ";
	}else{$prev="&nbsp;";$first="&nbsp;";}
	if($pageNum<$maxPage){
		$page=$pageNum+1;
		$next=" <a href=\"$self?page=$page\">[Next]</a> ";
		$last=" <a href=\"$self?page=$maxPage\">[Last Page]</a> ";
	}else{$next="&nbsp;";$last="&nbsp;";}mysqli_free_result($result); ?>
	<div class="DPaginationL"><?php echo $first.$prev; ?></div><div class="DPaginationR"><?php echo $next.$last; ?></div>
	</td></tr>
	</table>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>