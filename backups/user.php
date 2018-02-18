<?php

function insert_student($sid,$firstname,$lastname,$telephone,$email) {
	
  $sql="INSERT INTO students(sid,firstname,lastname,telephone,email) ".
       "VALUES ('$sid','$firstname','$lastname','$telephone','$email')";
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
	     "telephone, email from students where primarykey = $studentkey";
  }else {
    $sql="SELECT primarykey as studentkey, sid, firstname, lastname, telephone, " .
	     "email from students where lastname like '%$lastname%' order by lastname";
  }
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback="<br><h2>Student not found. <a href=\"newstudent.php\">Enter a new student.</a></h2><br>";
    return false;
  } else {
    return $result;
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

function select_book($bookkey,$title) {
  global $feedback;
  if ($bookkey == '') {
    $sql="SELECT *,primarykey as bookkey from books where title like '%$title%' order by title";
  } else {	
    $sql="SELECT *, primarykey as bookkey from books where primarykey = $bookkey";
  }
  $result=db_query($sql);
  if (!$result || db_numrows($result) < 1) {
    $feedback='<br><h2>Book not found. <a href="newbook.php">Enter a new book.</a></h2><br>';
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
					 "tapescomplete,notes,pubyear,priority)".
					 "VALUES(".
					 "'$title','$authors','$publisher','$edition','$media',$tte_checked,".
                     "$tte_hasit,$ats_checked,$ats_hasit,$rfbd_onhand,".
					 "$rfbd_checked,$rfbd_hasit,'$rfbdnumber','$rfbd_ordered',".
					 "'$rfbd_received',$bs_checked,'$bs_promised','$bs_hasit',".
					 "'$bs_pickedup',$scancomplete,$ocrcomplete,$checkcomplete,".
					 "$tapescomplete,'$notes','$pubyear',50);";
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
  $sql="INSERT INTO bsrelation(studentkey,bookkey,reqsemester) ".
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

function student_edit($studentkey,$sid,$firstname,$lastname,$telephone,$email) {
  global $feedback,$sql;
  $sql="UPDATE students set sid='$sid', firstname='$firstname', " .
  "lastname='$lastname', telephone='$telephone', email='$email' " .
  "where primarykey=$studentkey";

  $result=db_query($sql);
  if (!$result) {
	$feedback="<br><h2>Student update not successful. $sql</h2><br>";
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

function select_priority($semester) {
  global $feedback;
  $sql="select distinct B.priority, B.primarykey, B.title, B.lastupdated, "
   . "B.scancomplete, B.ocrcomplete, B.checkcomplete, B.notes "
   . "from books B, bsrelation S "
   . "where B.primarykey = S.bookkey "
   . "and S.reqsemester = '" . $semester . "' order by B.priority,B.title";
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
  $sql="UPDATE books set priority = $priority ".
  "where primarykey=$key";
  $result=db_query($sql);
  if (!$result) {
	$feedback="<br><h2>Priority update not successful. $sql</h2><br>";
    return false;
  } else {
    return true;
  }
}

?>
