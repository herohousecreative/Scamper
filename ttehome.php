<?php
include "include/database.php";
include "include/user.php";

display_document_top();
echo '
  <div id="pageName"> 
    <center><h2>TTE Administration</h2></center> 
  </div> 
  <div id="pageNav"> 
    <div id="sectionLinks"> 
      <a href="ebooks.php">Books e-Text</a> <a href="booksontape.php">RFBD Books</a> <a href="student.php">Students
      Link</a> <a href="request.php">Pending Requests</a> <a href="priority.php">Scanning Priority</a> <a href="rfbpriority.php">RFB&amp;D priority
      Link</a> <a href="ttehome.php">TTE</a> <a href="phorums/">ShiftLog</a> <a href="howto.php">Procedures</a> 
    </div> 
  </div>
  <div id="content"> 
    <div class="feature"> 
	
<h4><a href="ttebookreview.php">Books to Review for TTE Library</a> (TTE Flag=N)</h4>
<h4><a href="ttebookreview2.php">Books to Review for TTE Library</a> (TTE Flag=N, FCheckComplete=N)</h4>
<h4><a href="ttebookreview3.php">Books to Review for TTE Library</a> (FCheckComplete=N & FTTEID!=76)</h4>

<h3>Members </h3>
<p>Enter the whole or partial <b>last name</b> or <b>organization name</b> of the member you are searching for:<br>
<i>(Leave blank if you want a list of all members)</i></p>
<form name="form1" method="post" action="ttemember.php">
  <input type="text" name="lastname">
  <input type="submit" name="Find" value="Search for Member or Organization">
 </form>

<form name="form2" method="post" action="ttenewmember.php"> 
  <p>
	<input type="submit" name="Add" value="Add New Member">
  </p>
</form>

<h3>Books </h3>
<p>Enter the whole or partial title of the book you are interested in:</p>
<form name="form2" method="post" action="ttebook.php">
  <input type="text" name="title">
  <input type="submit" name="Submit2" value="Find Book">
</form>

<p>&nbsp;</p>
';
display_document_bottom();

?>
