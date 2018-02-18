<?php

function dup_sid($sid) {
        $sql="select sid from STUDENTS where sid=$sid";
                $result=db_query($sql);
                $sid_qry=db_numrows($result);

//echo "query returns $sid_qry for $sid ...";

                if (!$sid_qry) {
                        return true;
                        } else {
                                return false;
                                }
}

function blank_flds($sid,$firstname,$lastname) {
                if ((!$sid) or (!$firstname) or (!$lastname)) {
                        return false;
                        } else {
                                return true;
                                }
}


function insert_student($sid,$firstname,$lastname,$telephone,$email,$password,$notes) {
//  if ($password != "") {
//  	$password = md5('$password');
//  }

$sid_qry=dup_sid($sid);
$blnk_qry=blank_flds($sid,$firstname,$lastname);

if (!$sid_qry) 	{
		return false;
		}
elseif (!$blnk_qry)	{
			return false;
			}
else	{
  $sql="INSERT INTO STUDENTS(sid,firstname,lastname,telephone,email,password,notes) ".
       "VALUES ('$sid','$firstname','$lastname','$telephone','$email','$password','$notes')";
  $result=db_query($sql);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}
}

function select_student($lastname,$studentkey) {
  global $feedback; 
  //var_dump ($studentkey);
  if ($lastname=='xyz') {
    $sql="SELECT primarykey as studentkey, sid, firstname, lastname, telephone, email, password, notes from STUDENTS where primarykey = $studentkey";
  }else {
    $sql="SELECT primarykey as studentkey, sid, firstname, lastname, telephone, " .
	     "email, password, notes from STUDENTS where lastname like '%$lastname%' order by ".
	     "lastname";
  }
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback="<br><h2>Student not found. <a href=\"newstudent.php\">Enter a new student.</a></h2><br>";
    return false;
  } else {
    return $result;
  }
}

function select_pendingrequests($studentkey,$semester,$nextsemester) {
  global $feedback,$sql;
  $sql="SELECT requestid, reqdate, title, course, filetypes, author1ln, author1fn FROM BOOKREQUEST
       where retired='N' and studentid = ".$studentkey." and (reqsemester = '" . $semester ."' OR reqsemester = '" . $nextsemester ."') order by title";
//	    where retired='N' and studentid = ".$studentkey." and reqsemester = '" . $semester ."' order by title";
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1){
	$feedback='Student does not have pending book requests for this semester<br>';
    return false;
  } else {
    return $result;
  }
}

function select_requests($studentkey,$semester) {
  global $feedback,$sql;
  $sql="SELECT R.primarykey as bskey, B.FTTEBOOKID as bookkey, B.ftitle, B.FAUTHOR1LN, B.FAUTHOR1FN, B.ffiletypes " .
       "from BSRELATION R, BOOKS B " .
       "where R.studentkey = $studentkey " .
       "and R.reqsemester = '" . $semester .
       "' and R.bookkey = B.FTTEBOOKID order by B.ftitle";

  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1){
	$feedback='Student has not requested any books at this semester!<br>';
    return false;
  } else {
    return $result;
  }
}

function select_otherrequests($studentkey,$semester) {
  global $feedback,$sql;
  $sql="SELECT R.primarykey as bskey, R.reqsemester, B.FTTEBOOKID as bookkey, B.ftitle, B.FAUTHOR1LN, B.FAUTHOR1FN, B.ffiletypes " .
       "from BSRELATION R, BOOKS B " .
       "where R.studentkey = $studentkey " .
       "and R.reqsemester <> '" . $semester .
       "' and R.bookkey = B.FTTEBOOKID order by R.reqsemester, B.ftitle";

  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1){
	$feedback='Student has not requested any books during other semesters!<br>';
    return false;
  } else {
    return $result;
  }
}

function select_allrequests($studentkey,$semester) {
  global $feedback,$sql;
  $sql="SELECT R.primarykey as bskey, R.reqsemester, R.studentkey, B.FTTEBOOKID as bookkey, B.ftitle, B.FAUTHOR1LN, B.FAUTHOR1FN, B.ffiletypes, D.firstname, D.lastname " .
       "from BSRELATION R, BOOKS B, STUDENTS D " .
	   "where R.bookkey = B.FTTEBOOKID AND D.primarykey=R.studentkey order by B.ftitle";

  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1){
	$feedback='There are no requests this semester!<br>';
    return false;
  } else {
    return $result;
  }
}

function select_requestquery($studentkey,$semester,$semquery) {
  global $feedback,$sql;
  if ($semquery=='') {
  	$sql="SELECT R.primarykey as bskey, R.reqsemester, R.studentkey, B.FTTEBOOKID as bookkey, B.ftitle, B.FAUTHOR1LN, B.FAUTHOR1FN, B.ffiletypes, D.firstname, D.lastname " .
       "from BSRELATION R, BOOKS B, STUDENTS D " .
	   "where R.bookkey = B.FTTEBOOKID AND D.primarykey=R.studentkey order by B.ftitle";
  }else {
  	$sql="SELECT R.primarykey as bskey, R.reqsemester, R.studentkey, B.FTTEBOOKID as bookkey, B.ftitle, B.FAUTHOR1LN, B.FAUTHOR1FN, B.ffiletypes, D.firstname, D.lastname " .
       "from BSRELATION R, BOOKS B, STUDENTS D " .
	   "where R.bookkey = B.FTTEBOOKID AND D.primarykey=R.studentkey AND R.reqsemester = '" . $semquery .
       "' order by D.lastname, D.firstname";
  }

  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1){
	$feedback='There are no requests this semester!<br>';
    return false;
  } else {
    return $result;
  }
}

function select_requestquerybytitle($studentkey,$semester,$semquery) {
  global $feedback,$sql;
  if ($semquery=='') {
  	$sql="SELECT R.primarykey as bskey, R.reqsemester, R.studentkey, B.FTTEBOOKID as bookkey, B.ftitle, B.FAUTHOR1LN, B.FAUTHOR1FN, B.ffiletypes, D.firstname, D.lastname " .
       "from BSRELATION R, BOOKS B, STUDENTS D " .
	   "where R.bookkey = B.FTTEBOOKID AND D.primarykey=R.studentkey order by B.ftitle";
  }else {
  	$sql="SELECT R.primarykey as bskey, R.reqsemester, R.studentkey, B.FTTEBOOKID as bookkey, B.ftitle, B.FAUTHOR1LN, B.FAUTHOR1FN, B.ffiletypes, D.firstname, D.lastname " .
       "from BSRELATION R, BOOKS B, STUDENTS D " .
	   "where R.bookkey = B.FTTEBOOKID AND D.primarykey=R.studentkey AND R.reqsemester = '" . $semquery .
       "' order by B.ftitle";
  }

  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1){
	$feedback='There are no requests this semester!<br>';
    return false;
  } else {
    return $result;
  }
}

function select_requestquery2($studentkey,$semester,$semquery2) {
  global $feedback,$sql;
  if ($semquery2=='') {
  	$sql="SELECT *, BOOKREQUEST.notes, reqdate, filetypes, requestid, studentid, title, concat(firstname,\" \",lastname) as name, reqsemester" .
		"from BOOKREQUEST left join STUDENTS on BOOKREQUEST.studentid = STUDENTS.primarykey " .
		"WHERE retired='N' order BY course";
  }else {
  	$sql="SELECT *, BOOKREQUEST.notes, reqdate, filetypes, requestid, studentid, title, concat(firstname,\" \",lastname) as name, reqsemester" .
		"from BOOKREQUEST left join STUDENTS on BOOKREQUEST.studentid = STUDENTS.primarykey " .
		"WHERE retired='N' AND reqsemester = " . $semquery2 . "'order BY course";
  }

  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1){
	$feedback='There are no requests this semester!<br>';
    return false;
  } else {
    return $result;
  }
}


function select_book($bookkey,$title,$filetype) {
  global $feedback;
  if ($bookkey == '') {
	if ($filetype == "tape") {
		$sql="SELECT *,FTTEBOOKID as bookkey from BOOKS where ftitle like '%$title%' AND 
			(FIND_IN_SET('RFB',ffiletypes)>0 OR FIND_IN_SET('VOL',ffiletypes)>0) order by ftitle, fauthor1ln";
	} elseif ($filetype == "ebook") {
		$sql="SELECT *,FTTEBOOKID as bookkey from BOOKS where ftitle like '%$title%' AND
			(ffiletypes!='RFB' AND ffiletypes!='VOL') order by ftitle, fauthor1ln";
	} else {
		$sql="SELECT *,FTTEBOOKID as bookkey from BOOKS where ftitle like '%$title%' order by ftitle, fauthor1ln";
	}
  } else {	
    $sql="SELECT *, FTTEBOOKID as bookkey from BOOKS where FTTEBOOKID = $bookkey";
  }
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h3>Book not found. <a href="newbook.php">Enter a new book</a></h3>';
    return false;
  } else {
    return $result;
  }
}

function insert_book($title,$author1ln,$author1fn,$author1mi,$author2ln,$author2fn,$author2mi,
				$author3ln,$author3fn,$author3mi,$author4ln,$author4fn,$author4mi,
				$author5ln,$author5fn,$author5mi,$author6ln,$author6fn,$author6mi,
				$fmorethan6,$fisbn,$publisher,$placepub,$edition,$media,$translation,$transln,
				$transfn,$transmi,$corporate,$corporatename,$collection,
				$reprint,$repautholn,$repauthorfn,$repauthormi,$multivolume,
				$lastvolume,$lastvolyear,$series,$seriestitle,$rfbd_onhand,
				$rfbd_checked,$rfbd_hasit,$rfbdnumber,$rfbd_ordered,
				$rfbd_received,$bs_checked,$bs_promised,$bs_hasit,
				$bs_pickedup,$scancomplete,$ocrcomplete,$checkcomplete,
				$tapescomplete,$notes,$pubyear) {
  global $feedback,$sql;

  
  //store a false value for the boolean fields
  if (!$pubyear){ $pubyear = 0;}
  if (!$lastvolume){ $lastvolume = 0;}
  if (!$lastvolyear){ $lastvolyear = 0;}
  if (!$rfbd_onhand){ $rfbd_onhand = 0;}
  if (!$rfbd_checked){ $rfbd_checked = 0;}
  if (!$rfbd_hasit){ $rfbd_hasit = 0;}
  if (!$bs_checked){ $bs_checked = 0;}
  if (!$scancomplete){ $scancomplete = 0;}
  if (!$ocrcomplete){ $ocrcomplete = 0;}
  if (!$checkcomplete){ $checkcomplete = 0;}
  if (!$tapescomplete){ $tapescomplete = 0;}

$sql="INSERT INTO BOOKS SET	ftitle='$title',
				FAUTHOR1LN='$author1ln',
				FAUTHOR1FN='$author1fn',
				FAUTHOR1MI='$author1mi',
				FAUTHOR2LN='$author2ln',
				FAUTHOR2FN='$author2fn',
				FAUTHOR2MI='$author2mi',
				FAUTHOR3LN='$author3ln',
				FAUTHOR3FN='$author3fn',
				FAUTHOR3MI='$author3mi',
				FAUTHOR4LN='$author4ln',
				FAUTHOR4FN='$author4fn',
				FAUTHOR4MI='$author4mi',
				FAUTHOR5LN='$author5ln',
				FAUTHOR5FN='$author5fn',
				FAUTHOR5MI='$author5mi',
				FAUTHOR6LN='$author6ln',
				FAUTHOR6FN='$author6fn',
				FAUTHOR6MI='$author6mi',
				fmorethan6='$fmorethan6',
				FISBN='$fisbn',
				FPUBLISHER='$publisher',
				FPLACEPUB='$placepub',
				FEDITION='$edition',
				ffiletypes='$media',
				ftranslation='$translation',
				FTRANSLN='$transln',
				FTRANSFN='$transfn',
				FTRANSMI='$transmi',
				fcorporate='$corporate',
				FCORPORATENAME='$corporatename',
				fcollection='$collection',
				freprint='$reprint',
				FREPAUTHORLN='$repauthorln',
				FREPAUTHORFN='$repauthorfn',
				FREPAUTHORMI='$repauthormi',
				fmultivolume='$multivolume',
				FLASTVOLUME=$lastvolume,
				FLASTVOLYEAR=$lastvolyear,
				fseries='$series',
				FSERIESTITLE='$seriestitle',
	                     	frfbd_onhand=$rfbd_onhand,
				frfbd_checked=$rfbd_checked,
				frfbd_hasit=$rfbd_hasit,
				frfbdnumber='$rfbdnumber',
				frfbd_ordered='$rfbd_ordered',
				frfbd_received='$rfbd_received',
				fbs_checked=$bs_checked,
				fbs_promised='$bs_promised',
				fbs_hasit='$bs_hasit',
				fbs_pickedup='$bs_pickedup',
				fscancomplete=$scancomplete,
				focrcomplete=$ocrcomplete,
				fcheckcomplete=$checkcomplete,
				ftapescomplete=$tapescomplete,
				fnotes='$notes',
				FYEARPUB=$pubyear,
				fpriority=1";
					
$result=db_query($sql);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}

function edit_book($bookid,$title,$author1ln,$author1fn,$author1mi,$author2ln,$author2fn,$author2mi,
				$author3ln,$author3fn,$author3mi,$author4ln,$author4fn,$author4mi,
				$author5ln,$author5fn,$author5mi,$author6ln,$author6fn,$author6mi,
				$fmorethan6,$fisbn,$publisher,$placepub,$edition,$media,$translation,$transln,
				$transfn,$transmi,$corporate,$corporatename,$collection,
				$reprint,$repautholn,$repauthorfn,$repauthormi,$multivolume,
				$lastvolume,$lastvolyear,$series,$seriestitle,$rfbd_onhand,
				$rfbd_checked,$rfbd_hasit,$rfbdnumber,$rfbd_ordered,
				$rfbd_received,$bs_checked,$bs_promised,$bs_hasit,
				$bs_pickedup,$scancomplete,$ocrcomplete,$checkcomplete,
				$tapescomplete,$notes,$pubyear,$fmaintflag1) {
  global $feedback,$sql;

  
  //store a false value for the boolean fields
  if (!$pubyear){ $pubyear = 0;}
  if (!$lastvolume){ $lastvolume = 0;}
  if (!$lastvolyear){ $lastvolyear = 0;}
  if (!$rfbd_onhand){ $rfbd_onhand = 0;}
  if (!$rfbd_checked){ $rfbd_checked = 0;}
  if (!$rfbd_hasit){ $rfbd_hasit = 0;}
  if (!$bs_checked){ $bs_checked = 0;}
  if (!$scancomplete){ $scancomplete = 0;}
  if (!$ocrcomplete){ $ocrcomplete = 0;}
  if (!$checkcomplete){ $checkcomplete = 0;}
  if (!$tapescomplete){ $tapescomplete = 0;}
  if (!$media){ $media = 0;}

	$sql="UPDATE BOOKS SET	ftitle='$title',
		FAUTHOR1LN='$author1ln',
		FAUTHOR1FN='$author1fn',
		FAUTHOR1MI='$author1mi',
		FAUTHOR2LN='$author2ln',
		FAUTHOR2FN='$author2fn',
		FAUTHOR2MI='$author2mi',
		FAUTHOR3LN='$author3ln',
		FAUTHOR3FN='$author3fn',
		FAUTHOR3MI='$author3mi',
		FAUTHOR4LN='$author4ln',
		FAUTHOR4FN='$author4fn',
		FAUTHOR4MI='$author4mi',
		FAUTHOR5LN='$author5ln',
		FAUTHOR5FN='$author5fn',
		FAUTHOR5MI='$author5mi',
		FAUTHOR6LN='$author6ln',
		FAUTHOR6FN='$author6fn',
		FAUTHOR6MI='$author6mi',
		fmorethan6='$fmorethan6',
		FISBN='$fisbn',
		FPUBLISHER='$publisher',
		FPLACEPUB='$placepub',
		FEDITION='$edition',
		ffiletypes='$media',
		ftranslation='$translation',
		FTRANSLN='$transln',
		FTRANSFN='$transfn',
		FTRANSMI='$transmi',
		fcorporate='$corporate',
		FCORPORATENAME='$corporatename',
		fcollection='$collection',
		freprint='$reprint',
		FREPAUTHORLN='$repauthorln',
		FREPAUTHORFN='$repauthorfn',
		FREPAUTHORMI='$repauthormi',
		fmultivolume='$multivolume',
		FLASTVOLUME=$lastvolume,
		FLASTVOLYEAR=$lastvolyear,
		fseries='".(int)$series."',
		FSERIESTITLE='$seriestitle',
		frfbd_onhand=$rfbd_onhand,
		frfbd_checked=$rfbd_checked,
		frfbd_hasit=$rfbd_hasit,
		frfbdnumber='$rfbdnumber',
		frfbd_ordered='$rfbd_ordered',
		frfbd_received='$rfbd_received',
		fbs_checked=$bs_checked,
		fbs_promised='$bs_promised',
		fbs_hasit='".(int)$bs_hasit."',
		fbs_pickedup='$bs_pickedup',
		fscancomplete=$scancomplete,
		focrcomplete=$ocrcomplete,
		fcheckcomplete=$checkcomplete,
		ftapescomplete=$tapescomplete,
		fmaintflag1='$fmaintflag1',
		fnotes='$notes',
		FYEARPUB=$pubyear
		WHERE FTTEBOOKID=".$bookid;
	
	$result = db_query($sql);
	
	if ($result)
		return true;
	else
		die(db_error());
}

function find_students($bookkey,$semester) {
  global $feedback,$sql;
  $sql="SELECT R.primarykey ,S.primarykey as currentstudent,S.sid,S.firstname,S.lastname,S.telephone,S.email from BSRELATION R, STUDENTS S where R.bookkey = $bookkey and R.studentkey = S.primarykey order by S.lastname";

  $result=db_query($sql);

  if (!$result || db_numrows($result) < 1){
	$feedback='<br><h2>No students are currently requesting this book.</h2><br>
	           <a href="student.php">Browse Students </a>';
    return false;
  } else {
    return $result;
  }
}

function find_request_students($requestkey,$semester) {
  global $feedback,$sql;
  $sql="SELECT R.primarykey ,S.primarykey as currentstudent,S.sid,S.firstname,S.lastname,S.telephone,S.email from BSRELATION R, STUDENTS S where R.primarykey = $requestkey and R.studentkey = S.primarykey order by S.lastname";

  $result=db_query($sql);

  if (!$result || db_numrows($result) < 1){
	$feedback='<br><h2>No students are currently requesting this book.</h2><br>
	           <a href="student.php">Browse Students </a>';
    return false;
  } else {
    return $result;
  }
}

function add_book($studentkey,$bookkey,$reqsemester) {
  global $feedback,$sql;
  $sql="INSERT INTO BSRELATION(studentkey,bookkey,reqsemester) ".
       "VALUES ($studentkey,$bookkey,'$reqsemester')";
  $result=db_query($sql);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}

function select_bookset($title,$studentkey) {
  global $feedback;
  $sql="SELECT bookkey from BSRELATION where studentkey = $studentkey";
  $result=db_query($sql);
  if (db_numrows($result) > 0) {
    while ($row = db_fetch_array($result)) {
      $booklist .= $row["bookkey"] . ',';
	}
	$len=strlen($booklist);
	$len--;
	$booklist = substr($booklist,0,$len);
  } else {
    $booklist = -1;
  }

  $sql="SELECT *, FTTEBOOKID as bookkey from BOOKS where FTTEBOOKID " .
       "not in ($booklist) order by ftitle";
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h3>No book matching your search criteria.
	<a href=javascript:self.close();>Close window.</a></h3><br>';
	echo " Number of rows: " . db_numrows($result);
    echo "<br>SQL: $sql";
	return false;
  } else {
    return $result;
  }
}

function show_progress($bookkey) {
  global $feedback,$sql;
  $sql="SELECT P.primarykey, P.foreignkey as bookkey, " .
  "DATE_FORMAT(P.jobdate,'%Y-%m-%d %l:%i %p') as jobdate, P.startingpage, P.endingpage, " .
  "P.process, U.initials from PROGRESS P, USERS U where P.foreignkey= $bookkey " .
  "and P.sa = U.primarykey order by P.jobdate";
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1){
	$feedback=' <br><h2>No work has been done on this book.</h2><br>';
    return false;
  } else {
    return $result;
  }
}

function add_process($bookkey,$startingpage,$endingpage,$process,$sa) {
  global $feedback, $sql;
  $sql="INSERT INTO PROGRESS(foreignkey,startingpage,endingpage,process, ".
       "sa) VALUES ($bookkey,$startingpage,$endingpage,'$process',$sa)";
//  echo $sql;
  $result=db_query($sql);
  if (!$result) {
    $feedback = "Failed to insert process! SQL: $sql";
    return false;
  } else {
    return true;
  }
}

function student_edit($studentkey,$sid,$firstname,$lastname,$telephone,$email,$password,$notes) {
  global $feedback,$sql;
//  $password = md5($password);
  $sql="UPDATE STUDENTS set sid='$sid', firstname='$firstname', " .
  "lastname='$lastname', telephone='$telephone', email='$email', " .
  "password='$password', notes='$notes' where primarykey=$studentkey";

  $result=db_query($sql);
  if (!$result) {
	$feedback="<br><h2>Student update not successful. $sql</h2><br>";
    return false;
  } else {
    return true;
  }
}

function insert_bsrelation ($studentid, $bookid, $semester) {
	$sql = "INSERT INTO BSRELATION SET studentkey=".$studentid.",
			bookkey=".$bookid.",reqsemester='".$semester."'";
	$result=db_query($sql);
	if (!$result) {
		return false;
	} else {
		return true;
	}
}

function bs_delete($bskey) {
  $sql="delete from BSRELATION where primarykey = $bskey";
  $result=db_query($sql);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}

function delete_student($skey) {
  $sql="delete from BSRELATION where studentkey = $skey";
  $result1=db_query($sql);
  $sql="delete from BOOKREQUEST where studentid = $skey";
  $result2=db_query($sql);
  $sql="delete from STUDENTS where primarykey = $skey";
  $result3=db_query($sql);
  return true;
}

function delete_book($bkey) {
  /*
  // delete book content files
  $sql="delete from BOOKCONTENTS where FCONTENTID in(select FCONTENTID from BOOKCONTENTINFO where FTTEBOOKID=$bkey)";
  $result1=db_query($sql);
  echo 'Book contents deleted.<br/>';
  */
  
  // delete book content info files
  $sql="delete from BOOKCONTENTINFO where FTTEBOOKID=$bkey";
  $result2=db_query($sql);
  echo 'Book contents information deleted.<br/>';

  // delete progress files
  $sql="delete from PROGRESS where FOREIGNKEY=$bkey";
  $result3=db_query($sql);
  echo 'Book progress records deleted.<br/>';

  // delete bsrelation files
  $sql="delete from BSRELATION where BOOKKEY=$bkey";
  $result4=db_query($sql);
  echo 'Student request records deleted.<br/>';

  // delete book
  $sql="delete from BOOKS where FTTEBOOKID=$bkey";
  $result5=db_query($sql);
  echo 'Book deleted.<br/>';

  return true;
}



function select_priority($semester, $nextsemester) {
  global $feedback;
  $sql="select distinct B.fpriority, B.FTTEBOOKID, B.ftitle, B.flastupdated, "
   . "B.fscancomplete, B.focrcomplete, B.fcheckcomplete, B.fnotes, B.ffiletypes, S.primarykey, S.reqsemester, S.notes, D.firstname, D.lastname "
   . "from BOOKS B, BSRELATION S, STUDENTS D "
   . "where B.FTTEBOOKID = S.bookkey "
   . "and B.ffiletypes <>'RFB' "
   . "and ( S.reqsemester = '" . $semester . "' or S.reqsemester = '" . $nextsemester . "' ) and D.primarykey=S.studentkey and fcheckcomplete <> 1 order by B.fpriority,B.ftitle";
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h2>No books currently in the queue. </h2><br>';
    return false;
  } else {
    return $result;
  }
}

function select_bookstorelist($semester, $nextsemester) {
  global $feedback;
  $sql="select distinct B.fpriority, B.FTTEBOOKID, B.ftitle, B.flastupdated, "
   . "B.ffiletypes, S.primarykey, S.reqsemester, S.notes "
   . "from BOOKS B, BSRELATION S, STUDENTS D, BOOKREQUEST R "
   . "where B.FTTEBOOKID = S.bookkey "
   . "and R.studentid = S.studentkey "
   . "and ( B.fpriority = '0' or B.fpriority is NULL )  "
   . "and B.ffiletypes <> 'RFB' "
   . "and ( S.reqsemester = '" . $semester . "' or S.reqsemester = '" . $nextsemester . "' ) and fcheckcomplete <> 1 order by  S.notes,B.ftitle";
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h2>No books currently to be purchased. </h2><br>';
    return false;
  } else {
    return $result;
  }
}

function select_priority_incomplete($semester, $nextsemester) {
  global $feedback;
  $sql="select distinct B.fpriority, B.FTTEBOOKID, B.ftitle, B.flastupdated, "
   . "B.fscancomplete, B.focrcomplete, B.fcheckcomplete, B.fnotes, B.ffiletypes, S.primarykey, S.reqsemester, S.notes, D.firstname, D.lastname "
   . "from BOOKS B, BSRELATION S, STUDENTS D "
   . "where B.FTTEBOOKID = S.bookkey "
   . "and B.ffiletypes <> 'RFB' "
   . "and S.reqsemester <> '" . $semester . "' and S.reqsemester <> '" . $nextsemester . "' and D.primarykey=S.studentkey and fcheckcomplete <> 1 order by S.reqsemester DESC,B.fpriority,B.ftitle";
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h2>No books currently in the queue.</h2><br>';
    return false;
  } else {
    return $result;
  }
}

function select_rfbpriority($semester, $nextsemester) {
  global $feedback;
  $sql="select B.fpriority, B.FTTEBOOKID, B.ftitle, B.flastupdated, "
   . "B.frfbd_received, B.frfbd_ordered, B.fcheckcomplete, B.fnotes, B.ffiletypes, D.firstname, D.lastname, "
   . "S.primarykey, S.pickedup, S.returned, S.reqsemester, S.notes "
   . "from BOOKS B, BSRELATION S, STUDENTS D "
   . "where B.FTTEBOOKID = S.bookkey and ( S.returned is NULL or S.returned='0000-00-00') "
   . "and B.ffiletypes ='RFB' "
   . "and ( S.reqsemester = '" . $semester . "' or S.reqsemester = '" . $nextsemester . "' ) and D.primarykey=S.studentkey and fcheckcomplete <> 1 order by B.fpriority,D.lastname,B.ftitle";
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h2>No books currently in the queue. </h2><br>';
    return false;
  } else {
    return $result;
  }
}

function select_rfbpriority_incomplete($semester, $nextsemester) {
  global $feedback;
  $sql="select B.fpriority, B.FTTEBOOKID, B.ftitle, B.flastupdated, "
   . "B.frfbd_received, B.frfbd_ordered, B.fcheckcomplete, B.fnotes, B.ffiletypes, D.firstname, D.lastname, "
   . "S.primarykey, S.pickedup, S.returned, S.reqsemester, S.notes "
   . "from BOOKS B, BSRELATION S, STUDENTS D "
   . "where B.FTTEBOOKID = S.bookkey and ( S.returned is NULL or S.returned='0000-00-00') "
   . "and B.ffiletypes ='RFB' "
   . "and ( S.reqsemester <> '" . $semester . "' AND S.reqsemester <> '" . $nextsemester . "' ) and D.primarykey=S.studentkey and fcheckcomplete <> 1 order by S.reqsemester DESC,B.fpriority,D.lastname,B.ftitle";
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h2>No books currently in the queue. </h2><br>';
    return false;
  } else {
    return $result;
  }
}

function write_priority($key,$priority) {
  global $feedback,$sql;
  $sql="UPDATE BOOKS set fpriority = $priority ".
  "where FTTEBOOKID=$key";
  $result=db_query($sql);
  if (!$result) {
	$feedback="<br><h2>Priority update not successful. $sql</h2><br>";
    return false;
  } else {
    return true;
  }
}

function get_semester_code ($semester, $year) {
	if ($semester == "Spring") {
		return $year."A";
	} elseif ($semester == "Summer") {
		return $year."B";
	} else {
		return $year."C";
	}
}

function get_semester_name ($code) {
	$year = substr($code,0,2);
	$semester = substr($code,2,1);
	$name = "20".$year;
	if ($semester == "A") {
		return "Spring ".$name;
	} elseif ($semester == "B") {
		return "Summer ".$name;
	} else {
		return "Fall ".$name;
	}
}

function display_document_top () {
echo ' 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<!-- DW6 -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Scamper Home</title>
<link rel="stylesheet" href="include/emx_nav_left.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style3 {color: #000000}
-->
</style>
</head>
<div id="masthead"> 
  <h1 id="siteName">Scamper</h1> 
  <div id="utility" role="navigation" aria-label="Utility" style="color: blue;"> 
    <span class="style1"><a href="http://www.learningally.org" target="_blank" accesskey="L">Learning Ally</a></span> | 
	<span class="style1"><a href="http://www.bookshare.org" target="_blank" accesskey="B">Bookshare</a></span> |
	<span class="style1"><a href="http://www.accesstext.org" target="_blank" accesskey="A">AccessText</a></span> |
	<span class="style1"><a href="http://tamu.bncollege.com/webapp/wcs/stores/servlet/TBWizardView?catalogId=10001&langId=-1&storeId=17552" target="_blank" accesskey="M">MSC Textbook Lookup</a></span> |
	<span class="style1"><a href="https://compass-ssb.tamu.edu/pls/PROD/bwckschd.p_disp_dyn_sched" target="_blank" accesskey="F">Find Syllabi</a></span>
  </div> 
  <div id="globalNav" role="navigation" aria-label="Global"> 
    <img alt="" src="gblnav_left.gif" height="32" width="4" id="gnl"> <img alt="" src="glbnav_right.gif" height="32" width="4" id="gnr"> 
    <div id="globalLink"> 
      <a href="index.php" id="gl1" class="glink" accesskey="H">Home
	</a><a href="ebooks.php" id="gl2" class="glink" >
	Books</a><a href="student.php" id="gl4" class="glink" accesskey="S">
	Students</a><a href="request.php" id="gl5" class="glink" accesskey="R">
	Pending Requests </a><a href="priority.php" id="gl6" class="glink" accesskey="P">
	Priority List</a><a href="phorums/" id="gl9" class="glink" target="_blank">
	ShiftLog</a><span class="glink style3">
    </div> 
    <!--end globalLinks--> 
  </div> 
  <!-- end globalNav --> 
</div> 
<!-- end masthead --> 
<div id="pagecell1"> 
  <!--pagecell1--> 
  <div id="breadCrumb"> 
    <a href="#">Welcome to Scamper</a>
	
  </div> 
';
}

function display_document_center_top () {
echo ' 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<!-- DW6 -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Scamper Home</title>
<link rel="stylesheet" href="include/emx_nav_center.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style3 {color: #000000}
-->
</style>
</head>
<div id="masthead"> 
  <h1 id="siteName">Scamper</h1> 
  <div id="utility" role="navigation" aria-label="Utility" style="color: blue;"> 
    <span class="style1"><a href="http://www.learningally.org" target="_blank" accesskey="L">Learning Ally</a></span> | 
	<span class="style1"><a href="http://www.bookshare.org" target="_blank" accesskey="B">Bookshare</a></span> |
	<span class="style1"><a href="http://www.accesstext.org" target="_blank" accesskey="A">AccessText</a></span> |
	<span class="style1"><a href="http://tamu.bncollege.com/webapp/wcs/stores/servlet/TBWizardView?catalogId=10001&langId=-1&storeId=17552" target="_blank" accesskey="M">MSC Textbook Lookup</a></span> |
	<span class="style1"><a href="https://compass-ssb.tamu.edu/pls/PROD/bwckschd.p_disp_dyn_sched" target="_blank" accesskey="F">Find Syllabi</a></span>
  </div> 
  <div id="globalNav" role="navigation" aria-label="Global"> 
    <img alt="" src="gblnav_left.gif" height="32" width="4" id="gnl"> <img alt="" src="glbnav_right.gif" height="32" width="4" id="gnr"> 
    <div id="globalLink"> 
      <a href="index.php" id="gl1" class="glink" accesskey="H">Home
	</a><a href="ebooks.php" id="gl2" class="glink" >
	Books</a><a href="student.php" id="gl4" class="glink" accesskey="S">
	Students</a><a href="request.php" id="gl5" class="glink" accesskey="R">
	Pending Requests </a><a href="priority.php" id="gl6" class="glink" accesskey="P">
	Priority List</a><a href="phorums/" id="gl9" class="glink" target="_blank">
	ShiftLog</a><span class="glink style3">
    </div> 
    <!--end globalLinks--> 
  </div> 
  <!-- end globalNav --> 
</div> 
<!-- end masthead --> 
<div id="pagecell1"> 
  <!--pagecell1--> 
  <div id="breadCrumb"> 
    <a href="#">Welcome to Scamper</a> 
	
  </div> 
';
}

function display_document_bottom() {
echo '   
    
    </div> 
  </div> 
   <div id="siteInfo"> 
    <center><a href="http://disability.tamu.edu" target="_blank">Disability Services</a> | <a href="http://studentaffairs.tamu.edu" target="_blank">Division of Student Affairs
    </a> | <a href="http://www.tamu.edu" target="_blank">Texas A&amp;M University</a> | <a href="http://webaccess.tamu.edu/" target="_blank">Accessibility</a> | <a href="http://studentaffairs.tamu.edu/privacy" target="_blank">Security &amp; Privacy
      Policy</a>
	  <br>Copyright &copy; by Adaptive Technology Services, Disability Services at Texas A&M University, Phone: (979) 845-0390; Fax: (979) 458-1214
<br>Email: ats@disability.tamu.edu; 1224 TAMU; College Station, Texas 77843-1224 </center>

  </div> 
</div> 
<!--end pagecell1--> 
<br> 
</body>
</html>

';
}

?>
