<?php
include "include/database.php";
include "include/user.php";

display_document_center_top ();
echo '
  <div id="pageName"> 
    <h2>Student Post Results</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';
//chk_dpu and chk_blank functions were introduced to 
//validate sid on entry(prevent duplicates) and prevent blanks. 

$chk_dup=dup_sid($sid);
//echo "dup sid function returns $chk_dup for $sid... ";
$chk_blnk=blank_flds($sid,$firstname,$lastname);
$result=insert_student($sid,addslashes($firstname),addslashes($lastname),$telephone,$email,$password,addslashes($notes));

if (!$chk_dup)	{
	echo "<h2><font color='red'>This Student Id already exists!<br>
		Please go back or click on Add Student.</font><h2>
		<h3><a href=\"newstudent.php\">Add student</a></h3>";
		}
elseif (!$chk_blnk)	{
	echo "<h2><font color='red'>Required fields are blank.<br>
		Please go back or click on Add Student.</font><h2>
		<h3><a href=\"newstudent.php\">Add student</a></h3>";
			}	
elseif (!$result) {
  echo "<h2><font color='red'>There was an error in your post.<br>
		Please go back or click on Add Student.</font><h2>
		<h3><a href=\"newstudent.php\">Add student</a></h3>";
} else {
  $id = mysql_insert_id();
  echo "<h3>Student posted successfully!</h3><br>
	<h2><a href=\"studentdetail.php?studentkey=$id\">Add requests for $firstname $lastname</a></h2>
	<h2><a href=\"newstudent.php\">Add another student</a></h2>";
}

display_document_bottom();

?>
