<?php
include "include/ttedatabase.php";
include "include/tteuser.php";

display_document_center_top();
echo '
  <div id="pageName"> 
    <h2>TTE Books to Review</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';

?>

<?php
$result=select_ttebookreview('',$title);
if (db_numrows($result) == 0) {
   echo '<br><h2>Book not found. <a href="ttenewbook.php">Enter a new book.</a></h2><br>';
} else {
  echo "<table border=\"0\" width=\"100%\">";
  echo "<TR  bgcolor=\"#666666\">";
  echo "<TD><strong><font color=\"#FFFFFF\">TTE Flag</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">TTE Member</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Title</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Author(s)</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Edition</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Pub Year</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Format(s)</strong></font></TD>";
  
  echo "</TR>";

  // Set up variable to switch colors for me
  $color_switch = 0;

  //while() {
  do
  {
    if ($color_switch)
    {
      echo "<TR bgcolor=\"#cccccc\">";
    }
    else
    {
      echo "<TR>";
    } //endif
	echo "<TD>",$row["fmaintflag1"],"</TD>\n";
	echo "<TD>",$row["ftteid"],"</TD>\n";
    echo "<TD><a href=\"bookdetail.php?bookkey=",
	     $row["bookkey"],"\">",$row["ftitle"],"</a></TD>";
    echo "<TD>";
	if($row["FAUTHOR1FN"]!='')
	{
		echo $row["FAUTHOR1LN"];
	}
	
	
	echo "</TD>\n";
    echo "<TD>",$row["FEDITION"],"</TD>\n";
	echo "<TD>",$row["FYEARPUB"],"</TD>\n";
	echo "<TD>",$row["ffiletypes"],"</TD>\n";
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
$previous=$GLOBALS["HTTP_REFERER"];


display_document_bottom();
?>

