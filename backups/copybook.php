<?php
include "include/database.php";
include "include/user.php";

	$sql = "SELECT * from ats.books where primarykey=134";
	$result = db_query($sql);
	if ($row = mysql_fetch_array($result)) {
		$insert_sql = "INSERT INTO BOOKS SET FTTEBOOKID='', FYEARPUB='$row[pubyear]',
				FPUBLISHER='$row[publisher]', FEDITION='$row[edition]',
				ffiletypes='$row[media]', fverified=0, 
				fpriority = $row[priority],
				fpriorityupdated = '$row[priorityupdated]',
				flastupdated = '$row[lastupdated]',
				fscancomplete = $row[scancomplete],
				focrcomplete = $row[ocrcomplete],
				fcheckcomplete = $row[checkcomplete],
				ftapescomplete = $row[tapescomplete],
				fnotes = '$row[notes]',
				frfbdnumber = '$row[rfbdnumber]',
				frfbd_onhand = $row[rfbd_onhand],
				frfbd_checked = $row[rfbd_checked],
				frfbd_hasit = $row[rfbd_hasit],
				frfbd_ordered = '$row[rfbd_ordered]',
				frfbd_received = '$row[rfbd_received]',
				fpub_checked = $row[pub_checked],
				fpub_hasit = $row[pub_hasit],
				fpub_promised = '$row[pub_promised]',
				fpub_received = '$row[pub_received]',
				fbs_checked = $row[bs_checked],
				fbs_promised = '$row[bs_promised]',
				fbs_hasit = 0,
				fbs_pickedup = '$row[bs_pickedup]',
				FTTEID=76 ";
		$result = db_query($insert_sql);
	}
?>
