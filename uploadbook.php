<?php
  include('include/database.php');
  include('include/user.php');
	display_document_center_top();
	echo '
	  <div id="pageName"> 
	    <h2>Upload Book</h2> 
	  </div> 
	  <div id="content"> 
	    <div class="feature"> 
	';

  # upload
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
    $file1 = addslashes ($file1);
    //$file1 = addcslashes ($file1, "\0");
    
    $sql = "INSERT INTO BOOKCONTENTINFO VALUES".
		"('',".$id.",'".$fname."',".$fsize.",'".$fsizeunit."')";
    $res = db_query($sql);

    if ($res != 1) {
		$err = db_error();
		echo "error is ".$err."<br>";
	    echo "result is ".$res;
    } else {
		$cid = db_insert_id();
		setBookContents($cid, $file1);
    }

  } 

  echo "<FORM ENCTYPE=\"multipart/form-data\" ACTION=\"uploadbook.php?id=$id\" METHOD= POST> <INPUT TYPE=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"5000000000\"> Send this file: <INPUT NAME=\"userfile\" TYPE=\"file\"><INPUT TYPE=\"submit\" VALUE=\"Send File\"> </FORM>";

  //echo "<A HREF=\"cleanup.php\">Done!</a>";


  echo sprintf("<h2>Directory Contents: <u>%s</u></h2><hr><br>Last file uploaded: %s<br>",$GLOBALS["ftitle"],$userfile_name);
  //Read_Dir(sprintf("/books/%s/",$id));  

?>

<form action="cleanup.php" method="post">
<input type="submit" value="Done with upload session for this book.">
</form>

<?php
display_document_bottom();
?>
