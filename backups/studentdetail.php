<?php
include "include/database.php";
include "include/user.php";
?>
<html>
<head>
<title>Student Detail</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
<!-- hide me
function addBook()
{
<?php
//  window.opener.top.location.href =('addbook.php','Add_Request','location=no,status=no,menubar=no,width=300,height=300,toolbar=no,directories=no');
echo "window.open('addbook.php?currentstudentkey=" . $studentkey . "&title=" . $title . "','addWindow','location=no,status=no,scrollbars=yes,menubar=no,width=700,height=400,toolbar=no,directories=no');"
?>
}

// end hide -->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?php include "include/menubar.htm"; ?>
<h2>Student Detail</h2>

<?php
if ($method=='add') {
  $result=add_book($studentkey,$bookkey,$semester)
    or die($feedback);
}

if ($method=='edit') {
  $result=student_edit($studentkey,$sid,$firstname,$lastname,$telephone,$email)
    or die($feedback);
}

//if ($method=='delete') {
// $result=bs_delete($bskey)
//    or die($feedback);
//}


$result=select_student('xyz',$studentkey)
 or die($feedback);
echo "<table border=\"0\" width=\"650\">";
echo "<TR  bgcolor=\"#660000\">";
echo "<TD width=100><strong><font color=\"#FFFFFF\">Student ID</strong></font></TD>";
echo "<TD width=175><strong><font color=\"#FFFFFF\">Name</strong></font></TD>";
echo "<TD width=125><strong><font color=\"#FFFFFF\">Telephone</strong></font></TD>";
echo "<TD width=150<strong><font color=\"#FFFFFF\">Email</strong></font></TD>";
echo "</TR>";

// Set up variable to switch colors for me
$color_switch = 0;

do {
  if ($color_switch)
  {
    echo "<TR bgcolor=\"#DBCECE\">";
  }
  else
  {
    echo "<TR>";
  } //endif
  echo "<TD>",$row["sid"],"</TD>";
  echo "<TD><a href=\"editstudent.php?studentkey=",$studentkey,"\">",$row["firstname"]," ",$row["lastname"],"</a></TD>";
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
} while ($row = db_fetch_array($result));
echo "</table><br>";


echo "<h2><a href='javascript:addBook();'>Add a book request.</a></h2>";


echo "<br><hr>";


// ----------------------------------------------------------

$result=select_requests($studentkey,$semester)
 or die($feedback);
echo"<h2>Current Book Requests<br>";
echo "<h3>Total requests: ",db_numrows($result),"</h3>";
echo "<table border=\"0\" width=\"650\">";
echo "<TR  bgcolor=\"#660000\">";
echo "<TD><strong><font color=\"#FFFFFF\">Title</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">Author(s)</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">Format</strong></font></TD>";
//echo "<TD><strong><font color=\"#FFFFFF\">Delete</strong></font></TD>";
echo "</TR>";

// Set up variable to switch colors for me
$color_switch = 0;

do {
  if ($color_switch)
  {
    echo "<TR bgcolor=\"#DBCECE\">";
  }
  else
  {
    echo "<TR>";
  } //endif
  echo "<TD><a href=\"bookdetail.php?bookkey=",$row["bookkey"],"\">",$row["title"],"</a></TD>";
  echo "<TD>",$row["authors"],"</TD>";
  echo "<TD>",$row["media"],"</TD>";
//   echo "<TD><a href=\"studentdetail.php?method=delete&bskey=",$row["bskey"],"studentkey=",$studentkey,"\">Delete</a></TD>";
  echo "</TR>\n";
  //rotate the color for the table
  if ($color_switch)
  {
    $color_switch = 0;
  } else {
    $color_switch = 1;
  }
} while ($row = db_fetch_array($result));
echo "</table>";
?>

