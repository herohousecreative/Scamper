<?php
include "include/database.php";
include "include/user.php";

display_document_center_top();

echo '
  <div id="pageName"> 
  <h2>Priority Scanning List</h2>
   </div> 
  <div id="content"> 
    <div class="feature"> 
<table width=100%>
	<tr valign=top>
		<td>
		<strong>Key:</strong><br>
  		S = scan<br>
  		O = OCR<br>
  		C = check<br>
		<img src="images/1.gif" alt="icon indicating that the process is complete" width="20" height="20"> 
  		= process complete
		</td>
		<td>
		<strong>Priority ranking</strong><br>
		Null: New Requests - Need publisher permission request submitted.<br>
		0: Books that need to be purchased / waiting to hear from publisher<br>
		1-79: Books currently in processing (1-10 for VI students, 11-69 for LD students, 70 pre-orders)<br>
		80: Books currently in processing that need to be recorded as MP3s<br>
		90: Books to be finished in entirety after all other required sections are done.
		</td>
		<td>
		<font face="Arial, Helvetica, sans-serif"><strong>Semester:</strong><br>
		A: Spring semester<br>				 
		B: Summer semester<br>				 
		C: Fall Semester			 
		</font>
		</td>
	</tr>
</table>
	';

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

  if ($delrequest) {
      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
//	echo $delreqsql;
	$result=db_query($delreqsql);
	if($result == true) {
		echo "<p><center><h2><font color=\"red\">Delete the request successfully!</font></h2></center>";
	}
	else {
		echo "<p><center><h2><font color=\"red\">Delete the request failed!</font></h2></center>";
	}

    }


 // display the current and upcoming semester priority title list
$result = select_priority($semester, $nextsemester);
$num_results = mysql_num_rows($result);
echo "<p><h2>Number of books in current semester: ".$num_results."</h2></p>";

$year=substr($semester,0,2);
$season=$semester[2];

  // display the priority title list
echo '<form name="pform" method="post" action="'.$PHP_SELF.'">';
echo '<input type="submit" name="button" value="Update Priority">';
echo '<table width="100%" cellpadding="1">';
echo '<TR bgcolor="#666666">';
echo '<TD width=3%><strong><font color="#FFFFFF">Priority</font></strong></TD>';
echo '<TD width=25%><strong><font color="#FFFFFF">Title (click for book details)</font></strong></TD>';
echo '<TD width=2% align="center"><strong><font color="#FFFFFF">S</font></strong></TD>';
echo '<TD width=2% align="center"><strong><font color="#FFFFFF">O</font></strong></TD>';
echo '<TD width=2% align="center"><strong><font color="#FFFFFF">C</font></strong></TD>';
//echo '<TD width=15%><strong><font color="#FFFFFF">Book Notes</font></strong></TD>';
echo '<TD width=26%><strong><font color="#FFFFFF">Request Notes<br>(viewable by student in GMB)</font></strong></TD>';
echo '<TD width=15%><strong><font color="#FFFFFF">Student</font></strong></TD>';
echo '<TD width=5%><strong><font color="#FFFFFF">Sem</font></strong></TD>';
echo '<TD width=10% align="center"><strong><font color="#FFFFFF">Format</font></strong></TD>';
echo '<TD width=5%><strong><font color="#FFFFFF">Edit<br>Request</font></strong></TD>';
echo '</TR>';

//get the current semester's requests
if (db_numrows($result) == 0) {
   echo $feedback;
   echo $sql;
} else {
  
  // display the priority title list
  // Set up variable to switch colors for me
  $color_switch = 0;

  // iterate through the rows
  for ($i=0; $i <$num_results; $i++)
  {
     $row = mysql_fetch_array($result);

     //switch the row color
     if ($color_switch)
    {
      echo "<TR bgcolor=\"#cccccc\">";
    }
    else
    {
 	  echo "<TR>";
    } 

    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="2" maxlength="3" value="'.$row["fpriority"].'" /></TD>';
	echo '<TD><a href="bookdetail.php?bookkey='.$row["FTTEBOOKID"].'">'.$row["ftitle"].'</a></TD>';
	echo '<TD align="center"><img src="/images/'.$row["fscancomplete"].'.gif" /></TD>';
	echo '<TD align="center"><img src="/images/'.$row["focrcomplete"].'.gif" /></TD>';
	echo '<TD align="center"><img src="/images/'.$row["fcheckcomplete"].'.gif" /></TD>';
	//echo '<TD>'.$row["fnotes"].'</TD>';
	echo '<td>'.$row["notes"].'</td>';
	echo '<TD>'.$row["firstname"].' '.$row["lastname"].'</TD>';
	echo '<TD>20'.$row["reqsemester"].'</TD>';
	echo '<TD>'.$row["ffiletypes"].'</TD>';
	echo '<TD><a href="requestdetail.php?requestid='.$row["primarykey"].'">Edit</a></TD>';
	echo '</TR>';
	
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
  echo "<br>";
//----------------------------------------------------------
 // display the unfinished scanning list - added 11/21/05
$result = select_priority_incomplete($semester, $nextsemester);
$num_results = mysql_num_rows($result);
echo "<p><h2>Number of incomplete books: ".$num_results."</h2></p>";

$year=substr($semester,0,2);
$season=$semester[2];

  // display the priority title list
echo '<form name="pform" method="post" action="'.$PHP_SELF.'">';
echo '<input type="submit" name="button" value="Update Priority">';
echo '<table width="100%" cellpadding="1">';
echo '<TR bgcolor="#666666">';
echo '<TD width=3%><strong><font color="#FFFFFF">Priority</font></strong></TD>';
echo '<TD width=25%><strong><font color="#FFFFFF">Title (click for book details)</font></strong></TD>';
echo '<TD width=2% align="center"><strong><font color="#FFFFFF">S</font></strong></TD>';
echo '<TD width=2% align="center"><strong><font color="#FFFFFF">O</font></strong></TD>';
echo '<TD width=2% align="center"><strong><font color="#FFFFFF">C</font></strong></TD>';
echo '<TD width=26%><strong><font color="#FFFFFF">Request Notes</font></strong></TD>';
echo '<TD width=15%><strong><font color="#FFFFFF">Student</font></strong></TD>';
echo '<TD width=5%><strong><font color="#FFFFFF">Sem</font></strong></TD>';
echo '<TD width=10% align="center"><strong><font color="#FFFFFF">Format</font></strong></TD>';
echo '<TD width=5%><strong><font color="#FFFFFF">Edit<br>Request</font></strong></TD>';
echo '</TR>';

//get the current semester's requests
if (db_numrows($result) == 0) {
   echo $feedback;
   echo $sql;
} else {
  
  // display the priority title list
  // Set up variable to switch colors for me
  $color_switch = 0;

  // iterate through the rows
  for ($i=0; $i <$num_results; $i++)
  {
     $row = mysql_fetch_array($result);

     //switch the row color
     if ($color_switch)
    {
      echo "<TR bgcolor=\"#cccccc\">";
    }
    else
    {
 	  echo "<TR>";
    } 

    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="2" maxlength="3" value="'.$row["fpriority"].'" /></TD>';
	echo '<TD><a href="bookdetail.php?bookkey='.$row["FTTEBOOKID"].'">'.$row["ftitle"].'</a></TD>';
	echo '<TD align="center"><img src="/images/'.$row["fscancomplete"].'.gif" /></TD>';
	echo '<TD align="center"><img src="/images/'.$row["focrcomplete"].'.gif" /></TD>';
	echo '<TD align="center"><img src="/images/'.$row["fcheckcomplete"].'.gif" /></TD>';
	//echo '<TD>'.$row["fnotes"].'</TD>';
	echo '<TD>'.$row["notes"].'</TD>';
	echo '<TD>'.$row["firstname"].' '.$row["lastname"].'</TD>';
	echo '<TD>20'.$row["reqsemester"].'</TD>';
	echo '<TD>'.$row["ffiletypes"].'</TD>';
	echo '<TD><a href="requestdetail.php?requestid='.$row["primarykey"].'">Edit</a></TD>';
	echo '</TR>';
	
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
  echo "<br>";
  echo "</form>";
  echo "<br>";
display_document_bottom();

?>

