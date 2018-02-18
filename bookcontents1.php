<?php
  include('include/database.php');
  include('include/user.php');
  
  if ($content_id) {
	$sql = "select FCONTENTNAME from BOOKCONTENTINFO as B where B.FCONTENTID=".$content_id;

	$result = db_query($sql);
	$rowinfo = db_fetch_array($result);
	$contents = getBookContents($content_id);
	$filename = $rowinfo['FCONTENTNAME'];
	
	$content_type = 'application/octet-stream';	
	header("Content-type: $content_type");	
	header("Content-Disposition: attachment; filename=$filename");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Pragma: Public");
	echo $contents;
	quit;
  } else {


  display_document_top();
  echo '
  	<div id="pageName"> 
	    <h2>Book Contents</h2> 
	</div> 
	<div id="pageNav"> 
	    <div id="sectionLinks"> 
      	<a href="upload.php?id='.$bookkey.'">Upload files to this Book</a> 
	    </div> 
	</div>
	<div id="content"> 
	    <div class="feature"> 
';


	if($delfile) {
      	// $delfilesql="delete from BOOKCONTENTS where fcontentid=".$delfile;
      	$delfilesql1="delete from BOOKCONTENTINFO where fcontentid=".$delfile;
      	$result1=db_query($delfilesql1);

      	deleteBookContents($delfile);

		// echo $delfilesql;
		// echo $delfilesql1;

		// $result=db_query($delfilesql);
		
		if($result1 == true) {
			echo "<p><center><h2><font color=\"red\">Delete the file successfully!</font></h2></center>";
		}
		else {
			echo "<p><center><h2><font color=\"red\">Delete the file failed!</font></h2></center>";
		} 
	}

  	$sql = "SELECT ftitle FROM BOOKS WHERE FTTEBOOKID=".$bookkey;
  	$res = db_query($sql);
  	if ($row = db_fetch_array($res)) {
		echo "<h2>Downloads for <font color=\"red\">".$row['ftitle']."</font></h2><p>";
	}



  $sql = "SELECT FCONTENTID,FCONTENTNAME FROM BOOKCONTENTINFO WHERE FTTEBOOKID='".$bookkey."'ORDER BY FCONTENTNAME";
  $res = db_query($sql);
  if (!$row = db_fetch_array($res))
	echo "There are no contents for this book yet.";
  else {

	echo '<table width="60%" cellpadding="1">
	 	<TR bgcolor="#666666">
  	 	<TD width=50%><strong><font color="#FFFFFF">File Name</font></strong></TD>
	 	<TD width=10%><strong><font color="#FFFFFF">Delete</font></strong></TD>
  	 	</TR> ';
  	$color_switch = 0;
 	do {
     		if ($color_switch) {
		      echo "<TR bgcolor=\"#cccccc\">";
		    }
	      else {
		 	  echo "<TR>";
		    }
		echo '
	    		<TD><a href="'.$PHP_SELF.'?content_id='.$row['FCONTENTID'].'">'.$row['FCONTENTNAME'].'</a></TD>
	    		<TD><a href="'.$PHP_SELF.'?bookkey='.$bookkey.'&delfile='.$row["FCONTENTID"].'">Delete</a></TD>
		</TR>';

		if ($color_switch)	{
		     $color_switch = 0;
		} else {
		     $color_switch = 1;
		}

	} while ($row = db_fetch_array($res));

	echo "</table>";

  }
  
  echo "<p>Click <a href=\"upload.php?id=" .$bookkey."\">here</a> to upload files.<br>";

  display_document_bottom();
  }

?>
