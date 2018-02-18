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

$result=insert_student($sid,$firstname,$lastname,$telephone,$email,$password,$notes);
if (!$result) {
  echo "There was an error in your post<br>
		<h3><a href=\"newstudent.php\">Add student</a></h3>";
} else {
  $id = mysql_insert_id();
  echo "<h3>Student posted successfully!</h3><br>
	<h2><a href=\"studentdetail.php?studentkey=$id\">Add requests for $firstname $lastname</a></h2>
	<h2><a href=\"newstudent.php\">Add another student</a></h2>";
}

display_document_bottom();

?>
