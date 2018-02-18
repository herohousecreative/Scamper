<?php
include "include/ttedatabase.php";
include "include/tteuser.php";

display_document_center_top();
echo '
  <div id="pageName"> 
    <h2>TTE Organization Details</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';
?>
<p>Click on the Organization Name to edit the organization details</p>

<?php
if ($method=='add') {
  $result=add_book($memberkey,$bookkey,$semester)
    or die($feedback);
}

if ($method=='edit') {
  $result=organization_edit($memberkey,$FORGNAME,$FOFFICE,$FORGADDRESS1,$FORGADDRESS2,$FORGCITY,$FORGSTATE,$FORGZIP,$FORGCOUNTRY,$FORGPHONE)
    or die($feedback);
}

$result=select_member('xyz',$memberkey)
 or die($feedback);
echo "<table border=\"0\" width=\"100%\">";
echo "<TR  bgcolor=\"#666666\">";
echo "<TD><strong><font color=\"#FFFFFF\">Organization Name</strong></font></TD>";
echo "<TD><strong><font color=\"#FFFFFF\">Organization Office</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Organization Address(Line 1)</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Organization Address(Line 2)</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Organization City</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Organization State</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Organization Zip</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Organization Country</strong></font></TD>";
  echo "<TD><strong><font color=\"#FFFFFF\">Organization Phone</strong></font></TD>"; 
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
  echo "<TD><a href=\"tteeditorganizationdetails.php?memberkey=",$row["memberkey"],"\">";
		echo $row["FORGNAME"];
		"</a></TD>"	 ;
  /*  echo "<TD>";
    echo $row["FORGNAME"];
    echo "</TD>";*/
  	echo "<TD>";    echo $row["FOFFICE"];    echo "</TD>";

    echo "<TD>";    echo $row["FORGADDRESS1"];    echo "</TD>";

    echo "<TD>";    echo $row["FORGADDRESS2"];    echo "</TD>";

    echo "<TD>";    echo $row["FORGCITY"];    echo "</TD>";

    echo "<TD>";    echo $row["FORGSTATE"];    echo "</TD>";
	
	echo "<TD>";    echo $row["FORGZIP"];    echo "</TD>";
	
	echo "<TD>";    echo $row["FORGCOUNTRY"];    echo "</TD>";
		
	echo "<TD>";    echo $row["FORGPHONE"];    echo "</TD>";

  echo "</TR>\n";
 //rotate the color for the table
  if ($color_switch)
  {
    $color_switch = 0;
  } else {
    $color_switch = 1;
  }
} while ($row = db_fetch_array($result));
echo "</table><br>";
 echo "<br><a href=\"index.php\">Return to homepage</a>";
echo "<br>";
// ----------------------------------------------------------

display_document_bottom();

?>

