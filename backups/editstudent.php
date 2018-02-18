<?php
include "include/database.php";
include "include/user.php";
?>
<html>
<head>
<title>Edit Student</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "include/menubar.htm"; ?>
<?php
$result=select_student('xyz',$studentkey)
 or die($feedback);
$row = mysql_fetch_array($result);
echo "<h2>Edit Student Information </h2>
  <form action=\"studentdetail.php?method=edit\" method=\"post\">
  <p>Student ID Number (123-45-6789):  
    <input type=\"text\" name=\"sid\" value=\"",$row["sid"],"\">
  </p>
  <p>FirstName: 
    <input type=\"text\" name=\"firstname\" value=\"",$row["firstname"],"\">
    Last Name: 
    <input type=\"text\" name=\"lastname\" value=\"",$row["lastname"],"\">
  </p>
  <p>Telephone (999)123-4567: 
    <input type=\"text\" name=\"telephone\" value=\"",$row["telephone"],"\">
  </p>
  <p>Email: 
    <input type=\"text\" name=\"email\" size=\"75\" value=\"",$row["email"],"\">
    <input type=\"submit\" name=\"Submit\" value=\"Update\">";
  echo "<input type=\"hidden\" name=\"studentkey\" value=\"",$studentkey,"\">";	
  echo "</p></form>";
?>
