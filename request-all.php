<?php
include "include/database.php";
include "include/user.php";

display_document_center_top();

echo '
  <div id="pageName"> 
  <h3>All Received Requests for the ' . $semester . ' semester (grouped by student name)</h3> 
  </div> 

  <div id="content"> 
    <div class="feature"> 
';

$previous=$GLOBALS["HTTP_REFERER"];

$sql = "SELECT *, BOOKREQUEST.notes, reqdate, filetypes, requestid, studentid, title, concat(firstname,\" \",lastname) as name, reqsemester from BOOKREQUEST
	  left join STUDENTS on BOOKREQUEST.studentid = STUDENTS.primarykey WHERE (accepted = 1 or retired='N' or retired='Y') and (reqsemester = '" . $semester . "' or reqsemester = '" . $nextsemester . "') order BY lastname, firstname, title";
$result= db_query($sql);

if (db_numrows($result) == 0) {
   echo '<br>There are no requests! You can <a href="newbook.php">enter a new book.</a><br>';
} else {
  echo "<table border=\"0\" width=100%>";
  echo "<TR  bgcolor=\"#666666\">";
  echo "<TD width=35%><strong><font color=\"#FFFFFF\">Title</strong></font></TD>";
  echo "<TD width=5%><strong><font color=\"#FFFFFF\">Format</strong></font></TD>";
  echo "<TD width=10%><strong><font color=\"#FFFFFF\">Course</strong></font></TD>";
  echo "<TD width=20%><strong><font color=\"#FFFFFF\">Reason, if declined</strong></font></TD>";
  echo "<TD width=15%><strong><font color=\"#FFFFFF\">Student</strong></font></TD>";
  echo "<TD width=5%><strong><font color=\"#FFFFFF\">Sem</strong></font></TD>";
  echo "<TD width=10%><strong><font color=\"#FFFFFF\">Date Requested</strong></font></TD>";
  echo "</TR>";

  // Set up variable to switch colors for me
  $color_switch = 1;

  //while() {
  while ($row = mysql_fetch_array($result)) {
    if ($color_switch)
    {
      echo "<TR bgcolor=\"#cccccc\">";
    }
    else
    {
      echo "<TR>";
    } //endif
    
    $semester = get_semester_name($row["reqsemester"]);
    echo "<TD>",$row["title"],"</TD>";
	echo "<TD>",$row["filetypes"],"</TD>";
	echo "<TD>",$row["course"],"</TD>";
	echo "<TD>",$row["retired_reason"],"</TD>";
    echo "<TD><a href=\"studentdetail.php?studentkey=",
	     $row["studentid"],"\">",$row["name"],"</a></TD>\n";
    echo "<TD>",$row["reqsemester"],"</TD>\n";
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
  echo "</table>";
  echo "<br>";

}

display_document_bottom();

?>
