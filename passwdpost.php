<?php
include "include/database.php";
include "include/user_passwd.php";

display_document_center_top ();
echo '
  <div id="pageName"> 
    <h2>Change Password Results</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';

//$chk_dup=dup_passwd($uname);
$result=update_password($oldpwd,$newpwd);

//if ($chk_dup)	{
//	echo "<h2><font color='red'>Please do not use the old password!<br>
//		Please go back to change password.</font><h2>
//		<h3><a href=\"cpass.php\">Change Password</a></h3>";
//		}
//elseif (!$result) {
if (!$result) {
  echo "<h2><font color='red'>There was an error in your post.<br>
		Please go back to change password.</font><h2>
		<h3><a href=\"cpass.php\">Change Password</a></h3>";
} else {
	echo $feedback;
  echo "<h3>Password changed successfully!</h3><br>
}

display_document_bottom();

?>
