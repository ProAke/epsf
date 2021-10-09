<?php error_reporting (E_ALL ^ E_NOTICE);
/*****************************************************************
Created :01/10/2021
Author : worapot bhilarbutra (pros.ake)
E-mail : worapot.bhi@gmail.com
Website : https://www.vpslive.com
Copyright (C) 2021-2025, VPS Live Digital togethers all rights reserved.
*****************************************************************/

include_once("./include/config.inc.php");
include_once("./include/function.inc.php");
include_once("./include/class.inc.php");
include_once("./include/class.TemplatePower.inc.php");




$sql = "SELECT * FROM `$tableAdmin` WHERE `USERNAME`='{$_SESSION['USERNAME']}' && `PASSWORD`='{$_SESSION['PASSWORD']}'";
$query = $conn->query($sql) or die($conn->error);
$total = $query->num_rows;




if($otal != 1){
	header("Location: authentication/index.php");
	exit;
}else{
	header("Location: home/index.php");
	exit;
}

?>