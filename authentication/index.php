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



if ($_POST['username'] != "" && $_POST['password'] != "") {

	$sql = "SELECT * FROM `$tableAdmin` WHERE `USERNAME`='{$_POST['username']}' && `PASSWORD`='{$_POST['password']}'";
	$query = $conn->query($sql) or die($conn->error);
	$total = $query->num_rows;

	if ($total  == 1) {

		$line = $query->fetch_assoc();
		$_SESSION['USERNAME'] = $line['USERNAME'];
		$_SESSION['PASSWORD'] = $line['PASSWORD'];
		$_SESSION['PRIVILEGES'] = $line['PRIVILEGES'];
		$_SESSION['LAST_LOGIN'] = $line['LAST_LOGIN'];
		$_SESSION['THUMB'] = $line['THUMB'];
		$_SESSION['ADMIN_NAME'] = $line['NAME'];
		$_SESSION['ID'] = $line['ID'];

		// Update Last Login
		$sql1 = "UPDATE `$tableAdmin` SET `LAST_LOGIN`=NOW(),`COUNT`=`COUNT`+1 WHERE `USERNAME`='{$_POST['username']}' && `PASSWORD`='{$_POST['password']}'";
		if ($conn->query($sql1) === TRUE) {
			header("Location: ../home/index.php");
			exit;
		}
	} else {

		// รหัสผ่านผิด
		$tpl = new TemplatePower("../template/_tp_login.html");
		$tpl->assignInclude("body", "_tp_index.html");
		$tpl->prepare();

		$tpl->newBlock("ERROR");
		//$tpl->assign("strMessage",GetMessage(2));
		$sql2   = "SELECT * FROM `$tableMessage` WHERE `ID`='2'";
		$query2 = $conn->query($sql2) or die($conn->error);
		$line2  = $query2->fetch_assoc();
		$tpl->assign("strMessage", nl2br($line2['MESSAGE']));

		$sql_set = "SELECT * FROM `$tableSetting` WHERE `LAG` = '1'";
		$query_set = $conn->query($sql_set) or die($conn->error);

		while ($line_set = $query_set->fetch_assoc()) {

			$tpl->newBlock("LOGO");
			if ($line_set['LOGO'] != "") {
				if (is_file("../upload/setting/full/img/" . $line_set['LOGO'])) {
					$tpl->assign("setting_logo", "<img src='../upload/setting/full/img/" . $line_set['LOGO'] . "'>");
					$tpl->assign("setting_logo2", "../upload/setting/full/img/" . $line_set['LOGO']);
				}
			}

			$tpl->newBlock("FAVICON");
			if ($line_set['FAVICON'] != "") {
				if (is_file("../upload/setting/full/img/" . $line_set['FAVICON'])) {
					$tpl->assign("setting_favicon", "../upload/setting/full/img/" . $line_set['FAVICON'] . "");
				}
			}
		}

		$tpl->newBlock("FORM");
	}
} else {

	$tpl = new TemplatePower("../template/_tp_login.html");
	$tpl->assignInclude("body", "_tp_index.html");
	$tpl->prepare();

	$sql_set1 	 = "SELECT * FROM `$tableSetting` WHERE `LAG` = '1'";
	$result_set1 = $conn->query($sql_set1) or die($conn->error);

	$tpl->newBlock("FORM");
}




$tpl->printToScreen();
