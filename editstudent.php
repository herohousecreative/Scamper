<?php
include "include/database.php";
include "include/user.php";

display_document_center_top();
$studentkey = $_GET[studentkey];
if ($_POST[Submit]) {
	$sql = "UPDATE STUDENTS SET ";
	$column_array = array("sid","firstname","lastname","telephone","email","password","notes");
	foreach ($column_array as $column) {
		$sql .= $column."='".addslashes($_POST[$column])."', ";
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
		echo "<h3><a href='studentdetail.php?studentkey=$_POST[studentkey]'>View this student details</a></h3>";
	}
} else {
	//$studentkey = $_GET[studentkey];
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
		<td>Student ID Number (123456789)</td>
		<td><input type="text" name="sid" value='.$row["sid"].'></td>
		</tr>
		<tr>
		<td>First Name</td>
		<td><input type="text" name="firstname" value="'.$row["firstname"].'"></td>
		</tr>
		<tr>
		<td>Last Name</td>
		<td><input type="text" name="lastname" value="'.$row["lastname"].'"></td>
		</tr>
		<tr>
		<td>Telephone (999)123-4567</td>
		<td><input type="text" name="telephone" value="'.$row["telephone"].'"></td>
		</tr>
		<tr>
		<td>E-mail</td>
		<td><input type="text" name="email" size="75" value="'.$row["email"].'"></td>
		</tr>
		<tr>
		<td>Password</td>
		<td><input type="password" name="password" size="75" value="'.$row["password"].'"></td>
		</tr>
		<td>Notes</td>
		<td><textarea name="notes" rows="3" cols="75">'.$row["notes"].'</textarea></td>
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

