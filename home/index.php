<?php error_reporting(E_ALL ^ E_NOTICE);
/*****************************************************************
Created :01/10/2021
Author : worapot bhilarbutra (pros.ake)
E-mail : worapot.bhi@gmail.com
Website : https://www.vpslive.com
Copyright (C) 2021-2025, VPS Live Digital togethers all rights reserved.
 *****************************************************************/

include_once("../include/config.inc.php");
include_once("../include/function.inc.php");
include_once("../include/class.inc.php");
include_once("../include/class.TemplatePower.inc.php");
include_once("../authentication/check_login.php");




$tpl = new TemplatePower("../template/_tp_main.html");

if ($_SESSION['USERNAME'] == "admin") {
	$tpl->assignInclude("body", "_tp_index.html");
} else {
	$tpl->assignInclude("body", "_tp_user.html");
}

$tpl->prepare();

$tpl->assign("_ROOT.user_id", $user_id);




if ($_GET['action'] == "delete") {


	$sql = "DELETE FROM `$tableSendFiles` WHERE `ID` = '" . $_GET['id'] . "'";
	$result = $conn->query($sql) or die($conn->error);
	header("Location: {$_SERVER['HTTP_REFERER']}");
	exit;
}








$sql = "SELECT * FROM `" . $tableSendFiles . "` WHERE `USER`='" . $_SESSION['USERNAME'] . "'";
$query = $conn->query($sql) or die($conn->error);
$total = $query->num_rows;
$total = number_format($total);
$i = 0;
while ($ln = $query->fetch_assoc()) {
	$i++;
	$tpl->newBlock("LISTSEND");
	$tpl->assign("no", $i);
	$tpl->assign("id", $ln['ID']);
	$tpl->assign("title", $ln['TITLE'] . " | ");
	$tpl->assign("tdate", " | " . $ln['DATE']);
	if ($ln['FILE1']) {
		$f1 = '<img src="../static/' . $ln['FILE1_TYPE'] . '.png" height="20">';
	}
	if ($ln['FILE2']) {
		$f2 = '<img src="../static/' . $ln['FILE2_TYPE'] . '.png" height="20">';
	}
	if ($ln['FILE3']) {
		$f3 = '<img src="../static/' . $ln['FILE3_TYPE'] . '.png" height="20">';
	}
	if ($ln['FILE4']) {
		$f4 = '<img src="../static/' . $ln['FILE4_TYPE'] . '.png" height="20">';
	}
	if ($ln['FILE5']) {
		$f5 = '<img src="../static/' . $ln['FILE5_TYPE'] . '.png" height="20">';
	}

	$tpl->assign("fileicon", $f1 . $f2 . $f3 . $f4 . $f5);
}


$tpl->printToScreen();
