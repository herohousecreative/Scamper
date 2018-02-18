<?php
include "include/ttedatabase.php";
include "include/tteuser.php";

display_document_center_top();
$memberkey= $_GET[memberkey];
//var_dump ($memberkey);
echo '
  <div id="pageName"> 
    <h2>Edit TTE Organization Information</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';

$result=select_organization($memberkey)
 or die($feedback);
$row = mysql_fetch_array($result);
	//echo "<Input type=\"text\" name=\"memberkey\" value=\"" $memberkey"\"";	
	echo "
  <form action=\"tteorganizationdetails.php?method=edit\" method=\"post\">
  <Input type=\"hidden\" name=memberkey value=\"",$memberkey,"\">
  <table cellpadding=\"5\" cellspacing=\"0\"  border=\"0\">
  <tr>
  <td>Organization Name  </td>
  <td >	
    <input type=\"text\"  size=\"50\" name=\"FORGNAME\" value=\"",$row["FORGNAME"],"\">
  </td>
  </tr>
  
   <tr>
  <td>Organization Office  </td>
  <td>
    <input type=\"text\" size=\"50\" name=\"FOFFICE\" value=\"",$row["FOFFICE"],"\">
  </td>
  </tr>
  
  <tr>
  <td>Organization Address(Line 1)  </td>
  <td>
    <input type=\"text\" size=\"50\" name=\"FORGADDRESS1\" value=\"",$row["FORGADDRESS1"],"\">
  </td>
  </tr>
  
  <tr>
  <td>Organization Address(Line 2) </td>
  <td>
    <input type=\"text\" size=\"50\" name=\"FORGADDRESS2\" value=\"",$row["FORGADDRESS2"],"\">
	</td>
  </tr>
  
  <tr>
    <td>Organization City  </td>
    <td><input type=\"text\" name=\"FORGCITY\" value=\"",$row["FORGCITY"],"\">
	</td>
  </tr>
  
  <tr>
    <td>Organization State  </td>
    <td><input type=\"text\" name=\"FORGSTATE\" value=\"",$row["FORGSTATE"],"\">
	</td>
  </tr>
  
  <tr>  
  <td>Organization Zip    </td>
    <td><input type=\"text\" name=\"FORGZIP\" value=\"",$row["FORGZIP"],"\">
	</td>
  </tr>
  
  <tr>
  <td>Organization Country </td>
   <td> <input type=\"text\" name=\"FORGCOUNTRY\" value=\"",$row["FORGCOUNTRY"],"\">
  </td>
  </tr>
  
  <tr>
  <td>Organization Phone </td>
   <td><input type=\"text\" name=\"FORGPHONE\" value=\"",$row["FORGPHONE"],"\"></td>
  </tr>
  
  <tr>
  <td></td>
  <td>
   <input type=\"submit\" name=\"Submit\" value=\"Update\">	
   </td>
   </tr>";
  echo "</form>";

?>
