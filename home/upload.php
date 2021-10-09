<?php error_reporting(E_ALL ^ E_NOTICE);
/*****************************************************************
Created :5/02/2011
Author : JIE'software 
E-mail : worapot.dmas@gmail.com
Website : www.digitalmediathai.com
Blog : www.digitalmediathai.com
Copyright (C) 2011, www.digitalmediathai.com all rights reserved.
 *****************************************************************/


include_once("../include/config.inc.php");
include_once("../include/function.inc.php");
include_once("../include/class.inc.php");
include_once("../include/class.TemplatePower.inc.php");
//include_once("../include/class.Thumbnail.php");



if ($_POST['action'] == "save") {

    $new_file1 = SaveUploadFile($_FILES['file1'], "../upload/send-files/");

    $file_name1 = $_FILES['file1']['name'];
    $file_type1 = $_FILES['file1']['type'];
    if ($file_type1 = 'application/pdf') {
        $file1_type = "pdf";
    }
    if ($file_type1 == 'image/jpeg') {
        $file1_type = "jpg";
    }
    if ($file_type1 == 'image/jpg') {
        $file1_type = "jpg";
    }
    if ($file_type1 == 'image/x-png') {
        $file1_type = "png";
    }
    if ($file_type1 == 'image/png') {
        $file1_type = "png";
    }


    $new_file2 = SaveUploadFile($_FILES['file2'], "../upload/send-files/");
    $file_name2 = $_FILES['file2']['name'];
    $file_type2 = $_FILES['file2']['type'];
    if ($file_type2 == 'application/pdf') {
        $file2_type = "pdf";
    }
    if ($file_type2 == 'image/jpeg') {
        $file2_type = "jpg";
    }
    if ($file_type2 == 'image/jpg') {
        $file2_type = "jpg";
    }
    if ($file_type2 == 'image/x-png') {
        $file2_type = "png";
    }
    if ($file_type2 == 'image/png') {
        $file2_type = "png";
    }



    $new_file3 = SaveUploadFile($_FILES['file3'], "../upload/send-files/");
    $file_name3 = $_FILES['file3']['name'];
    $file_type3 = $_FILES['file3']['type'];

    if ($file_type3 == 'application/pdf') {
        $file3_type = "pdf";
    }
    if ($file_type3 == 'image/jpeg') {
        $file3_type = "jpg";
    }
    if ($file_type3 == 'image/jpg') {
        $file3_type = "jpg";
    }
    if ($file_type3 == 'image/x-png') {
        $file3_type = "png";
    }
    if ($file_type3 == 'image/png') {
        $file3_type = "png";
    }




    $sql = "INSERT INTO " . $tableSendFiles . " (USER, TITLE, FILE1, FILE1_TYPE, FILE2, FILE2_TYPE, FILE3, FILE3_TYPE, DATE, STATUS, GR)
    VALUES ('" . $_SESSION['USERNAME'] . "',
     '" . $_POST['title'] . "',
      '" . $new_file1 . "',
       '" . $file1_type . "',
        '" . $new_file2 . "',
         '" . $file2_type . "',
          '" . $new_file3 . "',
           '" . $file3_type . "',
    '" . date("Y-m-d H:i:s") . "', 'show', '1')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?action=1");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    /* */
}
