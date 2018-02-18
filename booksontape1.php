<?php
include "include/database.php";
include "include/user.php";

display_document_top();
echo '
  <div id="pageName"> 
    <h2>Books on Tape</h2> 
  </div> 
  <div id="pageNav"> 
    <div id="sectionLinks"> 
      <a href="newbook.php">Enter a new book</a> 
	<a href="books.php">Run another search</a> 
    </div> 
  </div>
  <div id="content"> 
    <div class="feature"> 
	';

$result=select_book('',$title,'tape');
if (db_numrows($result) == 0) {
   echo '<br><h3>Book not found. <a href="newbook.php">Enter a new book</a></h3><br>';
} else {
  echo "<table border=\"0\" width=100%>";
  echo "<TR  bgcolor=\"#666666\">";
  echo "<TD width=50%><strong><font color=\"#FFFFFF\">Title</strong></font></TD>";
  echo "<TD width=25%><strong><font color=\"#FFFFFF\">Author(s)</strong></font></TD>";
  echo "<TD width=10%><strong><font color=\"#FFFFFF\">Edition</strong></font></TD>";
  echo "<TD width=15%><strong><font color=\"#FFFFFF\">RFBD No.</strong></font></TD>";
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

    echo "<TD><a href=\"bookdetail.php?bookkey=",
	     $row["bookkey"],"\">",$row["ftitle"],"</a></TD>";
    echo "<TD>",$row["FAUTHOR1LN"],"</TD>\n";
    echo "<TD>",$row["FEDITION"],"</TD>\n";
    echo "<TD>",$row["frfbdnumber"],"</TD>\n";
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

