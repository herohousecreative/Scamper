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

	<p><strong>Key:</strong><br>
  		<img src="images/1.gif" alt="icon indicating that the process is complete" width="20" height="20"> 
  		= process complete<br>
  		S = scan<br>
  		O = OCR<br>
  		C = check<p>
		1-19:  Books currently in processing<br>
		20: Books currently in processing that need to be .mp3’s<br>
		30: Books that need to be bought from the bookstore <br>
		40: Books to be recorded. (We do NOT need to cut nor scan them)<br>
	 <p><strong>Semester:</strong><br>
		<font color="red">A: Spring semester<br>
		B: Summer semester<br>
		C: Fall Semester</font><br>
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


$result = select_priority($semester);
$num_results = mysql_num_rows($result);
echo "<p><h2>Number of books in current semester: ".$num_results."</h2></p>";

$year=substr($semester,0,2);
$season=$semester[2];

  // display the priority title list
echo '<form name="pform" method="post" action="'.$PHP_SELF.'">';
echo '<input type="submit" name="button" value="Update Priority">';
echo '<table width="100%" cellpadding="1">
	 <TR bgcolor="#666666">
  	 <TD width=3%><strong><font color="#FFFFFF">Priority</font></strong></TD>
  	 <TD width=36%><strong><font color="#FFFFFF">Title</font></strong></TD>
  	 <TD width=2% align="center"><strong><font color="#FFFFFF">S</font></strong></TD>
  	 <TD width=2% align="center"><strong><font color="#FFFFFF">O</font></strong></TD>
  	 <TD width=2% align="center"><strong><font color="#FFFFFF">C</font></strong></TD>
  	 <TD width=35%><strong><font color="#FFFFFF">Notes</font></strong></TD>
	 <TD width=5%><strong><font color="#FFFFFF">Semester</font></strong></TD>
  	 <TD width=15% align="center"><strong><font color="#FFFFFF">Format</font></strong></TD>
  	 </TR>';

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

    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row["fpriority"].'" /></TD>
	    <TD><a href="bookdetail.php?bookkey='.$row["FTTEBOOKID"].'">'.$row["ftitle"].'</a></TD>
	    <TD align="center"><img src="/images/'.$row["fscancomplete"].'.gif" /></TD>
	    <TD align="center"><img src="/images/'.$row["focrcomplete"].'.gif" /></TD>
	    <TD align="center"><img src="/images/'.$row["fcheckcomplete"].'.gif" /></TD>
	    <TD>'.$row["fnotes"].'</TD>
	    <TD>20'.$semester.'</TD>
	    <TD>'.$row["ffiletypes"].'</TD>
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
	$result = select_priority($semester1);

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

	    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row["fpriority"].'" /></TD>
		    <TD><a href="bookdetail.php?bookkey='.$row["FTTEBOOKID"].'">'.$row["ftitle"].'</a></TD>
		    <TD align="center"><img src="/images/'.$row["fscancomplete"].'.gif" /></TD>
		    <TD align="center"><img src="/images/'.$row["focrcomplete"].'.gif" /></TD>
		    <TD align="center"><img src="/images/'.$row["fcheckcomplete"].'.gif" /></TD>
		    <TD>'.$row["fnotes"].'</TD>
		    <TD>20'.$semester1.'</TD>
		    <TD>'.$row["ffiletypes"].'</TD>
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
	$result = select_priority($semester1);

	if ($result != false ) {
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

	    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row["fpriority"].'" /></TD>
		    <TD><a href="bookdetail.php?bookkey='.$row["FTTEBOOKID"].'">'.$row["ftitle"].'</a></TD>
		    <TD align="center"><img src="/images/'.$row["fscancomplete"].'.gif" /></TD>
		    <TD align="center"><img src="/images/'.$row["focrcomplete"].'.gif" /></TD>
		    <TD align="center"><img src="/images/'.$row["fcheckcomplete"].'.gif" /></TD>
		    <TD>'.$row["fnotes"].'</TD>
		    <TD>20'.$semester1.'</TD>
		    <TD>'.$row["ffiletypes"].'</TD>
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
  	 <TD width=36%><strong><font color="#FFFFFF">Title</font></strong></TD>
  	 <TD width=2% align="center"><strong><font color="#FFFFFF">S</font></strong></TD>
  	 <TD width=2% align="center"><strong><font color="#FFFFFF">O</font></strong></TD>
  	 <TD width=2% align="center"><strong><font color="#FFFFFF">C</font></strong></TD>
  	 <TD width=35%><strong><font color="#FFFFFF">Notes</font></strong></TD>
	 <TD width=5%><strong><font color="#FFFFFF">Semester</font></strong></TD>
  	 <TD width=15% align="center"><strong><font color="#FFFFFF">Format</font></strong></TD>
  	 </TR>';

if($season == 'C')
{
	$semester1 = sprintf("%sB", $year);
	$result = select_priority($semester1);

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

	    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row["fpriority"].'" /></TD>
		    <TD><a href="bookdetail.php?bookkey='.$row["FTTEBOOKID"].'">'.$row["ftitle"].'</a></TD>
		    <TD align="center"><img src="/images/'.$row["fscancomplete"].'.gif" /></TD>
		    <TD align="center"><img src="/images/'.$row["focrcomplete"].'.gif" /></TD>
		    <TD align="center"><img src="/images/'.$row["fcheckcomplete"].'.gif" /></TD>
		    <TD>'.$row["fnotes"].'</TD>
		    <TD>20'.$semester1.'</TD>
		    <TD>'.$row["ffiletypes"].'</TD>
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
	$result = select_priority($semester1);

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

	    echo '<TD align="center"><input name="'.$row["FTTEBOOKID"].'" type="text" size="3" maxlength="3" value="'.$row["fpriority"].'" /></TD>
		    <TD><a href="bookdetail.php?bookkey='.$row["FTTEBOOKID"].'">'.$row["ftitle"].'</a></TD>
		    <TD align="center"><img src="/images/'.$row["fscancomplete"].'.gif" /></TD>
		    <TD align="center"><img src="/images/'.$row["focrcomplete"].'.gif" /></TD>
		    <TD align="center"><img src="/images/'.$row["fcheckcomplete"].'.gif" /></TD>
		    <TD>'.$row["fnotes"].'</TD>
		    <TD>20'.$semester1.'</TD>
		    <TD>'.$row["ffiletypes"].'</TD>
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

