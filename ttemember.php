<?php
include "include/ttedatabase.php";
include "include/tteuser.php";

display_document_center_top();
$memberkey = $_GET[memberkey];
$lastname = $_POST['lastname'];
echo '
  <div id="pageName"> 
    <h2>TTE Member Query</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';
?>

<?php

if ($method=='edit') {
  $result=member_edit($memberkey,addslashes($FMEMFNAME),addslashes($FMEMLNAME),addslashes($FORGNAME),addslashes($FORGADDRESS1),addslashes($FORGADDRESS2),addslashes($FORGCITY),$FORGSTATE,$FORGZIP,$FORGCOUNTRY,$FORGPHONE,$FMEMLOGONNAME,$FMEMPASSWORD,$FEMAIL,$FAPPMAILED,$FAPPSUBMIT,$FAPPAPPROVED,addslashes($FAPPDECREASON),$FREGDATE,addslashes($FOFFICE),$FFAX,addslashes($FTAPEDATA))
    or die($feedback);
}

$result=select_member(addslashes($lastname),'');
if (db_numrows($result) == 0) {
   echo '<h3>Member not found.<br><br><a href="ttenewmember.php">Enter a new member</a> or <a href="ttehome.php">Run another search</a></h3>';
} else {
	echo"Click on <b>Organization Name</b> to view organization details";
	echo"<p>";
	echo "Click on <b>Member Name</b> to edit the member information";
	echo "</p>";
  echo "<table border=\"0\" padding=\"5\" width=\"100%\">";
  echo "<TR  bgcolor=\"#666666\">";
 
 /* echo "<TD width=175><strong><font color=\"#FFFFFF\">Organization Address(Line 1)</strong></font></TD>";
  echo "<TD width=125><strong><font color=\"#FFFFFF\">Organization Address(Line 2)</strong></font></TD>";
  echo "<TD width=150<strong><font color=\"#FFFFFF\">Organization City</strong></font></TD>";
  echo "<TD width=150<strong><font color=\"#FFFFFF\">Organization State</strong></font></TD>";
  echo "<TD width=150<strong><font color=\"#FFFFFF\">Organization Zip</strong></font></TD>";
  echo "<TD width=150<strong><font color=\"#FFFFFF\">Organization Country</strong></font></TD>";
  echo "<TD width=150<strong><font color=\"#FFFFFF\">Organization Phone</strong></font></TD>";
*/  
  echo "<TD><strong><font color=\"#FFFFFF\">Member FName</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Member LName</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Organization Name</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Logon Name</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Password</strong></font></TD>";
  //echo "<TD width=200><strong><font color=\"#FFFFFF\">Member Email</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">App Mailed?</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Submitted?</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Approved & Current?</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Reg Date</strong></font></TD>";
    echo "<TD><strong><font color=\"#FFFFFF\">Comments/Notes</strong></font></TD>";
  //echo "<TD width=200><strong><font color=\"#FFFFFF\">Office</strong></font></TD>";
  //echo "<TD width=200><strong><font color=\"#FFFFFF\">Fax</strong></font></TD>";
  //echo "<TD width=200><strong><font color=\"#FFFFFF\">TapeData</strong></font></TD>";
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

	
  /*  echo "<TD>";
    echo $row["FORGNAME"];
    echo "</TD>";*/

  /*  echo "<TD>";
    echo $row["FORGADDRESS1"];
    echo "</TD>";

    echo "<TD>";
    echo $row["FORGADDRESS2"];
    echo "</TD>";

    echo "<TD>";
    echo $row["FORGCITY"];
    echo "</TD>";

    echo "<TD>";
    echo $row["FORGSTATE"];
    echo "</TD>";
	
	echo "<TD>";
    echo $row["FORGZIP"];
    echo "</TD>";
	
	echo "<TD>";
    echo $row["FORGCOUNTRY"];
    echo "</TD>";
		
	echo "<TD>";
    echo $row["FORGPHONE"];
    echo "</TD>";
	*/
	echo "<TD><a href=\"tteeditmember.php?memberkey=",$row["memberkey"],"\">";
    echo $row["FMEMFNAME"];
    echo "</TD>";
	
	echo "<TD>";
    echo $row["FMEMLNAME"];
    echo "</TD>";
	
	echo "<TD><a href=\"tteorganizationdetails.php?memberkey=",$row["memberkey"],"\">";
		echo $row["FORGNAME"];
		"</a></TD>"	 ;
		
	echo "<TD>";
    echo $row["FMEMLOGONNAME"];
    echo "</TD>";
	
	echo "<TD>";
    echo $row["FMEMPASSWORD"];
    echo "</TD>";
	
	//echo "<TD>";
	//echo "<a href=mailto:",$row["FEMAIL"],">",$row["FEMAIL"],"</A></TD>\n";
    //echo "</TD>";
	
	echo "<TD>";
    echo $row["FAPPMAILED"];
    echo "</TD>";
	
	echo "<TD>";
    echo $row["FAPPSUBMIT"];
    echo "</TD>";
	
	echo "<TD>";
    echo $row["FAPPAPPROVED"];
    echo "</TD>";
	
	echo "<TD>";
    echo $row["FREGDATE"];
    echo "</TD>";
	
	echo "<TD>";
    echo $row["FAPPDECREASON"];
    echo "</TD>";
	
	//echo "<TD>";
    //echo $row["FOFFICE"];
    //echo "</TD>";
	
	//echo "<TD>";
    //echo $row["FFAX"];
    //echo "</TD>";
	
	//echo "<TD>";
    //echo $row[",ftapedata"];
    //echo "</TD>";
	 
    
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
echo "<h3><a href=\"ttenewmember.php\">Enter a new member</a> or <a href=\"ttehome.php\">Run another search</a></h3>";

}


display_document_bottom();
?>

