<?php
include "include/ttedatabase.php";
include "include/tteuser.php";

display_document_center_top();
$title = $_POST['title'];
echo '
  <div id="pageName"> 
    <h2>TTE Book Query</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';

?>

<?php
$result=select_ttebook('',addslashes($title));
if (db_numrows($result) == 0) {
   echo '<br><h2>Book not found. <a href="ttenewbook.php">Enter a new book.</a></h2><br>';
} else {
  echo "<table border=\"0\" width=\"650\">";
  echo "<TR  bgcolor=\"#666666\">";
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
      echo "<TR bgcolor=\"#cccccc\">";
    }
    else
    {
      echo "<TR>";
    } //endif

    echo "<TD><a href=\"ttebookdetail.php?bookkey=",
	     $row["bookkey"],"\">",$row["ftitle"],"</a></TD>";
    echo "<TD>";
	if($row["FAUTHOR1FN"]!='')
	{
		echo $row["FAUTHOR1FN"]," ",$row["FAUTHOR1MI"]," ",$row["FAUTHOR1LN"];
	}
	if($row["FAUTHOR2FN"]!='')
	{
		echo ",", $row["FAUTHOR2FN"]," ",$row["FAUTHOR2MI"]," ",$row["FAUTHOR2LN"];
	}
	if($row["FAUTHOR3FN"]!='')
	{
		echo ",",$row["FAUTHOR3FN"]," ",$row["FAUTHOR3MI"]," ",$row["FAUTHOR3LN"];
	}
	if($row["FAUTHOR4FN"]!='')
	{
		echo ",",$row["FAUTHOR4FN"]," ",$row["FAUTHOR4MI"]," ",$row["FAUTHOR4LN"];
	}
	if($row["FAUTHOR5FN"]!='')
	{
		echo ",",$row["FAUTHOR5FN"]," ",$row["FAUTHOR5MI"]," ",$row["FAUTHOR5LN"];
	}
	if($row["FAUTHOR6FN"]!='')
	{
		echo ",",$row["FAUTHOR6FN"]," ",$row["FAUTHOR6MI"]," ",$row["FAUTHOR6LN"];
	}
	
	echo "</TD>\n";
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

}
$previous=$GLOBALS["HTTP_REFERER"];
echo "<h3><a href=\"ttenewbook.php\">Enter a new book.</a></h3><br>";
echo "<h3><a href=\"$previous\">Run another search.</a></h3><br>";

display_document_bottom();
?>

