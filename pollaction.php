<?php ob_start();include_once("common/mysqli_conneCT.php");include_once("common/config.php");

$iPollID=$_REQUEST["pollno"];

//Collect Current Data From Database
$qPoll="SELECT * FROM poll_question WHERE PollID=".$iPollID;
$resultPoll=@mysqli_query($connEMM, $qPoll) or die("");
$rsPoll=@mysqli_fetch_array($resultPoll);
$iAnsYes=$rsPoll["AnsYes"];
$iAnsNo=$rsPoll["AnsNo"];
$iAnsNoComment=$rsPoll["AnsNoComment"];
@mysqli_free_result($resultPoll);

//Collect choosed Radio from UI
$iPollAns=$_POST["rdoPoll"];
if($iPollAns==1){$iAnsYes++;}
if($iPollAns==2){$iAnsNo++;}
if($iPollAns==3){$iAnsNoComment++;}

//Update DB
$qUpdate="UPDATE poll_question SET
AnsYes=".$iAnsYes.",
AnsNo=".$iAnsNo.",
AnsNoComment=".$iAnsNoComment."
WHERE
PollID=".$iPollID;
//echo $qUpdate."<br>";
$resultUpdate=@mysqli_query($connEMM, $qUpdate) or die("");
header("Location: pollresult.php");

@mysqli_close($connEMM); ?>