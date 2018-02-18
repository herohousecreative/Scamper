<?php
include "include/ttedatabase.php";
include "include/tteuser.php";

display_document_center_top();
$bookkey = $_GET[bookkey];
$title = $_GET[title];
//$title = $_POST['ftitle'];
//var_dump ($title);
//var_dump ($bookkey);
echo '
  <div id="pageName"> 
    <h2>TTE Book Detail</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';
?>

<?php
//----------------------------------------------------
// check for addition of new process
if ($action=='addprocess') {
  $sql="SELECT primarykey as userkey from users where username = '" .$REMOTE_USER . "'";
  $result=db_query($sql);
  $sa=db_result($result,0,"userkey");
  $result=add_process($bookkey,$startingpage,$endingpage,$process,$sa)
   or die($feedback);
}

//----------------------------------------------------
// check for book update
if ($update=='scan') {
  $sql="UPDATE books set scancomplete = 1 where primarykey=$bookkey";
} elseif ($update=='ocr') {
  $sql="UPDATE books set ocrcomplete = 1 where primarykey=$bookkey";
} elseif ($update=='check') {
  $sql="UPDATE books set checkcomplete = 1 where primarykey=$bookkey";
} elseif ($update=='tte') {
  $sql="UPDATE books set tte_hasit = 1 where primarykey=$bookkey";
} elseif ($update=='ats') {
  $sql="UPDATE books set ats_hasit = 1 where primarykey=$bookkey";
} elseif ($update=='notes') {
  $sql="UPDATE books set notes = '$notes' where primarykey=$bookkey";
}
if ($update) {
  db_query($sql) or die("There was an error with your update.");
}

//----------------------------------------------------
// begin book details

$result=select_ttebook($bookkey,'')
 or die($feedback);
$row = db_fetch_array($result);


// title, author format
echo "<table border=\"0\" width=\"650\">";
echo "<TR  bgcolor=\"#666666\">";
echo "<TD><strong><font color=\"#FFFFFF\">Title</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">Author(s)</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">Edition</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">Pub Year</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">Format</strong></font></TD>";
echo "</TR>";
echo "<TR bgcolor=\"#cccccc\">";
echo "<TD>",$row["title"],"</TD>";
echo "<TD>",$row["authors"],"</TD>";
echo "<TD>",$row["edition"],"</TD>\n";
echo "<TD>",$row["pubyear"],"</TD>\n";
echo "<TD>",$row["media"],"</TD>\n";
echo "</TR>\n";
echo "</table>";

//scan complete, ocr complete, check complete
echo "<table border=\"0\" width=\"650\">";
echo "<TR  bgcolor=\"#666666\">";
echo "<TD><strong><font color=\"#FFFFFF\">Scan Complete</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">OCR Complete</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">Check Complete</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">TTE Has It</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">ATS Has It</strong></font></TD>";
echo "</TR>";
echo "<TR bgcolor=\"#cccccc\">";
if ($row["scancomplete"]) {
 echo "<TD>YES</TD>";
} else {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=scan\">NO</a></TD>";
}
if ($row["ocrcomplete"]) {
 echo "<TD>YES</TD>";
} else {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=ocr\">NO</a></TD>";
}
if ($row["checkcomplete"]) {
 echo "<TD>YES</TD>";
} else {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=check\">NO</a></TD>";
}
if ($row["tte_hasit"]) {
 echo "<TD>YES</TD>";
} else {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=tte\">NO</a></TD>";
}
if ($row["ats_hasit"]) {
 echo "<TD>YES</TD>";
} else {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=ats\">NO</a></TD>";
}
echo "</TR>\n";
echo "</table>";

//notes
echo "<table border=\"0\" width=\"650\">";
echo "<TR  bgcolor=\"#666666\">";
echo "<TD width=25><strong><font color=\"#FFFFFF\">Notes</strong></font></TD>";
echo "</TR>";
echo "<TR bgcolor=\"#cccccc\">";
echo '<TD>
  <FORM ACTION="'. $PHP_SELF . '" METHOD="POST">
  <textarea name="notes" rows="6" cols="77">',
  $row["notes"],
  '</textarea>
  <input type="hidden" name="update" value="notes">
  <input type="hidden" name="bookkey" value="',$bookkey,'">
  <input type="submit" name="Submit" value="Update Notes"></TD></form>';
  
echo "</TR>\n";
echo "</table>";
echo "<br><hr>";

//-------------------------------------------------------
// begin book processing details

echo "<h2>Processing Details</h2>";
echo "<FORM ACTION=\"". $PHP_SELF ."\" METHOD=\"POST\">";
?>
<p>Starting Page 
  <input type="text" name="startingpage" width="25" size="10">
  Ending Page 
  <input type="text" name="endingpage" size="10">
</p>
<table width="600" border="0">
  <tr>
    <td>Scanned 
      <input type="radio" name="process" value="scanned" checked>
    </td>
    <td>OCR'ed 
      <input type="radio" name="process" value="ocred">
    </td>
    <td>Checked 
      <input type="radio" name="process" value="checked">
    </td>
    <td>Recorded 
      <input type="radio" name="process" value="recorded">
    </td>
    <td>
      <input type="submit" name="Submit" value="Add Process">
    </td>
  </tr>
</table>
<br>
<input type="hidden" name="action" value="addprocess">
  <input type="hidden" name="bookkey" value="<?php echo $bookkey ?>">
</form>


<?php
if ($result=show_progress($bookkey)) {
echo "<h3>Total processing records: ",db_numrows($result),"</h3>";
echo "<table border=\"0\" width=\"650\">";
echo "<TR  bgcolor=\"#666666\">";
echo "<TD width=150><strong><font color=\"#FFFFFF\">Job Date</strong></font></TD>";
echo "<TD width=125><strong><font color=\"#FFFFFF\">Starting Page</strong></font></TD>";
echo "<TD width=125><strong><font color=\"#FFFFFF\">Ending Page</strong></font></TD>";
echo "<TD width=125><strong><font color=\"#FFFFFF\">Process</strong></font></TD>";
echo "<TD width=125><strong><font color=\"#FFFFFF\">SA</strong></font></TD>";
echo "</TR>";

// Set up variable to switch colors for me
$color_switch = 0;

do {
  if ($color_switch)
  {
    echo "<TR bgcolor=\"#cccccc\">";
  }
  else
  {
    echo "<TR>";
  } //endif
  echo "<TD>",$row["jobdate"],"</TD>";
  echo "<TD>",$row["startingpage"],"</TD>";
  echo "<TD>",$row["endingpage"],"</TD>";
  echo "<TD>",$row["process"],"</TD>";
  echo "<TD>",$row["initials"],"</TD>\n";
  echo "</TR>\n";
  //rotate the color for the table
  if ($color_switch)
  {
    $color_switch = 0;
  } else {
    $color_switch = 1;
  }
} while ($row = db_fetch_array($result));
} else {
  echo $feedback;
}
echo "</table>";
echo "<br><hr>";

//-------------------------------------------------------
// begin students who have this book
$result=find_students($bookkey,$semester)
 or die($feedback);
echo"<h2>Current Student Requests<br>";
echo "<h3>Total requests: ",db_numrows($result),"</h3>";
echo "<table border=\"0\" width=\"650\">";
echo "<TR  bgcolor=\"#666666\">";
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
    echo "<TR bgcolor=\"#cccccc\">";
  }
  else
  {
    echo "<TR>";
  } //endif
 echo "<TD>",$row["sid"],"</TD>";
  echo "<TD><a href=\"studentdetail.php?studentkey=",$row["currentstudent"],"\">",$row["firstname"]," ",$row["lastname"],"</a></TD>";
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
echo "</table>";

display_document_bottom();
?>
