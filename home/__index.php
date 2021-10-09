<?php error_reporting (E_ALL ^ E_NOTICE);
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
$tpl->assignInclude("body", "_tp_index.html");
$tpl->prepare();

$tpl->assign("_ROOT.user_id",$user_id);
// Menu
	$sql = "SELECT * FROM `$tableAdminMenu` WHERE `ID` = '1' AND `SHOW` = '0'  ORDER BY `ORDER` ASC";
	$query = $conn->query($sql) or die($conn->error);
	$total = $query->num_rows;

	while ($line = $query->fetch_assoc()) {

		$tpl->assign("_ROOT.backend_menu",$line['MENU']);
		$backend_menu = $line['MENU'];
		$backend_url = $line['URL'];
		$backend_icon = $line['ICON'];
	}


// Menu
$menu2 = "1";
$tpl->assign("_ROOT.hotitle","<li>
							<i class='$backend_icon'></i>
							<a href='$backend_url'>$backend_menu</a>
							<i class='fa fa-angle-right'></i>
						</li>");
GetMenuAdmin($menu2);
$page_lag=$_GET['page_lag'];
if(!isset($_GET['page_lag'])  && !isset($_SESSION['page_lag']) || $_GET['page_lag']=="" && !isset($_SESSION['page_lag']))  $page_lag="1";
if(!isset($_GET['page_lag'])  && isset($_SESSION['page_lag']) || $_GET['page_lag']=="" && isset($_SESSION['page_lag']))  $page_lag=$_SESSION['page_lag'];
GetMenuLAG($page_lag,$_GET['key'],$_GET['group'],$_GET['id']);








// Message
$tpl->newBlock("DATA");
$tpl->assign("strMessage",GetMessage(1));

if(isset($_SESSION['PRIVILEGES']) && $_SESSION['PRIVILEGES']!=''){
	$privileges = explode(',',$_SESSION['PRIVILEGES']);
	if($privileges)
	foreach($privileges as $val){
		if($val == 1){
			$tpl->newBlock("MENU1");
		}
		
		if($val == 5){
			$tpl->newBlock("MENU5");
		}

	}
	//print_r($privileges); exit();
}





$tpl->assign("_ROOT.numContents",$numContents);
$tpl->assign("_ROOT.numContentsView",$numContentsView);
$tpl->assign("_ROOT.numContents",$numContents);




////////////////////////////////////
$sql1 = "SELECT COUNT(*) FROM `$tableContents` WHERE `USER`='".$_SESSION['USERNAME']."' ";
$query1 = $conn->query($sql1) or die($conn->error);
$total1 = $query1->num_rows;
$line 	= $query1->fetch_assoc();
$intTotalItem = $line['COUNT(*)'];


////////////////////////////////////
$sql2 = "SELECT * FROM `tb_customers` WHERE `USER`='".$_SESSION['USERNAME']."' AND `STATUS`='1' ORDER BY `ID` DESC ";
$query2 = $conn->query($sql2) or die($conn->error);
$total2 = $query2->num_rows;

while($line = $query2->fetch_assoc()){
	$no++;
	$tpl->newBlock("DATA");
	$tpl->assign("no",$no);
	$tpl->assign("id",$line['ID']);
	$tpl->assign("user",$line['USER']);
	$tpl->assign("tdate",$line['TDATE']);

	$tpl->assign("post_id",$line['POST_ID']);
	$sql3 = "SELECT * FROM `$tableContents` WHERE `ID`='".$line['POST_ID']."'";
	$query3 = $conn->query($sql3) or die($conn->error);
	if ($line3 	= $query3->fetch_assoc()) {
		$tpl->assign("post_title",$line1['TITLE']);
	}
	$tpl->assign("FullName",$line['FULLNAME']);
	$tpl->assign("Phone",$line['PHONE']);
	$tpl->assign("Email",$line['EMAIL']);
	$tpl->assign("Line",$line['LINE']);
	$tpl->assign("Facebook",$line['FACEBOOK']);
	$tpl->assign("IG",$line['IG']);
	$tpl->assign("Position",$line['POSITION']);
	$tpl->assign("JobType",$line['JOBTYPE']);
	$tpl->assign("Address1",$line['ADDRESS1']);
	$tpl->assign("Address2",$line['ADDRESS2']);
	$tpl->assign("Sub_District",$line['SUB_DISTRICT']);
	$tpl->assign("District",$line['DISTRICT']);
	$tpl->assign("Province",$line['PROVINCE']);
	$tpl->assign("ZipCode",$line['ZIPCODE']);
	if($line['STATUS']=="1"){$tpl->assign("status"," มาใหม่");}
	
}


$tpl->printToScreen();
