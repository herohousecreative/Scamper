bookdetail1.php:	$sql1="select pickedup, returned from BSRELATION where primarykey=".$requestkey;
bookdetail1.php:	$sql="UPDATE BSRELATION set pickedup='".$_POST[rfbd_pickedup]."', returned='".$_POST[rfbd_returned]."' where primarykey=".$_POST[requestkey];
bookdetail.php:	$sql1="select pickedup, returned from BSRELATION where primarykey=".$requestkey;
bookdetail.php:	$sql="UPDATE BSRELATION set pickedup='".$_POST[rfbd_pickedup]."', returned='".$_POST[rfbd_returned]."' where primarykey=".$_POST[requestkey];
bookstore.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
display_student.php:	$sql = "SELECT * FROM BSRELATION WHERE studentkey = $student_key";
pendingrequestdetail.php:			$bs_sql = "INSERT INTO BSRELATION SET bookkey=".$bookid.", studentkey=".$row[studentid].", 
priority.092205.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
priority.112305.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
priority1.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
priority2.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
priority-next.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
priority_old2.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
priority-old.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
priority.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
priority-test.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
requestdetail1.php:	$sql = "UPDATE BSRELATION SET ";
requestdetail1.php:	//$sql = "SELECT A.*,B.ftitle from BSRELATION as A LEFT JOIN BOOKS as B on A.bookkey=B.FTTEBOOKID 
requestdetail1.php:	//	from STUDENTS S, BSRELATION as A LEFT JOIN BOOKS as B on A.bookkey=B.FTTEBOOKID 
requestdetail1.php:         //       from STUDENTS S,BOOKREQUEST R, BSRELATION as A LEFT JOIN BOOKS as B on A.bookkey=B.FTTEBOOKID
requestdetail1.php:                from BSRELATION as A LEFT JOIN (BOOKS as B,STUDENTS S,BOOKREQUEST R)
requestdetail.php:	$sql = "UPDATE BSRELATION SET ";
requestdetail.php:	$sql = "SELECT A.*,B.ftitle from BSRELATION as A LEFT JOIN BOOKS as B on A.bookkey=B.FTTEBOOKID 
rfbpriority.092105.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
rfbpriority.120305.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
rfbpriority1.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
rfbpriority_old2.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
rfbpriority_old4.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
rfbpriority.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
rfbpriority_test.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
studentdetail.121105.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
studentdetail1.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
studentdetail2.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
studentdetail.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
studentdetail.test.php:      $delreqsql="delete from BSRELATION where primarykey=".$delrequest;
user.php:       "from BSRELATION R, BOOKS B " .
user.php:  $sql="SELECT R.primarykey ,S.primarykey as currentstudent,S.sid,S.firstname,S.lastname,S.telephone,S.email from BSRELATION R, STUDENTS S where R.bookkey = $bookkey and R.reqsemester = '" . $semester ."' and R.studentkey = S.primarykey order by S.lastname";
user.php:  $sql="SELECT R.primarykey ,S.primarykey as currentstudent,S.sid,S.firstname,S.lastname,S.telephone,S.email from BSRELATION R, STUDENTS S where R.primarykey = $requestkey and R.reqsemester = '" . $semester ."' and R.studentkey = S.primarykey order by S.lastname";
user.php:  $sql="INSERT INTO BSRELATION(studentkey,bookkey,reqsemester) ".
user.php:  $sql="SELECT bookkey from BSRELATION where studentkey = $studentkey";
user.php:	$sql = "INSERT INTO BSRELATION SET studentkey=".$studentid.",
user.php:  $sql="delete from BSRELATION where primarykey = $bskey";
user.php:   . "from BOOKS B, BSRELATION S "
user.php:   . "from BOOKS B, BSRELATION S "
