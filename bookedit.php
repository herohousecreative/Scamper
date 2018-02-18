<?php
include "include/database.php";
include "include/user.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Edit Book</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php include "include/menubar.htm"; ?>
<h2>Book Detail</h2>
<?php
$result=select_book($bookkey,'')
 or die($feedback);
$row = db_fetch_array($result);


// title, author format
echo "<table border=\"0\" width=\"650\">\n";
echo "<TR  bgcolor=\"#660000\">\n";
echo "<TD><strong><font color=\"#FFFFFF\">Title</strong></font></TD>\n";
echo "<TD><strong><font color=\"#FFFFFF\">Author(s)</strong></font></TD>\n";
echo "<TD><strong><font color=\"#FFFFFF\">Edition</strong></font></TD>\n";
echo "<TD><strong><font color=\"#FFFFFF\">Pub Year</strong></font></TD>\n";
echo "<TD><strong><font color=\"#FFFFFF\">Publisher</strong></font></TD>\n";
echo "</TR>\n";
echo "<TR bgcolor=\"#DBCECE\">\n";
echo "<TD>",$row["title"],"</TD>\n";
echo "<TD>",$row["authors"],"</TD>\n";
echo "<TD>",$row["edition"],"</TD>\n";
echo "<TD>",$row["pubyear"],"</TD>\n";
echo "<TD>",$row["publisher"],"</TD>\n";
echo "</TR>\n";
echo "</table>\n";

// format
echo "<table border=\"0\" width=\"650\">\n";
echo "<TR  bgcolor=\"#660000\">\n";
echo "<strong><font color=\"#FFFFFF\">Format</strong></font>\n";
echo "</TR>\n";
echo "<TR bgcolor=\"#DBCECE\">\n";
$formats = explode(",",$row["media"]);
$labels = array("HTML","TXT","PDF","BRF","DXB","DOC","RTF","RFB","VOL");
foreach($labels as $curlabel) {
  if (in_array("$curlabel",$formats)) {
    echo "<TD>$curlabel<input type=\"checkbox\" name=\"$curlabel\" value=\"$curlabel\" checked></TD>\n";
  } else {
    echo "<TD>$curlabel<input type=\"checkbox\" name=\"$curlabel\" value=\"$curlabel\"></TD>\n";
  }
}
echo "</TR></TABLE>\n";

//scan complete, ocr complete, check complete
echo "<table border=\"0\" width=\"650\">";
echo "<TR  bgcolor=\"#660000\">";
echo "<TD><strong><font color=\"#FFFFFF\">Scan Complete</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">OCR Complete</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">Check Complete</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">TTE Has It</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">ATS Has It</strong></font></TD>";
echo "</TR>";
echo "<TR bgcolor=\"#DBCECE\">";
if ($row["scancomplete"]) {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=unscan\">YES</a></TD>";
} else {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=scan\">NO</a></TD>";
}
if ($row["ocrcomplete"]) {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=unocr\">YES</a></TD>";
} else {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=ocr\">NO</a></TD>";
}
if ($row["checkcomplete"]) {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=uncheck\">YES</a></TD>";
} else {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=check\">NO</a></TD>";
}
if ($row["tte_hasit"]) {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=untte\">YES</a></TD>";
} else {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=tte\">NO</a></TD>";
}
if ($row["ats_hasit"]) {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=unats\">YES</a></TD>";
} else {
 echo "<TD><a href=\"" .$PHP_SELF ."?bookkey=" . $bookkey . "&update=ats\">NO</a></TD>";
}
echo "</TR>\n";
echo "</table>";

//notes
echo "<table border=\"0\" width=\"650\">";
echo "<TR  bgcolor=\"#660000\">";
echo "<TD width=25><strong><font color=\"#FFFFFF\">Notes</strong></font></TD>";
echo "</TR>";
echo "<TR bgcolor=\"#DBCECE\">";
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
?>

</body>
</html>
