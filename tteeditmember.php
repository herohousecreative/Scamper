<?php
include "include/ttedatabase.php";
include "include/tteuser.php";

display_document_center_top();
$memberkey = $_GET[memberkey];
echo '
  <div id="pageName"> 
    <h2>Edit TTE Member</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';
?>
<?php
$result=select_member('xyz',$memberkey)
 or die($feedback);
$row = mysql_fetch_array($result);
echo "<h2>Edit Member Information </h2>
  <form action=\"ttemember.php?method=edit\" method=\"post\">
  <Input type=\"hidden\" name=memberkey value=\"",$memberkey,"\">
  <table cellpadding=\"3\" cellspacing=\"0\"  border=\"0\">
  <tr>
       <td>  Member First Name </td>
	   <td>  <input type=\"text\" name=\"FMEMFNAME\" value=\"",$row["FMEMFNAME"],"\"> </td>
  </tr>
  <tr>
       <td>  Member Last Name </td>
       <td>  <input type=\"text\" name=\"FMEMLNAME\" value=\"",$row["FMEMLNAME"],"\"></td>
  </tr>
  <tr>
       <td>  Organization Name  </td>
       <td > <input type=\"text\"  size=\"50\" name=\"FORGNAME\" value=\"",$row["FORGNAME"],"\">  </td>
  </tr>
  
<tr>
  	 <td> Organization Office </td>
	 <td> <input type=\"text\" size=\"50\" name=\"FOFFICE\" value=\"",$row["FOFFICE"],"\"></td>
  </tr>
  
  <tr>
  		<td> Organization Address(Line 1)  </td>
  		<td> <input type=\"text\" size=\"50\" name=\"FORGADDRESS1\" value=\"",$row["FORGADDRESS1"],"\">  </td>
  </tr>
  
  <tr>
		<td> Organization Address(Line 2) </td>
	    <td> <input type=\"text\" size=\"50\" name=\"FORGADDRESS2\" value=\"",$row["FORGADDRESS2"],"\">	</td>
  </tr>
  
  <tr>
    	<td> Organization City  </td>
	    <td> <input type=\"text\" name=\"FORGCITY\" value=\"",$row["FORGCITY"],"\">	</td>
  </tr>
  
  <tr>
	    <td> Organization State  </td>
    	<td> <input type=\"text\" name=\"FORGSTATE\" value=\"",$row["FORGSTATE"],"\">	</td>
  </tr>
  
  <tr>  
	  <td> Organization Zip    </td>
	  <td> <input type=\"text\" name=\"FORGZIP\" value=\"",$row["FORGZIP"],"\">	</td>
  </tr>
  
  <tr>
	  <td> Organization Country </td>
	  <td> <input type=\"text\" name=\"FORGCOUNTRY\" value=\"",$row["FORGCOUNTRY"],"\">  </td>
  </tr>
  
  <tr>
  	   <td> Organization Phone </td>
	   <td> <input type=\"text\" name=\"FORGPHONE\" value=\"",$row["FORGPHONE"],"\"></td>
  </tr>
  
  <tr>
	<td> Organization Fax</td>
	<td> <input type=\"text\" name=\"FFAX\" value=\"" ,$row["FFAX"],"\"></td>
  </tr>
  
  <tr>
	   <td>  Member Logon Name </td>
	   <td>  <input type=\"text\" name=\"FMEMLOGONNAME\" value=\"",$row["FMEMLOGONNAME"],"\"></td>
  </tr>
  
  <tr>
		<td>  Member Password</td>
		<td>  <input type=\"text\" name=\"FMEMPASSWORD\" value=\"",$row["FMEMPASSWORD"],"\"></td>
  </tr>
  
  <tr>
		<td>  Member Email </td>
		<td>  <input type=\"text\" size=\"50\" name=\"FEMAIL\" value=\"",$row["FEMAIL"],"\"></td>
  </tr>
  
  <tr>
	  <td>Application Mailed?</td>
	  <td><select size=\"1\" name=\"FAPPMAILED\"> <option selected>",$row[FAPPMAILED],"</option>";
	  if($row[FAPPMAILED]=="Y")
	  	  	echo"<option>N</option> </select></td>";
	  else
	  		echo"<option>Y</option> </select></td>";
 	echo"
  </tr>
  
  <tr>
	  <td>Application Submitted?</td>
	  <td><select size=\"1\" name=\"FAPPSUBMIT\"> <option selected>",$row[FAPPSUBMIT],"</option>";
	  if($row[FAPPSUBMIT]=="Y")
	  	  	echo"<option>N</option> </select></td>";
	  else
	  		echo"<option>Y</option> </select></td>";
		echo"
  </tr>

  <tr>
	  <td>Application Approved & Current?</td>
	  <td><select size=\"1\" name=\"FAPPAPPROVED\"> <option selected>",$row[FAPPAPPROVED],"</option>";
	  if($row[FAPPAPPROVED]=="Y")
	  	  	echo"<option>N</option> </select></td>";
	  else
	  		echo"<option>Y</option> </select></td>";
	echo"
  </tr>
  
  
  <tr>
	  <td>  Comments/Notes </td>
	  <td>  <input type=\"text\" size=\"50\" name=\"FAPPDECREASON\" value=\"",$row["FAPPDECREASON"],"\"></td>
  </tr>
  
  <tr>
  	  <td>Last Registration Date</td>
	  <td> <input type=\"text\" name=\"FREGDATE\" value=\"",$row["FREGDATE"],"\">(yyyy-mm-dd) </td>
  </tr>
  

  
  <tr>
  	<td>TapeData</td>
	<td><input type=\"text\" name=\"FTAPEDATA\" value=\"",$row["FTAPEDATA"],"\"></td>
  </tr>
  <tr>
  <td></td>
  <td>
   <input type=\"submit\" name=\"Submit\" value=\"Update\">	
   </td>
   </tr>";	
  echo "</table></form>";

display_document_bottom();
?>
