<?php
include "include/database.php";
include "include/user.php";

display_document_center_top();

if ($_POST[Submit]) {
	$sql = "UPDATE STUDENTS SET ";
	$column_array = array("sid","firstname","lastname","telephone","email","password","notes");
	foreach ($column_array as $column) {
		$sql .= $column."='".$_POST[$column]."', ";
	}
	$sql = substr($sql,0,strlen($sql)-2)." WHERE primarykey=".$_POST[studentkey];
	$result = db_query($sql);
	if (!$result) {
		echo '
		  <div id="pageName"> 
		    <h2>Edit Student Info Results</h2> 
		  </div> 
	        <div id="content"> 
	        <div class="feature"> 
			<h3>There was an error in editing!</h3>
		';
		
	} else {
		echo '
		  <div id="pageName"> 
		    <h2>Edit Student Info Results</h2> 
		  </div> 
	        <div id="content"> 
	        <div class="feature"> 
		';
		echo "<h3>Changes to student information have been successfully saved!</h3>";
		echo "<h3><a href='studentdetail.php?studentkey=".$studentkey."'>View this student details</a></h3>";
	}
} else {
	$studentkey = $_GET[studentkey];
   	echo '
	  <div id="pageName"> 
	    <h2>Edit Student Information</h2> 
	  </div> 
        <div id="content"> 
        <div class="feature"> 
	';
	$result=select_student('xyz',$studentkey);
	if (!result) {
		echo $feedback;	
	} else {
		if ($row = mysql_fetch_array($result)) {
		echo '
		<form action="editstudent.php" method="post">
		<input type="hidden" name="studentkey" value='.$studentkey.'>
		<table>
		<tr>
		<td>Old Password </td>
		<td><input type="text" name="oldpwd" value='.$row["sid"].'></td>
		</tr>
		<tr>
		<td>New Password</td>
		<td><input type="text" name="newpwd" value="'.$row["firstname"].'"></td>
		</tr>
		<tr>
		<td>Verify New Password</td>
		<td><input type="text" name="vnewpwd" value="'.$row["lastname"].'"></td>
		</tr>
		<tr>
		<td colspan="2"><input type="submit" name="Submit" value="Save Changes"></td>
		</tr>
		</table>
  		</form>
		';
		}
	}
}

display_document_bottom();
?>

