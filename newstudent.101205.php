<?php
include "include/database.php";
include "include/user.php";

display_document_top();

echo '
  <div id="pageName"> 
    <h2>New Student Information </h2> 
  </div> 
  <div id="pageNav"> 
    <div id="sectionLinks"> 
      <a href="ebooks.php">Books e-Text</a> <a href="booksontape.php">Books on Tape</a> <a href="student.php">Students
      Link</a> <a href="request.php">Pending Requests</a> <a href="priority.php">Priority</a> <a href="rfbpriority.php">RFB&amp;D priority
      Link</a> <a href="ttehome.php">TTE</a> <a href="phorums/">ShiftLog</a> <a href="howto.php">Procedures</a> 
    </div> 
  </div>
  <div id="content"> 
    <div class="feature"> 

  <form action="studentpost.php" method="post">
	<table>
	<tr>
	<td>Student ID Number (123456789)</td>
	<td><input type="text" name="sid"></td>
	</tr>
	<tr>
	<td>First Name</td>
	<td><input type="text" name="firstname"></td>
	</tr>
	<tr>
	<td>Last Name</td>
	<td><input type="text" name="lastname"></td>
	</tr>
	<tr>
	<td>Telephone (999)123-4567</td>
	<td><input type="text" name="telephone"></td>
	</tr>
	<tr>
	<td>E-mail</td>
	<td><input type="text" name="email" size="75"></td>
	</tr>
	<tr>
	<td>Password</td>
	<td><input type="password" name="password"></td>
	</tr>
	<tr>
	<td>Confirm Password</td>
	<td><input type="password" name="confirm"></td>
	</tr>
	<tr>
	<td>Notes</td>
	<td><textarea name="notes" rows="3" cols="75"></textarea></td>
	</tr>
	<tr>
	<td colspan="2"><input type="submit" name="Submit" value="Submit"></td>
	</tr>
	</table>
  </form>
';

display_document_bottom();

?>
