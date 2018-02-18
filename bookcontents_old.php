<?php
  include('include/database.php');
  include('include/user.php');
  
  if ($content_id) {
	$sql = "select FCONTENT,FCONTENTNAME from BOOKCONTENTS as A left join BOOKCONTENTINFO as B 
		on A.FCONTENTID=B.FCONTENTID where A.FCONTENTID=".$content_id;
	$result = db_query($sql);
	$rowinfo = db_fetch_array($result);
	$contents = $rowinfo['FCONTENT'];
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

  	$sql = "SELECT ftitle FROM BOOKS WHERE FTTEBOOKID=".$bookkey;
  	$res = db_query($sql);
  	if ($row = db_fetch_array($res)) {
		echo "<h2>Downloads for <font color=\"red\">".$row['ftitle']."</font></h2><p>";
	}

  $sql = "SELECT FCONTENTID,FCONTENTNAME FROM BOOKCONTENTINFO WHERE FTTEBOOKID=".$bookkey;
  $res = db_query($sql);
  if (!$row = db_fetch_array($res))
	echo "There are no contents for this book yet.";
  else {
 	do {
		echo "<a href='bookcontents.php?content_id=".
			$row['FCONTENTID']."'>".$row['FCONTENTNAME']."</a><br>";
	} while ($row = db_fetch_array($res));
  }
  
  echo "<p>Click <a href=\"upload.php?id=" .$bookkey."\">here</a> to upload files.<br>";

  display_document_bottom();
  }

?>
