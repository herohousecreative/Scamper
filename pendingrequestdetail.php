<?php
include "include/database.php";
include "include/user.php";

display_document_top();
echo '
  <div id="pageName"> 
    <h2>Pending Request Detail</h2>
  </div> 
  <div id="pageNav"> 
    <div id="sectionLinks"> 
      <a href="ebooks.php">Books e-Text</a> <a href="booksontape.php">Books on CD</a> <a href="student.php">Students
      Link</a> <a href="request.php">Pending Requests</a> <a href="priority.php">Priority</a> <a href="rfbpriority.php">Learning Ally (RFB&amp;D) Priority
      Link</a> <a href="ttehome.php">TTE</a> <a href="phorums/">ShiftLog</a> <a href="howto.php">Procedures</a> 
    </div> 
  </div>
  <div id="content"> 
    <div class="feature"> 
';

if ($_POST[verify_request]) 
{	$sql = "SELECT * from BOOKREQUEST WHERE requestid=".$_POST[requestid];
	$result = db_query($sql);
	if (!$result) 
	{
	echo "there was an error";
	} 
	elseif ($row = mysql_fetch_array($result)) 
	{
		$book_sql = "INSERT INTO BOOKS SET ftitle='".addslashes($row[title])."', FAUTHOR1LN='".addslashes($row[author1ln])."', FAUTHOR1FN='".addslashes($row[author1fn])."', 
			FAUTHOR1MI='".addslashes($row[author1mi])."', FAUTHOR2LN='".addslashes($row[author2ln])."', FAUTHOR2FN='".addslashes($row[author2fn])."', FAUTHOR2MI='".addslashes($row[author2mi])."', 
			FYEARPUB=".(int)$row[pubdate].", FEDITION='".addslashes($row[edition])."', FPUBLISHER='".addslashes($row[publisher])."', ffiletypes='".addslashes($row[filetypes])."', FTTEID=76";
		$book_result = db_query($book_sql);
		
		if (!$book_result) 
		{
			echo $book_sql;
			echo "There was an error";
		} 
		else 
		{
			$bookid = mysql_insert_id();

			$bs_sql = "INSERT INTO BSRELATION SET bookkey=".$bookid.", studentkey=".$row[studentid].", 
					reqsemester='".$row[reqsemester]."', notes='".addslashes($row[notes])."'";
			$bs_result = db_query($bs_sql);
			if (!$bs_result) 
			{
				echo "New Student Book relation could not be added";
			} 
			else 
			{
				$reqid= mysql_insert_id();
			}

			$retire_sql = "UPDATE BOOKREQUEST SET retired='Y', retired_date=now(), accepted=1  WHERE requestid=".$_POST[requestid];
			$retire_result = db_query($retire_sql);
			if (!$retire_result) 
			{
				echo mysql_error();
				echo "There was an error in your query<br>";
			} 
			else 
			{
				echo "<h2>Pending Request Verification Results</h2>";
				echo "<h3>Request has been successfully verified</h3>";
				echo "<h3><a href='requestdetail.php?requestid=".$reqid."'>View request details</a></h3>";
				echo "<h3><a href='studentdetail.php?studentkey=".$row[studentid]."'>View student details</a></h3>";
			}
		}
	}
} 
elseif ($_POST[decline_request]) {
		echo '<form action="pendingrequestdetail.php" method="POST">
		<input type="hidden" name="requestid" value="'.$_POST[requestid].'">
		<table>
		<td bgcolor="#DBCECE"><b>Decline Reason</b></td>
		<td><textarea name="reason" cols="50" rows="4"></textarea></td>
		</tr>
		<tr>
		<td colspan=2 align="center"><input type=submit name="delete_request" value="Decline Request"></td>
		</tr>
	
		</table>
		</form>
		';
} elseif ($_POST[delete_request]) {
	$retire_sql = "UPDATE BOOKREQUEST SET retired='Y', accepted=0, retired_date=now(), retired_reason='".addslashes($_POST[reason])."' WHERE requestid=".$_POST[requestid];
	$retire_result = db_query($retire_sql);
	if (!$retire_result) {
		echo mysql_error();
		echo "There was an error in your query<br>";
	} else {
		echo "The user request has been successfully declined<br>";	
	}
} else {
	
	$previous=$GLOBALS["HTTP_REFERER"];

	$requestid = $_GET[requestid];
	$sql = "SELECT * from BOOKREQUEST WHERE retired='N' AND requestid=".$requestid;
	$result= db_query($sql);

	if (db_numrows($result) == 0) {
	   echo '<br><h2>There are no requests! <br><br><a href="newbook.php">Enter a new book.</a></h2><br>';
	} else {
	  if ($row = mysql_fetch_array($result)) {
		$first_author = $row[author1ln].", ".$row[author1fn]." ".$row[author1mi];
		$second_author = $row[author2ln].", ".$row[author2fn]." ".$row[author2mi];
		$pubyear = $row[pubdate];
		echo '<form action="pendingrequestdetail.php" method="POST">
		<input type="hidden" name="requestid" value="'.$requestid.'">
		<table>
		<tr>
		<td bgcolor="#DBCECE"><b>Title</b></td>
		<td >'.$row[title].'</td>
		</tr>
		<tr>
		<td bgcolor="#DBCECE"><b>First Author</b></td>
		<td>'.$first_author.'</td>
		</tr>
		<tr>
		<td bgcolor="#DBCECE"><b>Second Author</b></td>
		<td>'.$second_author.'</td>
		</tr>
		<td bgcolor="#DBCECE"><b>Pub. Year</b></td>
		<td>'.$pubyear.'</td>
		</tr>
		<tr>
		<td bgcolor="#DBCECE"><b>Edition</b></td>
		<td>'.$row[edition].'</td>
		</tr>
		<tr>
		<td bgcolor="#DBCECE"><b>Publisher</b></td>
		<td>'.$row[publisher].'</td>
		</tr>
		<tr>
		<td bgcolor="#DBCECE"><b>Requested Format(s)</b></td>
		<td>'.$row[filetypes].'</td>
		</tr>
		<tr>
		<td bgcolor="#DBCECE"><b>Course</b></td>
		<td>'.$row[course].'</td>
		</tr>
		<tr>
		<td bgcolor="#DBCECE"><b>Notes</b></td>
		<td>'.$row[notes].'</td>
		</tr>
		<tr>
		<td><input type=submit name="verify_request" value="Verify Request"></td>
		<td><input type=submit name="decline_request" value="Decline Request"></td>
		</tr>
	
		</table>
		</form>
		';
	  }

	}
}
display_document_bottom();

?>
