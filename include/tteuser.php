<?php

function insert_member($FMEMFNAME,$FMEMLNAME,$FORGNAME,$FORGADDRESS1,$FORGADDRESS2,$FORGCITY,$FORGSTATE,$FORGZIP,$FORGCOUNTRY,$FORGPHONE,$FMEMLOGONNAME,$FMEMPASSWORD,$FEMAIL,$FAPPMAILED,$FAPPSUBMIT,$FAPPAPPROVED,$FAPPDECREASON,$FREGDATE,$FOFFICE,$FFAX,$FTAPEDATA) {
  $sql="INSERT INTO MEMBERS(FMEMFNAME,FMEMLNAME,FORGNAME,FORGADDRESS1,FORGADDRESS2,FORGCITY,FORGSTATE,FORGZIP,FORGCOUNTRY,FORGPHONE,FMEMLOGONNAME,FMEMPASSWORD,FEMAIL,FAPPMAILED,FAPPSUBMIT,FAPPAPPROVED,FAPPDECREASON,FREGDATE,FOFFICE,FFAX,FTAPEDATA) ".
       "VALUES ('$FMEMFNAME','$FMEMLNAME','$FORGNAME','$FORGADDRESS1','$FORGADDRESS2','$FORGCITY','$FORGSTATE','$FORGZIP','$FORGCOUNTRY','$FORGPHONE','$FMEMLOGONNAME','$FMEMPASSWORD','$FEMAIL','$FAPPMAILED','$FAPPSUBMIT','$FAPPAPPROVED','$FAPPDECREASON','$FREGDATE','$FOFFICE','$FFAX','$FTAPEDATA')";
  $result=db_query($sql);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}

function select_member($lastname,$memberkey) {
  global $feedback;
  
  if ($lastname=='xyz') {
    $sql="SELECT FTTEID as memberkey,FORGNAME,FORGADDRESS1,FORGADDRESS2,FORGCITY,FORGSTATE,FORGZIP,".
		 "FORGCOUNTRY,FORGPHONE,FMEMFNAME,FMEMLNAME,FMEMLOGONNAME,FMEMPASSWORD,FEMAIL,FAPPMAILED,".
		 "FAPPSUBMIT,FAPPAPPROVED,FAPPDECREASON,FREGDATE,FOFFICE," .
	     "FFAX,ftapedata from MEMBERS where FTTEID = $memberkey";
  }else {
      $sql="SELECT FTTEID as memberkey,FORGNAME,FORGADDRESS1,FORGADDRESS2,FORGCITY,FORGSTATE,FORGZIP,".
		 "FORGCOUNTRY,FORGPHONE,FMEMFNAME,FMEMLNAME,FMEMLOGONNAME,FMEMPASSWORD,FEMAIL,FAPPMAILED,".
		 "FAPPSUBMIT,FAPPAPPROVED,FAPPDECREASON,FREGDATE,FOFFICE,".
	     "FFAX,ftapedata from MEMBERS where FMEMLNAME like '%$lastname%' or FORGNAME like '%$lastname%' order by fappapproved DESC,FORGNAME";
		}
  $result=db_query($sql);
  
//  function select_member($lastname,$memberkey) {
//  global $feedback;
  
//if ($lastname=='xyz') {
//  $sql="SELECT FTTEID as memberkey,FORGNAME,FORGADDRESS1,FORGADDRESS2,FORGCITY,FORGSTATE,FORGZIP,".
//		 "FORGCOUNTRY,FORGPHONE,FMEMFNAME,FMEMLNAME,FMEMLOGONNAME,FMEMPASSWORD,FEMAIL,FAPPMAILED,".
//		 "FAPPSUBMIT,FAPPAPPROVED,FAPPDECREASON,FREGDATE,FOFFICE," .
//	     "FFAX,ftapedata from MEMBERS where FTTEID = $memberkey";
//  }else {
//      $sql="SELECT FTTEID as memberkey,FORGNAME,FORGADDRESS1,FORGADDRESS2,FORGCITY,FORGSTATE,FORGZIP,".
//		 "FORGCOUNTRY,FORGPHONE,FMEMFNAME,FMEMLNAME,FMEMLOGONNAME,FMEMPASSWORD,FEMAIL,FAPPMAILED,".
//		 "FAPPSUBMIT,FAPPAPPROVED,FAPPDECREASON,FREGDATE,FOFFICE,".
//	     "FFAX,ftapedata from MEMBERS order by FMEMLNAME";
//		}
// $result=db_query($sql);
  
   if (!$result || db_numrows($result) < 1) {
     $feedback="<br><h2>Member not found. <a href=\"newstudent.php\">Enter a new Member.</a></h2><br>";
    return false;
  } else {
  	   return $result;
  }
}

function member_edit($memberkey,$FMEMFNAME,$FMEMLNAME,$FORGNAME,$FORGADDRESS1,$FORGADDRESS2,$FORGCITY,$FORGSTATE,$FORGZIP,$FORGCOUNTRY,$FORGPHONE,$FMEMLOGONNAME,$FMEMPASSWORD,$FEMAIL,$FAPPMAILED,$FAPPSUBMIT,$FAPPAPPROVED,$FAPPDECREASON,$FREGDATE,$FOFFICE,$FFAX,$FTAPEDATA) {
  global $feedback,$sql;
  $sql="UPDATE MEMBERS set FMEMFNAME='$FMEMFNAME', FMEMLNAME='$FMEMLNAME', " .
  "FORGNAME='$FORGNAME', FORGADDRESS1='$FORGADDRESS1', FORGADDRESS2='$FORGADDRESS2' " .
  ",FORGCITY='$FORGCITY', FORGSTATE='$FORGSTATE', FORGZIP='$FORGZIP', FORGCOUNTRY='$FORGCOUNTRY' " .
  ",FORGPHONE='$FORGPHONE', FMEMLOGONNAME='$FMEMLOGONNAME', FMEMPASSWORD='$FMEMPASSWORD', FEMAIL='$FEMAIL' " .
  ",FAPPMAILED='$FAPPMAILED', FAPPSUBMIT='$FAPPSUBMIT', FAPPAPPROVED='$FAPPAPPROVED', FAPPDECREASON='$FAPPDECREASON' " .
  ",FREGDATE='$FREGDATE', FOFFICE='$FOFFICE', FFAX='$FFAX', FTAPEDATA='$FTAPEDATA' " .
  "where FTTEID=$memberkey";
  global $feedback,$sql;
  $result=db_query($sql);
  if (!$result) {
	$feedback="<br><h2>Member update not successful. $sql</h2><br>";
    return false;
  } else {
    return true;
  }
}

function select_organization($memberkey) {
  global $feedback;
  
    $sql="SELECT FTTEID as memberkey,FORGNAME,FOFFICE,FORGADDRESS1,FORGADDRESS2,FORGCITY,FORGSTATE,FORGZIP,".
		 "FORGCOUNTRY,FORGPHONE from MEMBERS where FTTEID = $memberkey";

	  $result=db_query($sql);
  
   if (!$result || db_numrows($result) < 1) {
     $feedback="<br><h2>Member not found. <a href=\"ttenewmember.php\">Enter a new MeMber.</a></h2><br>";
    return false;
  } else {
  	   return $result;
  }
}

function organization_edit($memberkey,$FORGNAME,$FOFFICE,$FORGADDRESS1,$FORGADDRESS2,$FORGCITY,$FORGSTATE,$FORGZIP,$FORGCOUNTRY,$FORGPHONE)
{
  global $feedback,$sql;
  $sql="UPDATE MEMBERS set FORGNAME='$FORGNAME', FOFFICE='$FOFFICE', FORGADDRESS1='$FORGADDRESS1', " .
  "FORGADDRESS2='$FORGADDRESS2', FORGCITY='$FORGCITY', FORGSTATE='$FORGSTATE', FORGZIP='$FORGZIP' " .
  ",FORGCOUNTRY='$FORGCOUNTRY', FORGPHONE='$FORGPHONE'".
  " where FTTEID=$memberkey";
  $result=db_query($sql);
  if (!$result) {
	$feedback="<br><h2>Organization update not successful. $sql</h2><br>";
    return false;
  } else {
    return true;
  }
}

function select_requests($studentkey,$semester) {
  global $feedback,$sql;
  $sql="SELECT R.primarykey as bskey, B.primarykey as bookkey, B.title, B.authors, B.media " .
       "from bsrelation R, books B " .
       "where R.studentkey = $studentkey " .
       "and R.reqsemester = '" . $semester .
       "' and R.bookkey = B.primarykey order by B.title";

  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1){
	$feedback='<br><h2>Student has not requested any books this semester.</h2><br>';
    return false;
  } else {
    return $result;
  }
}

function select_ttebook($bookkey,$title) {
  global $feedback;
  if ($bookkey == '') {
    $sql="SELECT *,FTTEBOOKID as bookkey from BOOKS where ftitle like '%$title%' order by ftitle";
  } else {	
    $sql="SELECT *, FTTEBOOKID as bookkey from BOOKS where FTTEBOOKID = $bookkey";
  }
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h2>Book not found. <a href="newbook.php">Enter a new book.</a></h2><br>';
    return false;
  } else {
    return $result;
  }
}

function select_ttebookreview($bookkey,$title) {
  global $feedback;
  if ($bookkey == '') {
    $sql="SELECT *,ftteid,FTTEBOOKID as bookkey from BOOKS where (fmaintflag1='N' AND ffiletypes!='RFB') order by ftitle";
  } else {	
    $sql="SELECT *, FTTEBOOKID as bookkey from BOOKS where FTTEBOOKID = $bookkey";
  }
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h2>No TTE Books to Review at this time.</h2><br>';
    return false;
  } else {
    return $result;
  }
}

function select_ttebookreview2($bookkey,$title) {
  global $feedback;
  if ($bookkey == '') {
    $sql="SELECT *,ftteid,FTTEBOOKID as bookkey from BOOKS where (fcheckcomplete=0 AND ffiletypes!='RFB' AND fmaintflag1='N') order by ftitle";
  } else {	
    $sql="SELECT *, FTTEBOOKID as bookkey from BOOKS where FTTEBOOKID = $bookkey";
  }
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h2>No TTE Books to Review at this time.</h2><br>';
    return false;
  } else {
    return $result;
  }
}

function select_ttebookreview3($bookkey,$title) {
  global $feedback;
  if ($bookkey == '') {
    $sql="SELECT *, ftteid, FTTEBOOKID as bookkey from BOOKS where (fcheckcomplete=0 AND ffiletypes!='RFB' and ftteid!=76) order by ftitle";
  } else {	
    $sql="SELECT *, FTTEBOOKID as bookkey from BOOKS where FTTEBOOKID = $bookkey";
  }
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h2>No TTE Books to Review at this time.</h2><br>';
    return false;
  } else {
    return $result;
  }
}

function insert_book($title,$authors,$publisher,$edition,$media,$tte_checked,
                     $tte_hasit,$ats_checked,$ats_hasit,$rfbd_onhand,
					 $rfbd_checked,$rfbd_hasit,$rfbdnumber,$rfbd_ordered,
					 $rfbd_received,$bs_checked,$bs_promised,$bs_hasit,
					 $bs_pickedup,$scancomplete,$ocrcomplete,$checkcomplete,
					 $tapescomplete,$notes,$pubyear) {
  global $feedback,$sql;

  //store a false value for the boolean fields
  if (!$tte_checked){ $tte_checked = 0;}
  if (!$tte_hasit){ $tte_hasit = 0;}
  if (!$ats_checked){ $ats_checked = 0;}
  if (!$ats_hasit){ $ats_hasit = 0;}
  if (!$rfbd_onhand){ $rfbd_onhand = 0;}
  if (!$rfbd_checked){ $rfbd_checked = 0;}
  if (!$rfbd_hasit){ $rfbd_hasit = 0;}
  if (!$bs_checked){ $bs_checked = 0;}
  if (!$scancomplete){ $scancomplete = 0;}
  if (!$ocrcomplete){ $ocrcomplete = 0;}
  if (!$checkcomplete){ $checkcomplete = 0;}
  if (!$tapescomplete){ $tapescomplete = 0;}

  $sql="INSERT INTO books(title,authors,publisher,edition,media,tte_checked,".
                     "tte_hasit,ats_checked,ats_hasit,rfbd_onhand,".
					 "rfbd_checked,rfbd_hasit,rfbdnumber,rfbd_ordered,".
					 "rfbd_received,bs_checked,bs_promised,bs_hasit,".
					 "bs_pickedup,scancomplete,ocrcomplete,checkcomplete,".
					 "tapescomplete,notes,pubyear)".
					 "VALUES(".
					 "'$title','$authors','$publisher','$edition','$media',$tte_checked,".
                     "$tte_hasit,$ats_checked,$ats_hasit,$rfbd_onhand,".
					 "$rfbd_checked,$rfbd_hasit,'$rfbdnumber','$rfbd_ordered',".
					 "'$rfbd_received',$bs_checked,'$bs_promised','$bs_hasit',".
					 "'$bs_pickedup',$scancomplete,$ocrcomplete,$checkcomplete,".
					 "$tapescomplete,'$notes','$pubyear');";
  $result=db_query($sql);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}

function find_students($bookkey,$semester) {
  global $feedback,$sql;
  $sql="SELECT R.primarykey ,S.primarykey as currentstudent,S.sid,S.firstname,S.lastname,S.telephone,S.email from bsrelation R, students S where R.bookkey = $bookkey and R.reqsemester = '" . $semester ."' and R.studentkey = S.primarykey order by S.lastname";

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
  $sql="INSERT INTO bsrelation(studentkey,bookkey,priority,reqsemester) ".
       "VALUES ($studentkey,$bookkey,50,'$reqsemester')";
  $result=db_query($sql);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}

function select_bookset($title,$studentkey) {
  global $feedback;
  $sql="SELECT bookkey from bsrelation where studentkey = $studentkey";
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

  $sql="SELECT *, primarykey as bookkey from books where primarykey " .
       "not in ($booklist) order by title";
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
  "P.process, U.initials from progress P, users U where P.foreignkey= $bookkey " .
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
  $sql="INSERT INTO progress(foreignkey,startingpage,endingpage,process, ".
       "sa) VALUES ($bookkey,$startingpage,$endingpage,'$process',$sa)";
  $result=db_query($sql);
  if (!$result) {
    $feedback = "Failed to insert process! SQL: $sql";
    return false;
  } else {
    return true;
  }
}



function bs_delete($bskey) {
  $sql="delete from bsrelation where primarykey = $bskey";
  $result=db_query($sql);
  if (!$result) {
    return false;
  } else {
    return true;
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
  <h1 id="siteName">Scamper </h1> 
  <div id="utility"> 
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
	RFBD Books</a><a href="student.php" id="gl4" class="glink" >
	Students</a><a href="request.php" id="gl5" class="glink" >
	Pending Requests </a><a href="priority.php" id="gl6" class="glink" >
	Scanning Priority</a><a href="rfbpriority.php" id="gl7" class="glink" >
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
  <div id="utility"> 
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
	RFBD Books</a><a href="student.php" id="gl4" class="glink" >
	Students</a><a href="request.php" id="gl5" class="glink" >
	Pending Requests </a><a href="priority.php" id="gl6" class="glink" >
	Scanning Priority</a><a href="rfbpriority.php" id="gl7" class="glink" >
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
    <a href="http://disability.tamu.edu" target="_blank">Disability Services</a> | <a href="http://studentaffairs.tamu.edu" target="_blank">Division of Student Affairs
    </a> | <a href="http://www.tamu.edu" target="_blank">Texas A&amp;M University</a> | <a href="http://webaccess.tamu.edu/" target="_blank">Accessibility</a> | <a href="http://studentlife.tamu.edu/privacypolicy.htm" target="_blank">Privacy
      Policy</a> | <a href="http://www.state.tx.us/" target="_blank">State of Texas</a> | <a href="http://www.tsl.state.tx.us/agency/customer/pia.html" target="_blank">State
      of Texas Public Information Act</a> | <a href="http://sago.tamu.edu/policy/61-01-02.htm" target="_blank">TAMU
      Open Records Policy</a> | &copy;1995-2006 TAMU Disability Service at Texas A&M University, Phone: (979) 845-0390; Fax: (979) 458-1214
Email: disability@tamu.edu; Cain Hall, B-103; 1224 TAMU; College Station, Texas 77843-1224
  </div> 
</div> 
<!--end pagecell1--> 
<br> 
</body>
</html>

';
}

?>

