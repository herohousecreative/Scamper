
<?php
include "include/database.php";
include "include/user1.php";

display_document_center_top();
//THIS IS FOR RFBD PRIORITY LIST
echo '
  <div id="pageName"> 
    <h2>RFB&D Priority Tracking </h2> 
  </div> 
    <div id="content"> 
    <div class="feature">
  <table width=100%>
  	<tr>
		  <td>
		  	<font face="arial"><strong>Priority Ranking for BOT List</strong><br>
			1. Not Ordered<br>
			2. Ordered, not received<br>
			3. Received, waiting for pick up<br>
			4. Checked out<br>				
			5. Overdue to be returned<br>
		  	</font>
		  </td>
		  <td>
		  	<font face="arial"><strong>Semester</strong><br>
			A: Spring Semester<br>
			B: Summer Semester<br>
			C: Fall Semester<br>
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


// display the upcoming semester RFB book list - added 12/03/05 - Tracey
$result = select_rfbpriority($nextsemester);
$num_results = mysql_num_rows($result);
echo "<p><h2>Number of books requested on tape in for the upcoming semester: ".$num_results."</h2></p>";

$year=substr($semester,0,2);
$season=$semester[2];

  // display the priority list
  echo '<form name="pform" method="post" action="' .$PHP_SELF. '">';
  echo '<input type="submit" name="button" value="Update Priority">';
  echo '<table width="100%" cellpadding="1">
  	<TR bgcolor="#666666">
  	<TD width=3%><strong><font color="#FFFFFF">Priority</font></strong></TD>
	<TD width=33%><strong><font color="#FFFFFF">Title</font></strong></TD>
  	 <TD width=4% align="center"><strong><font color="#FFFFFF">Ordered</font></strong></TD>
  	 <TD width=4% align="center"><strong><font color="#FFFFFF">Received</font></strong></TD>
  	 <TD width=2% align="center"><strong><font color="#FFFFFF">Out</font></strong></TD>
  	 <TD width=2% align="center"><strong><font color="#FFFFFF">In</font></strong></TD>
  	 <TD width=20%><strong><font color="#FFFFFF">Notes</font></strong></TD>
	 <TD width=13%><strong><font color="#FFFFFF">Student</font></strong></TD>
	 <TD width=5%><strong><font color="#FFFFFF">Semester</font></strong></TD>
	 <TD width=4%><strong><font color="#FFFFFF">Delete</font></strong></TD>
  	</TR>';

if (db_numrows($result) == 0) {
   echo $feedback;
   echo $sql;
} else {
  
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

    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row["fpriority"].'" /></TD>
		<TD><a href="requestdetail1.php?requestid='.$row["primarykey"].'">'.$row["ftitle"].'</a></TD>
		<TD>'. $row["frfbd_ordered"] . '</TD>
		<TD>'. $row["frfbd_received"] . '</TD>
		<TD align="center">'.$row["pickedup"].'</TD>
		<TD align="center">'.$row["returned"].'</TD>
		<TD>' . $row["fnotes"] .'</TD>
	      <TD>'.$row["firstname"].' '.$row["lastname"].'</TD>
		<TD>20'.$nextsemester.'</TD>
	    <TD><a href="'.$PHP_SELF.'?delrequest='.$row["primarykey"].'">Delete</a></TD>
	</TR>';
	
    //rotate the color for the table
    if ($color_switch)
      {
        $color_switch = 0;
      } else {
        $color_switch = 1;
      }

    }

}

if($season == 'A')
{
	$semester1 = sprintf("%sB", $year);
	$result = select_rfbpriority($semester1);

	if ($result != false) {
  		$num_results = mysql_num_rows($result);
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

	    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row	["fpriority"].'" /></TD>
			<TD><a href="requestdetail1.php?requestid='.$row["primarykey"].'">'.$row["ftitle"].'</a></TD>
			<TD>'. $row["frfbd_ordered"] . '</TD>
			<TD>'. $row["frfbd_received"] . '</TD>
			<TD align="center">'.$row["pickedup"].'</TD>
			<TD align="center">'.$row["returned"].'</TD>
			<TD>' . $row["fnotes"] .'</TD>
	 	      <TD>'.$row["firstname"].' '.$row["lastname"].'</TD>
			<TD>20'.$semester1.'</TD>
	 	      <TD><a href="'.$PHP_SELF.'?delrequest='.$row["primarykey"].'">Delete</a></TD>
		</TR>';
	
    //rotate the color for the table
	    if ($color_switch)
      	{
	        $color_switch = 0;
	      } else {
	        $color_switch = 1;
	      }
	    }
	}
}

if($season == 'B' || $season == 'A')
{
	$semester1 = sprintf("%sC", $year);
	$result = select_rfbpriority($semester1);

	if ($result != false) {
  		$num_results = mysql_num_rows($result);
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

	    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row	["fpriority"].'" /></TD>
			<TD><a href="requestdetail1.php?requestid='.$row["primarykey"].'">'.$row["ftitle"].'</a></TD>
			<TD>'. $row["frfbd_ordered"] . '</TD>
			<TD>'. $row["frfbd_received"] . '</TD>
			<TD align="center">'.$row["pickedup"].'</TD>
			<TD align="center">'.$row["returned"].'</TD>
			<TD>' . $row["fnotes"] .'</TD>
		      <TD>'.$row["firstname"].' '.$row["lastname"].'</TD>
			<TD>20'.$semester1.'</TD>
		      <TD><a href="'.$PHP_SELF.'?delrequest='.$row["primarykey"].'">Delete</a></TD>
		</TR>';
	
    //rotate the color for the table
	    if ($color_switch)
      	{
	        $color_switch = 0;
	      } else {
	        $color_switch = 1;
	      }
	    }
	}
}
  echo "</table>";
  echo "<br>";
//end upcoming list

// display the current semester RFB book list
$result = select_rfbpriority($semester);
$num_results = mysql_num_rows($result);
echo "<p><h2>Number of books requested on tape in this semester: ".$num_results."</h2></p>";

$year=substr($semester,0,2);
$season=$semester[2];

  // display the priority list
  echo '<form name="pform" method="post" action="' .$PHP_SELF. '">';
  echo '<input type="submit" name="button" value="Update Priority">';
  echo '<table width="100%" cellpadding="1">
  	<TR bgcolor="#666666">
  	<TD width=3%><strong><font color="#FFFFFF">Priority</font></strong></TD>
	<TD width=33%><strong><font color="#FFFFFF">Title</font></strong></TD>
  	 <TD width=4% align="center"><strong><font color="#FFFFFF">Ordered</font></strong></TD>
  	 <TD width=4% align="center"><strong><font color="#FFFFFF">Received</font></strong></TD>
  	 <TD width=2% align="center"><strong><font color="#FFFFFF">Out</font></strong></TD>
  	 <TD width=2% align="center"><strong><font color="#FFFFFF">In</font></strong></TD>
  	 <TD width=20%><strong><font color="#FFFFFF">Notes</font></strong></TD>
	 <TD width=13%><strong><font color="#FFFFFF">Student</font></strong></TD>
	 <TD width=5%><strong><font color="#FFFFFF">Semester</font></strong></TD>
	 <TD width=4%><strong><font color="#FFFFFF">Delete</font></strong></TD>
  	</TR>';

if (db_numrows($result) == 0) {
   echo $feedback;
   echo $sql;
} else {
  
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

    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row["fpriority"].'" /></TD>
		<TD><a href="requestdetail1.php?requestid='.$row["primarykey"].'">'.$row["ftitle"].'</a></TD>
		<TD>'. $row["frfbd_ordered"] . '</TD>
		<TD>'. $row["frfbd_received"] . '</TD>
		<TD align="center">'.$row["pickedup"].'</TD>
		<TD align="center">'.$row["returned"].'</TD>
		<TD>' . $row["fnotes"] .'</TD>
	      <TD>'.$row["firstname"].' '.$row["lastname"].'</TD>
		<TD>20'.$semester.'</TD>
	    <TD><a href="'.$PHP_SELF.'?delrequest='.$row["primarykey"].'">Delete</a></TD>
	</TR>';
	
    //rotate the color for the table
    if ($color_switch)
      {
        $color_switch = 0;
      } else {
        $color_switch = 1;
      }

    }

}

if($season == 'A')
{
	$semester1 = sprintf("%sB", $year);
	$result = select_rfbpriority($semester1);

	if ($result != false) {
  		$num_results = mysql_num_rows($result);
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

	    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row	["fpriority"].'" /></TD>
			<TD><a href="requestdetail1.php?requestid='.$row["primarykey"].'">'.$row["ftitle"].'</a></TD>
			<TD>'. $row["frfbd_ordered"] . '</TD>
			<TD>'. $row["frfbd_received"] . '</TD>
			<TD align="center">'.$row["pickedup"].'</TD>
			<TD align="center">'.$row["returned"].'</TD>
			<TD>' . $row["fnotes"] .'</TD>
	 	      <TD>'.$row["firstname"].' '.$row["lastname"].'</TD>
			<TD>20'.$semester1.'</TD>
	 	      <TD><a href="'.$PHP_SELF.'?delrequest='.$row["primarykey"].'">Delete</a></TD>
		</TR>';
	
    //rotate the color for the table
	    if ($color_switch)
      	{
	        $color_switch = 0;
	      } else {
	        $color_switch = 1;
	      }
	    }
	}
}

if($season == 'B' || $season == 'A')
{
	$semester1 = sprintf("%sC", $year);
	$result = select_rfbpriority($semester1);

	if ($result != false) {
  		$num_results = mysql_num_rows($result);
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

	    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row	["fpriority"].'" /></TD>
			<TD><a href="bookdetail.php?bookkey='.$row["FTTEBOOKID"].'&requestkey='.$row["primarykey"].'">'.$row["ftitle"].'</a></TD>
			<TD>'. $row["frfbd_ordered"] . '</TD>
			<TD>'. $row["frfbd_received"] . '</TD>
			<TD align="center">'.$row["pickedup"].'</TD>
			<TD align="center">'.$row["returned"].'</TD>
			<TD>' . $row["fnotes"] .'</TD>
		      <TD>'.$row["firstname"].' '.$row["lastname"].'</TD>
			<TD>20'.$semester1.'</TD>
		      <TD><a href="'.$PHP_SELF.'?delrequest='.$row["primarykey"].'">Delete</a></TD>
		</TR>';
	
    //rotate the color for the table
	    if ($color_switch)
      	{
	        $color_switch = 0;
	      } else {
	        $color_switch = 1;
	      }
	    }
	}
}
  echo "</table>";
  echo "<br>";

  echo "<h2>The previous semesters' unfinished requests:</h2>";
  echo '<table width="100%" cellpadding="1">
  	<TR bgcolor="#666666">
  	<TD width=3%><strong><font color="#FFFFFF">Priority</font></strong></TD>
	<TD width=33%><strong><font color="#FFFFFF">Title</font></strong></TD>
  	 <TD width=4% align="center"><strong><font color="#FFFFFF">Ordered</font></strong></TD>
  	 <TD width=4% align="center"><strong><font color="#FFFFFF">Received</font></strong></TD>
  	 <TD width=2% align="center"><strong><font color="#FFFFFF">Out</font></strong></TD>
  	 <TD width=2% align="center"><strong><font color="#FFFFFF">In</font></strong></TD>
  	 <TD width=20%><strong><font color="#FFFFFF">Notes</font></strong></TD>
	 <TD width=13%><strong><font color="#FFFFFF">Student</font></strong></TD>
	 <TD width=5%><strong><font color="#FFFFFF">Semester</font></strong></TD>
	 <TD width=4%><strong><font color="#FFFFFF">Delete</font></strong></TD>
  	</TR>';

if($season == 'C')
{
	$semester1 = sprintf("%sB", $year);
	$result = select_rfbpriority($semester1);

	if ($result != false) {
  		$num_results = mysql_num_rows($result);
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

	    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row	["fpriority"].'" /></TD>
			<TD><a href="bookdetail.php?bookkey='.$row["FTTEBOOKID"].'&requestkey='.$row["primarykey"].'">'.$row["ftitle"].'</a></TD>
			<TD>'. $row["frfbd_ordered"] . '</TD>
			<TD>'. $row["frfbd_received"] . '</TD>
			<TD align="center">'.$row["pickedup"].'</TD>
			<TD align="center">'.$row["returned"].'</TD>
			<TD>' . $row["fnotes"] .'</TD>
		      <TD>'.$row["firstname"].' '.$row["lastname"].'</TD>
			<TD>20'.$semester1.'</TD>
		      <TD><a href="'.$PHP_SELF.'?delrequest='.$row["primarykey"].'">Delete</a></TD>
		</TR>';
	
    //rotate the color for the table
	    if ($color_switch)
      	{
	        $color_switch = 0;
	      } else {
	        $color_switch = 1;
	      }
	    }
	}
}

if($season == 'B' || $season == 'C')
{
	$semester1 = sprintf("%sA", $year);
	$result = select_rfbpriority($semester1);

	if ($result != false) {
  		$num_results = mysql_num_rows($result);
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

	    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row	["fpriority"].'" /></TD>
			<TD><a href="bookdetail.php?bookkey='.$row["FTTEBOOKID"].'&requestkey='.$row["primarykey"].'">'.$row["ftitle"].'</a></TD>
			<TD>'. $row["frfbd_ordered"] . '</TD>
			<TD>'. $row["frfbd_received"] . '</TD>
			<TD align="center">'.$row["pickedup"].'</TD>
			<TD align="center">'.$row["returned"].'</TD>
			<TD>' . $row["fnotes"] .'</TD>
		      <TD>'.$row["firstname"].' '.$row["lastname"].'</TD>
			<TD>20'.$semester1.'</TD>
		      <TD><a href="'.$PHP_SELF.'?delrequest='.$row["primarykey"].'">Delete</a></TD>
		</TR>';
	
    //rotate the color for the table
	    if ($color_switch)
      	{
	        $color_switch = 0;
	      } else {
	        $color_switch = 1;
	      }
	    }
	}
}

  echo "</table>";
  echo "</form>";
  echo "<br>";
display_document_bottom();

?>
