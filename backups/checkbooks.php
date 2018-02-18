<?php
	include "include/database1.php";
	include "include/user1.php";

	$sql = "SELECT FTTEBOOKID,FPUBLISHER,ftitle from BOOKS WHERE FTTEBOOKID>700";
	$result = db_query($sql);
	$count = 1;
	while ($row = mysql_fetch_array($result)) {
		$sql1 = "SELECT primarykey from ats.books WHERE ((title='$row[ftitle]')
			AND (publisher='$row[FPUBLISHER]'))";
		$result1 = db_query($sql1);
		$num = db_numrows($result1);
		if ($num == 2) {
			/*$row1 = mysql_fetch_array($result1);
			$sql2 = "UPDATE PROGRESS SET foreignkey=$row[FTTEBOOKID] 
				WHERE foreignkey=$row1[primarykey]";
			$result2 = db_query($sql2);
			$error = db_error($result2);
			echo $row[FTTEBOOKID]." - ".$row1[primarykey]." - ".$error." <br>";
			*/
			echo $row[FTTEBOOKID]."<br>";
		}
	}
	
?>
