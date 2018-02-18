<?php
include "include/database.php";
include "include/user.php";

display_document_top();
$lastname = $_POST['lastname'];
//var_dump ($lastname);
echo '
  <div id="pageName"> 
    <h2>Students</h2> 
  </div> 
  <div id="pageNav"> 
    <div id="sectionLinks"> 
      <a href="newstudent.php">Enter a new student</a> 
	<a href="books.php">Run another search</a> 
    </div> 
  </div>
  <div id="content"> 
    <div class="feature"> 
';

$result=select_student($lastname,'');
if (db_numrows($result) == 0) {
   echo '<br><h3>Student not found. <a href="newstudent.php">Enter a new student.</a></h3><br>';
} else {
  echo "<table border=\"0\" width=100%>";
  echo "<TR  bgcolor=\"#666666\">";
  echo "<TD width=20%><strong><font color=\"#FFFFFF\">Student ID</strong></font></TD>";
  echo "<TD width=25%><strong><font color=\"#FFFFFF\">Name</strong></font></TD>";
  echo "<TD width=25%><strong><font color=\"#FFFFFF\">Telephone</strong></font></TD>";
  echo "<TD width=30%<strong><font color=\"#FFFFFF\">Email</strong></font></TD>";
  echo "<TD width=30%<strong><font color=\"#FFFFFF\">Maintenance</strong></font></TD>";
  echo "</TR>";

  // Set up variable to switch colors for me
  $color_switch = 0;

 while($row = mysql_fetch_array($result)) {
    if ($color_switch)
    {
      echo "<TR bgcolor=\"#cccccc\">";
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

    echo "<TD><a href=\"studentdelete.php?studentkey=",
	     $row["studentkey"],
         "\">",
		 "Delete",
		 "</a></TD>";


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
