<?php
include "include/database.php";
include "include/user.php";

display_document_center_top();
echo '
  <div id="pageName"> 
    <h2>Request Detail</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';

if ($_POST[save_request]) {
	$sql = "UPDATE BSRELATION SET ";
	$column_array = array("reqsemester","servsemester","promisedate","called1","called2","called3",
					"pickedup","returned","returnedtorfbd","notes");
	foreach ($column_array as $column) {
		$sql .= $column."='".addslashes($_POST[$column])."', ";
	}
	$sql = substr($sql,0,strlen($sql)-2)." WHERE primarykey=".$_POST[requestid];
	$result = db_query($sql);
	if (!$result) {
		echo "There was an error in the query.";
	} else {
		echo "Request details are successfully updated.";
	}
} else {
	$previous=$GLOBALS["HTTP_REFERER"];
	$requestid = $_GET[requestid];

	$sql = "SELECT A.*,B.ftitle from BSRELATION as A LEFT JOIN BOOKS as B on A.bookkey=B.FTTEBOOKID 
		WHERE primarykey=".$requestid;
	$result= db_query($sql);


	if (db_numrows($result) == 0) {
	   echo '<br><h2>There are no requests <a href="newbook.php">Enter a new book.</a></h2><br>';
	} else {
	  if ($row = mysql_fetch_array($result)) {
		$first_author ="";
		$second_author = "";
		echo '<form action="requestdetail.php" method="POST">
		<input type="hidden" name="requestid" value="'.$requestid.'">
		<table>
		<tr>
		<tr>
		<td>Book Title</td>
		<td><a href="bookdetail.php?bookkey='.$row[bookkey].'">'.$row[ftitle].'</a></td>
		</tr>
		<tr>
		<td>Requested Semester</td>
		<td><input type="text" size="3" name="reqsemester" value="'.$row[reqsemester].'"></td>
		</tr>
		<tr>
		<td>Promise Date</td>
		<td><input type="text" size="10" name="promisedate" value="'.$row[promisedate].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>First Contact Date</td>
		<td><input type="text" size="10" name="called1" value="'.$row[called1].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>Second Contact Date</td>
		<td><input type="text" size="10" name="called2" value="'.$row[called2].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>Third Contact Date</td>
		<td><input type="text" size="10" name="called3" value="'.$row[called3].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>Learning Ally (RFB&amp;D) Book Student Pick Up Date</td>
		<td><input type="text" size="10" name="pickedup" value="'.$row[pickedup].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>Learning Ally (RFB&amp;D) Book Student Return Date</td>
		<td><input type="text" size="10" name="returned" value="'.$row[returned].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>Book Returned to Learning Ally (RFB&amp;D)</td>
		<td><input type="text" size="10" name="returnedtorfbd" value="'.$row[returnedtorfbd].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td valign=top>Notes (about Student Request)<br><i>These notes are viewable by student in GMB</i></td>
		<td><textarea cols="50" rows="4" name="notes">'.$row[notes].'</textarea></td>
		</tr>
		<tr>
		<td colspan="2"><input type=submit name="save_request" value="Save Changes"></td>
		</tr>
		
		</table>
		</form>
		<br><p align=right><a href="priority.php?delrequest='.$row["primarykey"].'">Delete Request</a></p>
		';
	  	}
	}
}


display_document_bottom();

?>

