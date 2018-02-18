<?php
include "include/database.php";
include "include/user.php";
?>
<html>
<head>
<title>Add a Request</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">

<?php
$result=select_bookset($title,$currentstudentkey)
 or die($feedback);
echo "<table border=\"0\" width=\"650\">";
echo "<TR  bgcolor=\"#660000\">";
echo "<TD width=150><strong><font color=\"#FFFFFF\">Title</strong></font></TD>";
echo "<TD width=175><strong><font color=\"#FFFFFF\">Author(s)</strong></font></TD>";
echo "<TD width=50><strong><font color=\"#FFFFFF\">Edition</strong></font></TD>";
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
  } //endif       window.open(whereto, '_top')
  echo "<TD><a href=\"javascript: window.opener.top.location.href = 'studentdetail.php?method=add&bookkey=",
  $row["FTTEBOOKID"],"&studentkey=$currentstudentkey';self.close();\">",$row["ftitle"],"</a></TD>";
  echo "<TD>",$row["FAUTHOR1LN"],"</TD>\n";
  echo "<TD>",$row["FEDITION"],"</TD>\n";
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
?>

