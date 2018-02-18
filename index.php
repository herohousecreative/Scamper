<?php
include "include/database.php";
include "include/user.php";

display_document_top();
echo '
  <div id="pageName"> 
    <h2>Home</h2> 
  </div> 
  <div id="content"> 
    <div class="feature" role="main"> 

<h3>Students <a href="newstudent.php" style="font-size: 13px;">Add new</a></h3>
<blockquote>
<p>Enter the whole or partial last name of the student you are interested in:</p>
<form name="form1" method="post" action="student.php" role="search" aria-label="Student search">
  <input type="text" name="lastname" label="Student\'s last name">
  <input type="submit" name="Submit" value="Find Student">
</form>
</blockquote>

<h3>Books <a href="newbook.php" style="font-size: 13px;">Add new</a> | <a href="addrequest.php?studentid=655" style="font-size:13px;">Add Preemptive Request</a></h3>
<blockquote>
<p>Enter the whole or partial title of the book you are interested in:</p>
<form name="form2" method="post" action="ebooks.php" role="search" aria-label="Book search">
  <input type="text" name="title">
  <input type="submit" name="Submit2" value="Find Book">
</form>
</blockquote>

<h3>Reports</h3>
<blockquote>
<p>To view all approved book requests by semester, enter semester code:</p>
<form name="form3" method="post" action="requestquery.php">
  <input type="text" name="semquery">
  <input type="submit" name="Submit3" value="Run Report"> by Student
</form>

<br>
<form name="form4" method="post" action="requestquerybytitle.php">
  <input type="text" name="semquery">
  <input type="submit" name="Submit3" value="Run Report"> by Title
</form>
<p><a href="requestsummary.php">Summary of all processed requests</a></p>
<p><a href="request-all.php">All GMB requests submitted for current semester (by student)</a></p>
</blockquote>
';

display_document_bottom();

?>
