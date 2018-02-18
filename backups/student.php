<?php
include "include/database.php";
include "include/user.php";
?>
<html>
<head>
<title>Student Query</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?php include "include/menubar.htm"; ?>
<h2>Student Query</h2>
<?php
$result=select_student($lastname,'');
if (db_numrows($result) == 0) {
   echo '<br><h2>Student not found. <a href="newstudent.php">Enter a new student.</a></h2><br>';
} else {
  echo "<table border=\"0\" width=\"650\">";
  echo "<TR  bgcolor=\"#660000\">";
  echo "<TD width=100><strong><font color=\"#FFFFFF\">Student ID</strong></font></TD>";
  echo "<TD width=175><strong><font color=\"#FFFFFF\">Name</strong></font></TD>";
  echo "<TD width=125><strong><font color=\"#FFFFFF\">Telephone</strong></font></TD>";
  echo "<TD width=150<strong><font color=\"#FFFFFF\">Email</strong></font></TD>";
  echo "</TR>";

  // Set up variable to switch colors for me
  $color_switch = 0;

  //while() {
  do
  {
    if ($color_switch)
    {
      echo "<TR bgcolor=\"#DBCECE\">";
    }
    else
    {
      echo "<TR>";
    } //endif

    echo "<TD>";

    echo $row["sid"];

    echo "</TD>";

    echo "<TD><a href=\"studentdetail.php?studentkey=",
	     $row["studentkey"],
         "\">",
		 $row["firstname"],
		 " ",
		 $row["lastname"],
		 "</a></TD>";
    echo "<TD>",$row["telephone"],"</TD>\n";
    echo "<TD><a href=mailto:",$row["email"],">",$row["email"],"</A></TD>\n";
    echo "</TR>\n";
    //rotate the color for the table
    if ($color_switch)
    {
      $color_switch = 0;
    } else {
      $color_switch = 1;
    }
  } while ($row = mysql_fetch_array($result));
  echo "</table>";
  echo "<br>";

}
echo "<h3><a href=\"newstudent.php\">Enter a new student.</a></h3><br>";
echo "<h3><a href=\"afhome.php\">Run another search.</a></h3><br>";
?>

