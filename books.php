<?php
include "include/database.php";
include "include/user.php";

display_document_top();
echo '
  <div id="pageName"> 
    <h2>Book Administration</h2> 
  </div> 
  <div id="pageNav"> 
    <div id="sectionLinks"> 
      <a href="ebooks.php">Books e-Text</a> <a href="booksontape.php">Books on Tape</a> <a href="student.php">Students
      </a> <a href="request.php">Pending Requests</a> <a href="priority.php">Priority</a> <a href="rfbpriority.php">RFB&amp;D priority
      </a> <a href="ttehome.php">TTE</a> <a href="phorums/">ShiftLog</a> <a href="howto.php">Procedures</a> 
    </div> 
  </div>
  <div id="content"> 
    <div class="feature"> 
<h3>Students</h3>
<p>Enter the whole or partial last name of the student you are interested in:</p>
<form name="form1" method="post" action="student.php">
  <input type="text" name="lastname">
  <input type="submit" name="Submit" value="Find Student">
</form>
<p>&nbsp;</p>
<h3>Books</h3>
<p>Enter the whole or partial title of the book you are interested in:</p>
<form name="form2" method="post" action="ebooks.php">
  <input type="text" name="title">
  <input type="submit" name="Submit2" value="Find Book">
</form>
<p>&nbsp;</p>
';

display_document_bottom();
?>
