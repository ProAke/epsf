<?php error_reporting (E_ALL ^ E_NOTICE);
/*****************************************************************
Created :01/10/2021
Author : worapot bhilarbutra (pros.ake)
E-mail : worapot.bhi@gmail.com
Website : https://www.vpslive.com
Copyright (C) 2021-2025, VPS Live Digital togethers all rights reserved.
*****************************************************************/


// Check Login
$sql = "SELECT * FROM `$tableAdmin` WHERE `USERNAME`='{$_SESSION['USERNAME']}' && `PASSWORD`='{$_SESSION['PASSWORD']}'";
$query = $conn->query($sql) or die($conn->error);
$total = $query->num_rows;


if($total != 1){
	header("Location: ../authentication/logout.php");
	exit;
}



// Check Menu
$arrScriptName = explode("/", $_SERVER['SCRIPT_NAME']);
$strScriptName = $arrScriptName[count($arrScriptName)-2]."/".$arrScriptName[count($arrScriptName)-1];

$sql= "SELECT * FROM `$tableAdminMenu` WHERE `URL`='$strScriptName'";
$query = $conn->query($sql) or die($conn->error);
$line = $query->fetch_assoc();


$intIdMenu = $line['ID'];

$arrPriTmp = explode(",",  "1,{$_SESSION['PRIVILEGES']}");

if(!in_array($intIdMenu,$arrPriTmp) && $intIdMenu != ""){
	header("Location: ../authentication/logout.php");
	exit;
}

?>