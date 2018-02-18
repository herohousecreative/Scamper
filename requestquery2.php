<?php
include "include/database.php";
include "include/user.php";

display_document_center_top();

echo '
<div id="pageName"> 
  <h2>Request Report</h2>
   </div> 
  <div id="content"> 
    <div class="feature"> 
';

// ----------------------------------------------------------

echo"<h3>Current Book Requests (Grouped by Student)</h3>";
$result=select_requestquery2($studentkey,$semester,$semquery2);


echo "<h2>Total ",$semquery2," requests: ",db_numrows($result),"</h2>";
echo "<table border=\"0\" width=100%>";
echo "<TR  bgcolor=\"#666666\">";
echo "<TD width=40%><strong><font color=\"#FFFFFF\">Title</strong></font></TD>";
echo "<TD width=15%><strong><font color=\"#FFFFFF\">First Author</strong></font></TD>";
echo "<TD width=10%><strong><font color=\"#FFFFFF\">Course</strong></font></TD>";
echo "<TD width=7%><strong><font color=\"#FFFFFF\">Format</strong></font></TD>";
echo "<TD width=5%><strong><font color=\"#FFFFFF\">Sem</strong></font></TD>";
echo "<TD width=15%><strong><font color=\"#FFFFFF\">Student</strong></font></TD>";
echo "<TD width=13%><strong><font color=\"#FFFFFF\">Date Requested</strong></font></TD>";
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
  echo "<TD><a href=\"requestdetail.php?requestid=",$row["requestid"],"\">",$row["title"],"</a></TD>";
  echo "<TD>".$row["AUTHOR1LN"].",</TD>";
  echo "<TD>",$row["course"],"</TD>";
  echo "<TD>",$row["filetypes"],"</TD>";
  echo "<TD>",$row["reqsemester"],"</TD>";
  echo "<TD><a href=\"studentdetail.php?studentkey=",$row["studentid"],"\">",$row["name"],"</a></TD>";
  echo "<TD>",$row["reqdate"],"</TD>";
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

