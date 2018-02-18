<?php
	include "include/database.php";
  	include "include/user.php";

	display_document_center_top();
	echo '
	  <div id="pageName"> 
	    <h2>Upload Book</h2> 
	  </div> 
	  <div id="content"> 
	    <div class="feature"> 
	';

  	if (is_uploaded_file ($_FILES['userfile']['tmp_name'])) { 
		$fp1 = fopen ($_FILES['userfile']['tmp_name'], 'r') or die ('cannot open uploaded file');
		$file1 = fread ($fp1, $_FILES['userfile']['size']) or die ('error reading in file contents');
		
		$fname = $_FILES['userfile']['name'];
		$fsize = $_FILES['userfile']['size'];
		
		if ($fsize < 1000) {
			$fsizeunit = "Bytes";	
		} else {
			$fsize = (int)($fsize/1000);
			if ($fsize < 1000) {
				$fsizeunit = "KB";
			} else {
				$fsize = (int)($fsize/1000);
				$fsizeunit = "MB";
			}
		}
		fclose ($fp1);

		mysql_connect();
    		$sql = "INSERT INTO BOOKCONTENTINFO SET fttebookid=".$id.", fcontentname='".$fname."', fcontentsize='".$fsize."', fsizeunit='".$fsizeunit."'";
    		$res = db_query($sql);

    		if ($res != 1) {
				$err = mysql_error();
				echo "error is ".$err."<br>";
	    		echo "result is ".$res;
     		} else {
				$cid = mysql_insert_id();
				setBookContents($cid, $file1);
    		}

	 	mysql_close();
	}
  
	echo "<h2>Upload Book Contents</h2>";
	echo "<FORM ENCTYPE=\"multipart/form-data\" ACTION=\"upload.php?id=$id\" METHOD= POST> 
	<INPUT TYPE=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"5000000000\"> Send this file: <INPUT NAME=\"userfile\" TYPE=\"file\"><INPUT TYPE=\"submit\" VALUE=\"Send File\"> </FORM>";

	echo sprintf("<hr><br /><h3>Last file uploaded: %s</h3><br />",$fname);
	echo "<h3><a href='bookcontents.php?bookkey=".$id."'>View book contents</a></h3>";	
	echo "<h3><a href='bookdetail.php?bookkey=".$id."'>View book details</a></h3>";	

	display_document_bottom();
?>



