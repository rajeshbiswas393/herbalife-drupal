<?php
error_reporting(0);
session_start();

//$con=mysqli_connect("localhost","root","","soror");
/*
db : nanoscie_devsoror
user : nanoscie_devuser
pass : WvEHeDnm3f8E4Yd
*/
$con=mysqli_connect("localhost","nanoscie_devuser","WvEHeDnm3f8E4Yd","nanoscie_devsoror");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
date_default_timezone_set("Asia/Singapore");

$domain="https://www.dev.sororedit.com/";
$siteurl=$domain."/";
$sitetitle="Share your thoughs, ideas and stories | Blogging For Passion";
$siteauthor="sororedit.com, SPT Infotech";
$sitename="sororedit.com";
$sitekeyword="Share your thoughs, ideas and stories | Blogging For Passion,blog,tech blog,tricks,hacks,technology news,fantastic blog";
$sitedesc="Soror - The Sisters Edit is a culmination of rich and diverse experiences of five sisters brought up by two dedicated mothers (sisters themselves) and doting fathers.";

$adminurl="https://www.dev.sororedit.com/admin/";
function subs_reg_cookie($name,$email,$data){
if($data==Null){
$data=array();
}
$search_value=array_search($email,$data);
if(empty($search_value)){
$new_subs_reg=array($name=>$email); 
$subs_reg=$new_subs_reg+$data; 
setcookie('subs_reg',json_encode($subs_reg),time() + (86400 * 30 * 12));
}else{
}
} ?>