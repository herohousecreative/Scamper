<?php

function insert_student($sid,$firstname,$lastname,$telephone,$email,$password,$notes) {
//  if ($password != "") {
//  	$password = md5('$password');
//  }
  $sql="INSERT INTO STUDENTS(sid,firstname,lastname,telephone,email,password,notes) ".
       "VALUES ('$sid','$firstname','$lastname','$telephone','$email','$password','$notes')";
  $result=db_query($sql);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}

function select_student($lastname,$studentkey) {
  global $feedback;
  if ($lastname=='xyz') {
    $sql="SELECT primarykey as studentkey, sid, firstname, lastname, " .
	     "telephone, email, password, notes from STUDENTS where primarykey = $studentkey";
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

function select_pendingrequests($studentkey,$semester) {
  global $feedback,$sql;
  $sql="SELECT requestid, title, filetypes, author1ln, author1fn FROM BOOKREQUEST
       where retired='N' and studentid = ".$studentkey." and reqsemester = '" . $semester ."' order by title";
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
	$feedback='Student has not requested any books this semester<br>';
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
			(FIND_IN_SET('RFB',ffiletypes)>0 OR FIND_IN_SET('VOL',ffiletypes)>0) order by ftitle";
	} elseif ($filetype == "ebook") {
		$sql="SELECT *,FTTEBOOKID as bookkey from BOOKS where ftitle like '%$title%' AND
			(ffiletypes!='RFB' AND ffiletypes!='VOL') order by ftitle";
	} else {
		$sql="SELECT *,FTTEBOOKID as bookkey from BOOKS where ftitle like '%$title%' order by ftitle";
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

function insert_book($title,$author1ln,$author1fn,$author1mi,
				$author2ln,$author2fn,$author2mi,
				$author3ln,$author3fn,$author3mi,
				$author4ln,$author4fn,$author4mi,
				$author5ln,$author5fn,$author5mi,
				$author6ln,$author6fn,$author6mi,
				$fmorethan6,$fisbn,$publisher,$placepub,
				$edition,$media,$translation,$transln,
				$transfn,$transmi,$corporate,$corporatename,
				$collection,$reprint,$repautholn,$repauthorfn,
				$repauthormi,$multivolume,$lastvolume,
				$lastvolyear,$series,$seriestitle,$rfbd_onhand,
				$rfbd_checked,$rfbd_hasit,$rfbdnumber,
				$rfbd_ordered,$rfbd_received,$bs_checked,
				$bs_promised,$bs_hasit,$bs_pickedup,
				$scancomplete,$ocrcomplete,$checkcomplete,
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
  if (!$bs_hasit){ $bs_hasit = 0;}
  if (!$scancomplete){ $scancomplete = 0;}
  if (!$ocrcomplete){ $ocrcomplete = 0;}
  if (!$checkcomplete){ $checkcomplete = 0;}
  if (!$tapescomplete){ $tapescomplete = 0;}

$sql="INSERT INTO BOOKS SET ftitle='$title',
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
				frfbd_hasit='$rfbd_hasit',
				frfbdnumber='$rfbdnumber',
				frfbd_ordered='$rfbd_ordered',
				frfbd_received='$rfbd_received',
				fbs_checked=$bs_checked,
				fbs_promised='$bs_promised',
				fbs_hasit=$bs_hasit,
				fbs_pickedup='$bs_pickedup',
				fscancomplete=$scancomplete,
				focrcomplete=$ocrcomplete,
				fcheckcomplete=$checkcomplete,
				ftapescomplete=$tapescomplete,
				fnotes='$notes',
				FYEARPUB=$pubyear,
				fpriority=50;
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
				FYEARPUB=$pubyear
				WHERE FTTEBOOKID=".$bookid;
 $result=db_query($sql);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}

function find_students($bookkey,$semester) {
  global $feedback,$sql;
  $sql="SELECT R.primarykey ,S.primarykey as currentstudent,S.sid,S.firstname,S.lastname,S.telephone,S.email from BSRELATION R, STUDENTS S where R.bookkey = $bookkey and R.reqsemester = '" . $semester ."' and R.studentkey = S.primarykey order by S.lastname";

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
  $sql="SELECT R.primarykey ,S.primarykey as currentstudent,S.sid,S.firstname,S.lastname,S.telephone,S.email from BSRELATION R, STUDENTS S where R.primarykey = $requestkey and R.reqsemester = '" . $semester ."' and R.studentkey = S.primarykey order by S.lastname";

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

function select_priority($semester) {
  global $feedback;
  $sql="select distinct B.fpriority, B.FTTEBOOKID, B.ftitle, B.flastupdated, "
   . "B.fscancomplete, B.focrcomplete, B.fcheckcomplete, B.fnotes, B.ffiletypes, S.primarykey "
   . "from BOOKS B, BSRELATION S "
   . "where B.FTTEBOOKID = S.bookkey "
   . "and B.ffiletypes <>'RFB' "
   . "and S.reqsemester = '" . $semester . "' and fcheckcomplete <> 1 order by B.fpriority,B.ftitle";
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h2>No books currently in the queue. <a href="afhome.php">Return to Main Menu.</a></h2><br>';
    return false;
  } else {
    return $result;
  }
}

function select_rfbpriority($semester) {
  global $feedback;
  $sql="select B.fpriority, B.FTTEBOOKID, B.ftitle, B.flastupdated, "
   . "B.frfbd_received, B.frfbd_ordered, B.fcheckcomplete, B.fnotes, B.ffiletypes, S.primarykey "
   . "from BOOKS B, BSRELATION S "
   . "where B.FTTEBOOKID = S.bookkey "
   . "and B.ffiletypes ='RFB' "
   . "and S.reqsemester = '" . $semester . "' and fcheckcomplete <> 1 order by B.fpriority,B.ftitle";
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h2>No books currently in the queue. <a href="afhome.php">Return to Main Menu.</a></h2><br>';
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
<div id="masthead" role="banner"> 
  <h1 id="siteName">Scamper </h1> 
  <div id="utility" role="navigation"> 
    <a href="https://getmybooks.tamu.edu" target="_blank">Getmybooks</a> | 
    <span class="style1"><a href="http://www.rfbd.org" target="_blank">RFBD</a></span> | 
    <span class="style1"><a href="https://webaccess.tamu.edu" target="_blank">Webaccess</a></span> |
    <a href="https://tte.tamu.edu" target="_blank"> TTE</a> 
  </div> 
  <div id="globalNav"> 
    <img alt="" src="gblnav_left.gif" height="32" width="4" id="gnl"> <img alt="" src="glbnav_right.gif" height="32" width="4" id="gnr"> 
    <div id="globalLink"> 
      <a href="index.php" id="gl1" class="glink" >Home
	</a><a href="ebooks.php" id="gl2" class="glink" >
	Books e-Text </a><a href="booksontape.php" id="gl3" class="glink" >
	Books on Tape</a><a href="student.php" id="gl4" class="glink" >
	Students</a><a href="request.php" id="gl5" class="glink" >
	Pending Requests </a><a href="priority.php" id="gl6" class="glink" >
	Priority</a><a href="rfbpriority.php" id="gl7" class="glink" >
	RFB&amp;D priority</a><a href="ttehome.php" id="gl8" class="glink" >
	TTE</a><a href="phorums/" id="gl9" class="glink" >
	ShiftLog</a><a href="howto.php" id="gl10" class="glink" >
	Procedures</a><span class="glink style3">
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
  <h1 id="siteName">Scamper </h1> 
  <div id="utility" aria-labelledby="Utility navigation"> 
    <a href="https://getmybooks.tamu.edu" target="_blank">Getmybooks</a> | 
    <span class="style1"><a href="http://www.rfbd.org" target="_blank">RFBD</a></span> | 
    <span class="style1"><a href="https://webaccess.tamu.edu" target="_blank">Webaccess</a></span>
  </div> 
  <div id="globalNav"> 
    <img alt="" src="gblnav_left.gif" height="32" width="4" id="gnl"> <img alt="" src="glbnav_right.gif" height="32" width="4" id="gnr"> 
    <div id="globalLink"> 
      <a href="index.php" id="gl1" class="glink" >Home
	</a><a href="ebooks.php" id="gl2" class="glink" >
	Books e-Text </a><a href="booksontape.php" id="gl3" class="glink" >
	Books on Tape</a><a href="student.php" id="gl4" class="glink" >
	Students</a><a href="request.php" id="gl5" class="glink" >
	Pending Requests </a><a href="priority.php" id="gl6" class="glink" >
	Priority</a><a href="rfbpriority.php" id="gl7" class="glink" >
	RFB&amp;D priority</a><a href="ttehome.php" id="gl8" class="glink" >
	TTE</a><a href="phorums/" id="gl9" class="glink" >
	ShiftLog</a><a href="howto.php" id="gl10" class="glink" >
	Procedures</a><span class="glink style3">
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
    <a href="http://disability.tamu.edu" target="_blank">Disability Services</a> | <a href="http://studentlife.tamu.edu" target="_blank">Department of Student Life</a> | <a href="http://studentaffairs.tamu.edu" target="_blank">Division of Student Affairs
    </a> | <a href="http://www.tamu.edu" target="_blank">Texas A&amp;M University</a> | <a href="http://webaccess.tamu.edu/" target="_blank">Accessibility</a> | <a href="http://studentlife.tamu.edu/privacypolicy.htm" target="_blank">Privacy
      Policy</a> | <a href="http://www.state.tx.us/" target="_blank">State of Texas</a> | <a href="http://www.tsl.state.tx.us/agency/customer/pia.html" target="_blank">State
      of Texas Public Information Act</a> | <a href="http://sago.tamu.edu/policy/61-01-02.htm" target="_blank">TAMU
      Open Records Policy</a> | &copy;1995-2005 by TAMU Disability Service at Texas A&M University, Phone: (979) 847-0390; Fax: (979) 458-1214
Email: info@tte.tamu.edu; Cain Hall, B-103; 1257 TAMU; College Station, Texas 77843-1257

  </div> 
</div> 
<!--end pagecell1--> 
<br> 
</body>
</html>

';
}

?>
