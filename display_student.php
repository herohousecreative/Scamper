<?php

include('include/database.php');
include('include/user.php');
include ('include/print.php');

display_document_top();
echo '
  <div id="pageName"> 
    <h2></h2> 
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

$args_ereg = "[0-9]{9}";
$args_check_semester_ereg = '^[0-9][0-9][a,b,c|A,C,B]';

trim ($studentsid);

$len_semester = strlen ($check_semester); // makes sure that the entry for the semester is the correct length

if (
	!(ereg ($args_check_semester_ereg, $check_semester)) ||
	!($len_semester == 3)
)
{
	if ($len_semester != 3)
	{
		echo '<p>The semester must be at least three characters long.  ';
		echo '<a href="find_student.php">go back to the homepage</a> to '.
		'try again.</p>';
		exit;
	}
	echo "<p>$check_semester is not a valid semester entry.  ";
	echo 'Please try again by '.
	'<a href="find_student.php">going back to the homepage</a></p>';
	exit;
}

$check_semester [2] = strtoupper ($check_semester [2]);

$studentsid = str_replace("-", "", $studentsid);

$sql = "SELECT * FROM STUDENTS WHERE sid = '$studentsid'";

$student_result = db_query($sql);
$student_num_results = mysql_num_rows($student_result);

if ($student_num_results == 0)
{
	echo '<p>Error, student not found.  '.
	'<a href="find_student.php">Please go back to the homepage</a> to '.
	'try again.  If you continue to have problems, please e-mail David '.
	'Sweeney at <a href="mailto:david@studentlife.tamu.edu">'.
	'david@studentlife.tamu.edu</a>.</p>';
}
else
{
	$student_row = mysql_fetch_array ($student_result);
	echo
	  "<p>Hello " . $student_row["firstname"] . " " .
	  $student_row["lastname"] .
	  " you have successfully logged in.</p>";
/*
	 look up students primary key
	in the database to find wich books belong to them.  After you have
	located the books, display all the books that the student has requested.

	This will include current books as well as past semester books.
*/
	$student_key = $student_row [primarykey];

	/*
	  look up the students information in the sb_result talbe.  This
	  information will be used to retrieve the current books the student
	  is using.
	*/

	$sql = "SELECT * FROM BSRELATION WHERE studentkey = $student_key";
	$sb_result = db_query($sql);
	$sb_num_results = mysql_num_rows($sb_result);
	if ($sb_num_results == 0)
	{
		echo "you have not submitted any book requests this semester.";
		break;
	}

	//echo "You have currently requested " .
	//$sb_num_results . " books this semester.<br/>";

	/* a displya of all students requested books for the current
	semester.  (this will display the books requested for the current
	semester.  The student will enter the current semester for selection
	the stat us of perticular books.
	*/

	for ($i=0; $i<$sb_num_results; $i++)
	{
		$sb_row = mysql_fetch_array ($sb_result);
		$book_key = $sb_row["bookkey"];

		if ( !($sb_row ["reqsemester"] == $check_semester) )
		{
			$count_nonsemester_books++;
			continue;
		}
		//$check_semester [reqsemester] [servsemester]

		$sql = "SELECT * FROM BOOKS WHERE FTTEBOOKID = $book_key";
		$book_result = db_query($sql);
		$book_num_results = mysql_num_rows($book_result);
		$book_row = mysql_fetch_array ($book_result);

		/*
		the following lines will split up books based apon there catagories.
		Basically, I am splitting book done on progess if they are a rfb book
		or a scanned book.  I think the fied should also include inhouse
		recordings as well.
		*/

		echo "<h3>" . $book_row ["ftitle"] . ' ';
		if ( strlen ($book_row ["FEDITION"] ) != 0)
			echo $book_row ["FEDITION"] . " edition";

		echo '</h3>';
		$book_media = $book_row [ffiletypes];

		//both  RFB and Scanned
		if (
		  (ereg ("TXT|HTML", $book_media)) &&
		  (ereg ("RFB", $book_media))
		)
		{
			txt_and_rfb ($book_row);
		}
		//display rfb books only
		elseif (ereg ("RFB", $book_media))
		{
			rfb_display ($book_row);
		}
		// displays the books that have been scanned.
		elseif (ereg ("TXT|HTML", $book_media))
		{
			scan_display ($book_row);
		}
	}

	if ( ($sb_num_results - $count_nonsemester_books) == 0)
	{
		echo '<p>You have not submited any books for this semester.  '.
		'please <a href="find_student.php">go back to the homepage</a> to '.
		'select a differant semester.</p>';
	}
}

function txt_and_rfb ($book_row)
{
	if (
		($book_row ["ftte_hasit"] == 1) ||
		($book_row ["fats_hasit"] == 1) ||
		($book_row ["frfbd_onhand"] == 1) ||
		($book_row ["fcheckcomplete"] == 1)
	)
	{
		echo '<p>' . $book_row ["ftitle"] . ' is ready for viewing online.  '.
		'please come by the office for disabilities to pick up your rfb book.</p>';
	}
	else
	{
		echo '<p>This book is currently not ready.  Please check back to '.
		'check on the status of the book.</p>';
	}
}

function rfb_display ($book_row)
{
	if ($book_row ["frfbd_onhand"] == 1)
	{
		echo '<p>your book is ready.  Please come by the office for disabilities to pick it up.</p>';
	}
	else
	{
		echo '<p>This book is currently not ready.  Please check back to '.
		'check on the status of the book.</p>';
	}

	echo 'rfb status ' .$book_row ["frfbd_onhand"] . '<br/>';
}

function scan_display ($book_row)
{
	if (
		($book_row ["tte_hasit"] == 1) ||
		($book_row ["ats_hasit"] == 1) ||
		($book_row ["fcheckcomplete"] == 1)
	)
	{
		echo '<p>' . $book_row ["ftitle"] . ' is ready for viewing online.<p>';
	}
	else
	{
		echo '<p>This book is currently not ready.  Please check back to '.
		'check on the status of the book.</p>';
	}
}
display_document_bottom();
?>
