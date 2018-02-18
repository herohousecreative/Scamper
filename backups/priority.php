<?php
include "include/database.php";
include "include/user.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Priority List</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php include "include/menubar.htm"; ?>
<h2>Priority Scanning List</h2>
<p><strong>Key:</strong><br>
  <img src="images/1.gif" alt="icon indicating that the process is complete" width="20" height="20"> 
  = process complete<br>
  S = scan<br>
  O = OCR<br>
  C = check 
<?php
  // update the priority list subroutine
  if ($button == "Update Priority") {
    $size = count($_POST);
	foreach ($_POST as $key => $priority) {
      if ($key <> "Button") {
        /* write records to database (if the priority didn't change, 
		the write operation will not update the lastupdated field) */
	    write_priority($key,$priority);
	  }
    }

    /* sort records in; ascending order by priority descending order by date/time 

    $lastpriority == 0

    while not lastrecord {
	  get record
	  record.priority == lastpriority + 1
	  lastpriority == record.priority
	  nextrecord
    } */
      


}
// end update the priority list subroutine


$result = select_priority($semester);
$num_results = mysql_num_rows($result);
echo "<p>Number of books: ".$num_results."</p>";

if (db_numrows($result) == 0) {
   echo $feedback;
   echo $sql;
} else {
  
  // display the priority list
  echo '<form name="pform" method="post" action="' .$PHP_SELF. '">';
  echo '<input type="submit" name="button" value="Update Priority">';
  echo "<table width=\"100%\" cellpadding=\"1\">";
  echo "<TR bgcolor=\"#660000\">";
  echo "<TD width=\"25\">
		<strong>
		<font color=\"#FFFFFF\">
		Priority
		</font>
		</strong>
		</TD>";
  echo "<TD width=\"400\">
 			<strong>
			<font color=\"#FFFFFF\">
					Title
				</font>
			</strong>
		</TD>";
  echo "<TD width=\"20\" align=\"center\">
  			<strong>
				<font color=\"#FFFFFF\">
					S
				</font>
			</strong>
		</TD>";
  echo "<TD width=\"20\" align=\"center\">
  			<strong>
				<font color=\"#FFFFFF\">
					O
				</font>
			</strong>
		</TD>";
  echo "<TD width=\"20\" align=\"center\">
  			<strong>
				<font color=\"#FFFFFF\">
					C
				</font>
			</strong>
		</TD>";
  echo "<TD width=\"475\">
  			<strong>
				<font color=\"#FFFFFF\">
					Notes
				</font>
			</strong>
		</TD>";
  echo "</TR>";

  // Set up variable to switch colors for me
  $color_switch = 0;

  // iterate through the rows
  for ($i=0; $i <$num_results; $i++)
  {
     $row = mysql_fetch_array($result);

     //switch the row color
     if ($color_switch)
    {
      echo "<TR bgcolor=\"#DBCECE\">";
    }
    else
    {
 	  echo "<TR>";
    } 

    echo '<TD align="center"><input name="'
	. $row["primarykey"] .
	'" type="text" size="3" maxlength="3" value="' 
	. $row["priority"] . 
	'" /></TD><TD><a href="bookdetail.php?bookkey=' 
	. $row["primarykey"] .
	'">' 
	.$row["title"] . 
	'</a></TD><TD align="center"><img src="/images/' 
	. $row["scancomplete"] . 
	'.gif" /></TD><TD align="center"><img src="/images/' 
	. $row["ocrcomplete"] . 
	'.gif" /></TD><TD align="center"><img src="/images/' 
	. $row["checkcomplete"] . 
	'.gif" /></TD><TD>' 
	. $row["notes"] .
	'</TD></TR>';
	
    //rotate the color for the table
    if ($color_switch)
      {
        $color_switch = 0;
      } else {
        $color_switch = 1;
      }

    }
  echo "</table>";
  echo "</form>";
  echo "<br>";
}

?>
</body>
</html>