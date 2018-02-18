<?php
include "include/database.php";
include "include/tteuser.php";

display_document_center_top();
echo '
  <div id="pageName"> 
    <h2>Add TTE New Member</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';
?>

  <form action="ttememberpost.php" method="post">
 
  <table cellpadding="2" cellspacing="0"  border="0">
  <TR bgcolor="cccccc" >
	<td>  Member First Name </td>
	<td>    <input type="text" name="FMEMFNAME"></td>
  </tr>
  
  <tr>
	<td>  Member Last Name </td>
	<td>    <input type="text" name="FMEMLNAME"></td>
  </tr>
  
  <TR bgcolor="cccccc" >
     <td>Organization Name </td>
  	 <td> <input type="text" size="50" name="FORGNAME"></td>
  </tr>

  <TR bgcolor="cccccc" >
 	<td>Organization Office </td>
	<td>    <input type="text" size="50" name="FOFFICE"></td>
  </tr>

  <tr>
 	 <td>Organization Address(Line 1) </td>
	  <td><input type="text"  size="50" name="FORGADDRESS1"></td>
  </tr>
  
  <TR bgcolor="cccccc" >
	  <td>Organization Address(Line 2) </td>
	 <td><input type="text"  size="50" name="FORGADDRESS2"></td>
  </tr>
  
  <tr>
	  <td>Organization City</td>
	  <td><input type="text" name="FORGCITY"></td>
  </tr>
  
  <TR bgcolor="cccccc" >
	<td>  Organization State</td>
	<td>  <input type="text" name="FORGSTATE"></td>
  </tr>
  
  <tr>
	<td>Organization Zip </td>
	<td><input type="text" name="FORGZIP"></td>
  </tr>

  <TR bgcolor="cccccc" >
	<td>Organization Country</td>
	<td>    <input type="text" name="FORGCOUNTRY"></td>
  </tr>
  
  <tr>
	<td>  Organization Phone </td>
    <td><input type="text" name="FORGPHONE"></td>
  </tr>

  <TR bgcolor="cccccc" >
	<td>  Member Logon Name </td>
	<td>    <input type="text" name="FMEMLOGONNAME"></td>
  </tr>
  
    <tr>
	<td> Member Fax</td>
	<td>    <input type="text" name="FFAX"></td>
  </tr>
  
  <tr>
	<td>  Member Password</td>
	<td>    <input type="text" name="FMEMPASSWORD"></td>
  </tr>
  
  <TR bgcolor="cccccc" >
	<td>  Member Email </td>
	<td>    <input type="text" size="50" name="FEMAIL"></td>
  </tr>

 <tr>
	<td>Application Mailed?</td>
	<td><select size="1" name="FAPPMAILED"> <option selected>Y</option>
		 <option>N</option> </select></td>
  </tr>

  <TR bgcolor="cccccc" >
	<td>Application Submitted?</td>
	<td><select size="1" name="FAPPSUBMIT"> <option selected>Y</option>
		 <option>N</option> </select></td>
  </tr>

  <tr>
	 <td>Application Approved?</td>
	 <td><select size="1" name="FAPPAPPROVED"> <option selected>Y</option>
		 <option>N</option> </select></td>
  </tr>

  <TR bgcolor="cccccc" >
    <td>Comments/Notes</td>
	<td>    <input type="text" size="50" name="FAPPDECREASON"></td>
  </tr>
  
  <tr>
	<td>Registration Date(yyyy-mm-dd) </td>
	<td>    <input type="text" name="FREGDATE"></td>
  </tr>
 

  <TR bgcolor="cccccc" >
    <td>TapeData</td>
	<td> <input type="text" name="FTAPEDATA"></td>
  </tr>
  </table>
  <p>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="submit" name="Submit" value="Add">	
	 </p>
  </form>

<?php
display_document_bottom();
?>
