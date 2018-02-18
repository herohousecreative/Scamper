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

//				"pickedup","returned","returnedtorfbd","notes",
//				"frfbd_ordered","frfbd_received","reqdate");


	foreach ($column_array as $column) {
		$sql .= $column."='".$_POST[$column]."', ";
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

	//$sql = "SELECT A.*,B.ftitle from BSRELATION as A LEFT JOIN BOOKS as B on A.bookkey=B.FTTEBOOKID 
	//	WHERE primarykey=".$requestid;
	//$sql = "SELECT A.*,B.ftitle,S.firstname,S.lastname,B.frfbdnumber 
	//	from STUDENTS S, BSRELATION as A LEFT JOIN BOOKS as B on A.bookkey=B.FTTEBOOKID 
	//	WHERE A.studentkey = S.primarykey and A.primarykey=".$requestid;
	//$sql = "SELECT A.*,B.ftitle,S.firstname,S.lastname,B.frfbdnumber,R.reqdate,R.course
         //       from STUDENTS S,BOOKREQUEST R, BSRELATION as A LEFT JOIN BOOKS as B on A.bookkey=B.FTTEBOOKID
          //      WHERE A.studentkey = S.primarykey and R.studentid = A.studentkey and R.title = B.ftitle
           //     and R.filetypes='RFB' and A.primarykey=".$requestid;
                ///WHERE R.filetypes='RFB' and A.primarykey=".$requestid;
                ///WHERE  R.filetypes in ('TXT,HTML','HTML,'MP3','RFB') and A.primarykey=".$requestid;

                ///from BSRELATION as A LEFT JOIN (BOOKS as B,STUDENTS S,BOOKREQUEST R)

	$sql = "SELECT A.*,B.ftitle,S.firstname,S.lastname,B.frfbdnumber,R.reqdate,R.course
                from bsrelation_test as A LEFT JOIN (BOOKS as B,STUDENTS S,BOOKREQUEST R)
                on (A.bookkey=B.FTTEBOOKID and A.studentkey = S.primarykey and R.studentid = A.studentkey)
                WHERE A.bookkey=B.FTTEBOOKID and A.studentkey = S.primarykey and 
			R.studentid = A.studentkey and A.primarykey=".$requestid;

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
		<td>Requested By</td>
		<td><a href="studentdetail.php?studentkey='.$row[studentkey].'">'.$row["firstname"]." ".$row["lastname"].'</a></td>
		</tr>
		<tr>
		<td>Date Requested</td>
		<td><input type="text" size="15" readonly="true" value="'.$row[reqdate].'"></td>
		</tr>
		<tr>
		<td>Requested Semester</td>
		<td><input type="text" size="3" name="reqsemester" value="'.$row[reqsemester].'"></td>
		</tr>
		<tr>
		<td>Course </td>
		<td><input type="text" size="15" readonly="true" value="'.$row[course].'"></td>
		</tr>
		<tr>
		<td>Book Title</td>
		<td><a href="bookdetail1.php?bookkey='.$row[bookkey].'">'.$row[ftitle].'</a>( link to bookdetails page )</td>
		</tr>
		<tr>
		<td>RFBD Number</td>
		<td><input type="text" size="15" readonly="true" value="'.$row[frfbdnumber].'"></td>
		</tr>
		<tr>
		<td>RFBD Order Date</td>
		<td><input type="text" size="15" name="frfbd_ordered" value="'.$row[frfbd_ordered].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>RFBD Received Date</td>
		<td><input type="text" size="15" name="frfbd_received" value="'.$row[frfbd_received].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>Student First Contact Date</td>
		<td><input type="text" size="15" name="called1" value="'.$row[called1].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>Student Second Contact Date</td>
		<td><input type="text" size="15" name="called2" value="'.$row[called2].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>Student Third Contact Date</td>
		<td><input type="text" size="15" name="called3" value="'.$row[called3].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>Student Pick Up Date</td>
		<td><input type="text" size="15" name="pickedup" value="'.$row[pickedup].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>Student Return Date</td>
		<td><input type="text" size="15" name="returned" value="'.$row[returned].'"> (YYYY-MM-DD)</td>
		</tr>
		<tr>
		<td>Return to RFBD Date</td>
		<td><input type="text" size="15" name="returnedtorfbd" value="'.$row[returnedtorfbd].'"> (YYYY-MM-DD)</td>
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

