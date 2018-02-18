<?php
include "include/database.php";
include "include/user.php";

display_document_top();



if ($method=='add') {
  $result=add_book($studentkey,$bookkey,$semester)
    or die($feedback);
}

if ($method=='edit') {
  $result=student_edit($studentkey,$sid,$firstname,$lastname,$telephone,$email,$password,$notes)
    or die($feedback);
}

//if ($method=='delete') {
// $result=bs_delete($bskey)
//    or die($feedback);
//}


$result=select_student('xyz',$studentkey);
echo '
  <div id="pageName"> 
    <h2>Student Details</h2> 
  </div> 
  <div id="pageNav"> 
    <div id="sectionLinks"> 
      <a href="addrequest.php?studentid='.$studentkey.'">Add a book request</a>
    </div> 
  </div>
  <div id="content"> 
    <div class="feature"> 
';
if (!$result) {
	echo $feedback;
} else {
echo "<table border=\"0\" width=100%>";
echo "<TR  bgcolor=\"#666666\">";
echo "<TD width=15%><strong><font color=\"#FFFFFF\">Student ID</strong></font></TD>";
echo "<TD width=20%><strong><font color=\"#FFFFFF\">Name</strong></font></TD>";
echo "<TD width=20%><strong><font color=\"#FFFFFF\">Telephone</strong></font></TD>";
echo "<TD width=25%<strong><font color=\"#FFFFFF\">Email</strong></font></TD>";
echo "<TD width=20%<strong><font color=\"#FFFFFF\">Notes</strong></font></TD>";
echo "</TR>";

// Set up variable to switch colors for me
$color_switch = 1;

 while ($row = db_fetch_array($result)) {
  if ($color_switch)
  {
    echo "<TR bgcolor=\"#cccccc\">";
  }
  else
  {
    echo "<TR>";
  } //endif
  echo "<TD>",$row["sid"],"</TD>";
  echo "<TD><a href=\"editstudent.php?studentkey=",$studentkey,"\">",$row["firstname"]," ",$row["lastname"],"</a></TD>";
  echo "<TD>",$row["telephone"],"</TD>\n";
  echo "<TD><a href=mailto:",$row["email"],">",$row["email"],"</A></TD><TD>",$row["notes"],"</TD>\n";
  echo "</TR>\n";
 //rotate the color for the table
  if ($color_switch)
  {
    $color_switch = 0;
  } else {
    $color_switch = 1;
  }
}
echo "</table><br>";
}

echo "<br><hr>";

// ----------------------------------------------------------

echo"<h3>Pending Book Requests</h3>";
$result=select_pendingrequests($studentkey,$semester);
if (!$result) {
	echo "<h2>".$feedback."</h2>";
} else {
echo "<h3>Total requests: ",db_numrows($result),"</h3>";
echo "<table border=\"0\" width=100%>";
echo "<TR  bgcolor=\"#666666\">";
echo "<TD width=60%><strong><font color=\"#FFFFFF\">Title</strong></font></TD>";
echo "<TD width=30%><strong><font color=\"#FFFFFF\">First Author</strong></font></TD>";
echo "<TD width=10%><strong><font color=\"#FFFFFF\">Format</strong></font></TD>";
echo "</TR>";

// Set up variable to switch colors for me
$color_switch = 1;

while ($row = db_fetch_array($result)) {
  if ($color_switch)
  {
    echo "<TR bgcolor=\"#cccccc\">";
  }
  else
  {
    echo "<TR>";
  } //endif
  echo "<TD><a href=\"pendingrequestdetail.php?requestid=",$row["requestid"],"\">",$row["title"],"</a></TD>";
  echo "<TD>".$row["author1ln"].", ".$row["author1fn"]."</TD>";
  echo "<TD>",$row["filetypes"],"</TD>";
  echo "</TR>\n";
  //rotate the color for the table
  if ($color_switch)
  {
    $color_switch = 0;
  } else {
    $color_switch = 1;
  }
} 
echo "</table>";

}

echo "<br><hr>";

// ----------------------------------------------------------

echo"<h3>Current Book Requests</h3>";
$result=select_requests($studentkey,$semester);

$year=substr($semester,0,2);
$season=$semester[2];

if (!$result) {
	echo "<h2>".$feedback."</h2>";
} else {
echo "<h2>Total requests: ",db_numrows($result),"</h2>";
echo "<table border=\"0\" width=100%>";
echo "<TR  bgcolor=\"#666666\">";
echo "<TD width=55%><strong><font color=\"#FFFFFF\">Title</strong></font></TD>";
echo "<TD width=20%><strong><font color=\"#FFFFFF\">First Author</strong></font></TD>";
echo "<TD width=10%><strong><font color=\"#FFFFFF\">Format</strong></font></TD>";
//echo "<TD width=15%><strong><font color=\"#FFFFFF\">Delete</strong></font></TD>";
echo "</TR>";

// Set up variable to switch colors for me
$color_switch = 1;

 while ($row = db_fetch_array($result)) {
  if ($color_switch)
  {
    echo "<TR bgcolor=\"#cccccc\">";
  }
  else
  {
    echo "<TR>";
  } //endif
  echo "<TD><a href=\"requestdetail.php?requestid=",$row["bskey"],"\">",$row["ftitle"],"</a></TD>";
  echo "<TD>".$row["FAUTHOR1LN"].", ".$row["FAUTHOR1FN"]."</TD>";
  echo "<TD>",$row["ffiletypes"],"</TD>";
  echo "</TR>\n";
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

 	while ($row = db_fetch_array($result)) {
	  if ($color_switch)
	  {
	    echo "<TR bgcolor=\"#cccccc\">";
	  }
	  else
	  {
	    echo "<TR>";
	  } //endif
	  echo "<TD><a href=\"requestdetail.php?requestid=",$row["bskey"],"\">",$row["ftitle"],"</a></TD>";
	  echo "<TD>".$row["FAUTHOR1LN"].", ".$row["FAUTHOR1FN"]."</TD>";
	  echo "<TD>",$row["ffiletypes"],"</TD>";
	  echo "</TR>\n";
	  //rotate the color for the table
	  if ($color_switch)
	  {
	    $color_switch = 0;
	  } else {
	    $color_switch = 1;
	  }
	}

}

if($season == 'B' || $season == 'A')
{
	$semester1 = sprintf("%sC", $year);
	$result = select_priority($semester1);

 	while ($row = db_fetch_array($result)) {
	  if ($color_switch)
	  {
	    echo "<TR bgcolor=\"#cccccc\">";
	  }
	  else
	  {
	    echo "<TR>";
	  } //endif
	  echo "<TD><a href=\"requestdetail.php?requestid=",$row["bskey"],"\">",$row["ftitle"],"</a></TD>";
	  echo "<TD>".$row["FAUTHOR1LN"].", ".$row["FAUTHOR1FN"]."</TD>";
	  echo "<TD>",$row["ffiletypes"],"</TD>";
	  echo "</TR>\n";
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
display_document_bottom();

?>

