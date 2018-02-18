<?php
include "include/database.php";
include "include/user.php";

display_document_center_top();
echo '
  <div id="pageName"> 
    <h2>Add Book Request</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';
if ($_POST[select_book]) {
	add_bsrelation($_GET[studentid]);
} else {

$result=select_book('',$title,'');
if (db_numrows($result) == 0) {
   echo '<br><h2>Book not found. <a href="newbook.php">Enter a new book.</a></h2><br>';
} else {
  echo "<form action='addrequest1.php?studentid=".$_GET[studentid]."' method='post'>";
  $semcode = substr($semester,2,1);
  echo "<b>Requested Semester</b>";
  echo "<select name='semester'>";
  switch($semcode) {
    case "A":
      echo "<option>Fall</option><option selected>Spring</option><option>Summer</option>";
      break;
    case "B":
      echo "<option>Fall</option><option>Spring</option><option selected>Summer</option>";
      break;
    case "C":
      echo "<option selected>Fall</option><option>Spring</option><option>Summer</option>";
      break;
  }
  echo "</select>";
  $year = substr($semester,0,2);
  echo ", 20<input type='text' name='year' size='2' value= '".$year."'><br><br>";
  echo "<table border=\"0\" width=100%>";
  echo "<TR  bgcolor=\"#666666\">";
  echo "<TD width=5%><strong><font color=\"#FFFFFF\">Select</strong></font></TD>";
  echo "<TD width=65%><strong><font color=\"#FFFFFF\">Title</strong></font></TD>";
  echo "<TD width=20%><strong><font color=\"#FFFFFF\">Author(s)</strong></font></TD>";
  echo "<TD width=10%><strong><font color=\"#FFFFFF\">Edition</strong></font></TD>";
  
echo "</TR>";

  // Set up variable to switch colors for me
  $color_switch = 0;

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

    echo "<TD><input type='checkbox' name='bookid".$row["bookkey"]."' value='".$row["bookkey"]."'</td><td>
		<a href=\"bookdetail.php?bookkey=",
	     $row["bookkey"],"\">",$row["ftitle"],"</a></TD>";
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
  } 
  echo "</table><input type='Submit' name='select_book' value='Select Book'></form>";
  echo "<br>";

}
}
function add_bsrelation($studentid) {
	$semester = get_semester_code($_POST[semester],$_POST[year]);

echo "<h2>Book Request Results</h2>";
foreach($_POST as $key => $bookid) {
	if($bookid != $_POST[semester] && $bookid != $_POST[year] && $bookid != $_POST[select_book]) {
		echo $bookid."<br>";

		$result = insert_bsrelation($studentid, $bookid, $semester);	
		if (!result) {
			echo "There was an error when insert book ".$bookid." request. ";
		} else {

			echo "<h3>Book ".$bookid." request was successfully added</h3>";	

		}

	}

}
echo "<h3><a href='addrequest.php?studentkey=".$studentid."'>Add another request</a></h3>";
echo "<h3><a href='requestdetails.php?requestid='>View request details</a></h3>";

}

display_document_bottom();

?>

