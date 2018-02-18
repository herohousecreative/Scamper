<?php
include "include/database.php";
include "include/user.php";

display_document_center_top();

echo '
<div id="pageName"> 
  <h2>Request Summary</h2>
   </div> 
  <div id="content"> 
    <div class="feature"> 
';

// ----------------------------------------------------------

echo"<h3>All Book Requests (alphabetical)</h3>";
$result=select_allrequests($studentkey,$semester);

$year=substr($semester,0,2);
$season=$semester[2];

echo "<h2>Total requests: ",db_numrows($result),"!</h2>";
echo "<table border=\"0\" width=100%>";
echo "<TR  bgcolor=\"#666666\">";
echo "<TD width=48%><strong><font color=\"#FFFFFF\">Title</strong></font></TD>";
echo "<TD width=20%><strong><font color=\"#FFFFFF\">First Author</strong></font></TD>";
echo "<TD width=7%><strong><font color=\"#FFFFFF\">Format</strong></font></TD>";
echo "<TD width=5%><strong><font color=\"#FFFFFF\">Sem</strong></font></TD>";
echo "<TD width=20%><strong><font color=\"#FFFFFF\">Student</strong></font></TD>";
echo "</TR>";

if (!$result) {
	echo "<h2>".$feedback."</h2>";
} else {


// Set up variable to switch colors for me
$color_switch = 1;

 while ($row = db_fetch_array($result)) {
  if ($color_switch)
  {
    echo "<TR bgcolor=\"#cccccc\">";
  }
  else
  {
    echo "<TR>";
  } //endif
  echo "<TD><a href=\"requestdetail.php?requestid=",$row["bskey"],"\">",$row["ftitle"],"</a></TD>";
  echo "<TD>".$row["FAUTHOR1LN"].", ".$row["FAUTHOR1FN"]."</TD>";
  echo "<TD>",$row["ffiletypes"],"</TD>";
  echo "<TD>",$row["reqsemester"],"</TD>";
  echo "<TD><a href=\"studentdetail.php?studentkey=",$row["studentkey"],"\">",$row["firstname"]," ",$row["lastname"],"</a></TD>";
  echo "</TR>\n";
  //rotate the color for the table
  if ($color_switch)
  {
    $color_switch = 0;
  } else {
    $color_switch = 1;
  }
}

}

if($season == 'A')
{
	$semester1 = sprintf("%sB", $year);
	$result = select_requests($studentkey, $semester1);

 	while ($row = db_fetch_array($result)) {
	  if ($color_switch)
	  {
	    echo "<TR bgcolor=\"#cccccc\">";
	  }
	  else
	  {
	    echo "<TR>";
	  } //endif
	  echo "<TD><a href=\"requestdetail.php?requestid=",$row["bskey"],"\">",$row["ftitle"],"</a></TD>";
	  echo "<TD>".$row["FAUTHOR1LN"].", ".$row["FAUTHOR1FN"]."</TD>";
	  echo "<TD>",$row["ffiletypes"],"</TD>";
	  echo "<TD>",$row["reqsemester"],"</TD>";
	  echo "<TD>",$row["firstname"]," ",$row["lastname"],"</TD>";
	  echo "</TR>\n";
	  //rotate the color for the table
	  if ($color_switch)
	  {
	    $color_switch = 0;
	  } else {
	    $color_switch = 1;
	  }
	}

}

if($season == 'B' || $season == 'A')
{
	$semester1 = sprintf("%sC", $year);
	$result = select_requests($studentkey, $semester1);

 	while ($row = db_fetch_array($result)) {
	  if ($color_switch)
	  {
	    echo "<TR bgcolor=\"#cccccc\">";
	  }
	  else
	  {
	    echo "<TR>";
	  } //endif
	  echo "<TD><a href=\"requestdetail1.php?requestid=",$row["bskey"],"\">",$row["ftitle"],"</a></TD>";
	  echo "<TD>".$row["FAUTHOR1LN"].", ".$row["FAUTHOR1FN"]."</TD>";
	  echo "<TD>",$row["ffiletypes"],"</TD>";
	  echo "<TD>",$row["reqsemester"],"</TD>";
	  echo "<TD>",$row["firstname"]," ",$row["lastname"],"</TD>";
	  echo "</TR>\n";
	  //rotate the color for the table
	  if ($color_switch)
	  {
	    $color_switch = 0;
	  } else {
	    $color_switch = 1;
	  }
	}
}
echo "</table>";
echo "<br><hr>";


display_document_bottom();

?>

