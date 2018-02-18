<?php
include "include/database.php";
include "include/user.php";

display_document_top();
echo '
  <div id="pageName"> 
    <h2>Check the status of your books</h2> 
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
';
?>

<p>Welcome to the Texas A & M book system.  Please login to check the stus of
your text books.  This web site will also allow you to read your text books online.  The get started, please enter your student id.  the student id should not contain any dashis "-".  It should be in the form of 123456789.
</p>
<form name="form1" method="post" action="display_student.php">
  <input type="text" name="studentsid" title="enter your student ID">
<p>Now, please enter the semester you want to check on the status of your
books.  Also remember that if you have submitted books in a previous semester,
you must enter that semester in below.  If you are unsure which semester you
submitted books for, you can just type the year and the system will show all the
books you have requested.  The system will then show you all the books for
that year.  It will show you what semester you had requested that book in.
Please remember that semesters are entered as year
pluss a letter a, b, or c.
  <ul>
  <li>where year is entered as the last 2 digits of the year you are looking
  for.  For example, if you are looking for books in 2003, you would enter it
  is 03.</li>
  <li>a would be the spring semester</li>
  <li>b would be summer one and two</li>
  <li>c would be the fall semester</li>
  </ul>
  <input type="text" name="check_semester" title="semester"><br>
  <input type="submit" name="Submit" title="Get Status of books">
  </form>

<?php

display_document_bottom();

?>