<?php
include "include/database.php";
include "include/user_passwd.php";

display_document_top();

echo '
  <div id="pageName"> 
    <h2>Change Password Screen </h2> 
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

  <form action="passwdpost.php" method="post">
	<table cellspacing="10">
		<tr>
                <td>Old Password </td>
                <td><input type="password" name="oldpwd"></td>
                </tr>
                <tr>
                <td>New Password</td>
                <td><input type="password" name="newpwd"></td>
                </tr>
		<tr>
		<td>Confirm Password</td>
		<td><input type="password" name="confirm"></td>
		</tr>
        	<tr>
        	<td colspan="2"><input type="submit" name="Submit" value="Submit"></td>
        	</tr>
	</table>
  </form>
';
display_document_bottom();

?>
