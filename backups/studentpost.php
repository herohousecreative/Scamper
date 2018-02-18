<?php
include "include/database.php";
include "include/user.php";
?>
<html>
<head>
<title>Student Posted</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">

<?php
$result=insert_student($sid,$firstname,$lastname,$telephone,$email);
if (!$result) {
  echo 'There was an error in you post.';
} else {
  $id = mysql_insert_id();
  echo "<h2>Student posted successfully.</h2><br><a href=\"studentdetail.php?studentkey=$id\">Add requests for $firstname $lastname</a><br><a href=\"index.php\">Return to homepage</a><br><a href=\"newstudent.php\">Add another student.</a>";
}
?>


