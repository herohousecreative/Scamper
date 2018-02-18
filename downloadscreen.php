<?php
  if ($content_id) {
	mysql_connect();
	$sql = "SELECT FCONTENTNAME,FCONTENT FROM BOOKCONTENTS WHERE FCONTENTID=".$content_id;
	$result = mysql_db_query("tte", $sql);
	$rowinfo = mysql_fetch_array($result);
	$contents = $rowinfo['FCONTENT'];
	$filename = $rowinfo['FCONTENTNAME'];

	$content_type = 'application/octet-stream';	
	header("Content-type: $content_type");	
	header("Content-Disposition: attachment; filename='$filename'");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Pragma: Public");
	echo $contents;
	mysql_close();
	quit;
  }
?>

<head>
<title>Download Page</title>
</head>

<body>

<br>
<table bgcolor="#660000" width=100%>
  <tr><td>
    <font color="#FFFFFF">
      <h2>Downloads for:</h2>
    </font>
  </td></tr>
  <tr><td>
  <font color="#FFFFFF"><h3>
  <?php
  readfile("books/$dirnum/biblio.txt");
  ?>
  </h3></font>
  </td></tr>
</table>

<br>

<?php
$directory = "books/".$dirnum;
$handle=opendir($directory);
   // Not the fastest since I'm walking through this twice, but should be okay
   while ($file = readdir($handle)) {
     if (substr($file, -3) == "zip") {
        echo "Download everything in one file!  (Please note:  You must have a zip utility like <a href=http://www.winzip.com>Winzip</a> to extract the files)<br><br>";
        echo "<a href=\"https://tte.tamu.edu/secure/books/$dirnum/$file\">$file</a> (" . number_format((filesize("/books/$dirnum/$file")/1024)) . " KB) <br>";
        echo "<br> You can also download each file individually by selecting from the list below:<br><br>";
     }
   }

   rewinddir($handle);
     
   $row_column_switch = 0;
   echo "<table width=620 border=0><tr><td>\n";   
   
   while ($file = readdir($handle)) {
     if ($file != "." && $file != ".." && (substr($file, -3) != "zip"))
       // directory should be set up as a link from /home/htdocs/secure to /books
       echo "<a href=\"books/$dirnum/$file\">$file</a> (" . number_format((filesize("/books/$dirnum/$file")/1024)) . " KB) <br>\n";
     if (!$row_column_switch)
       {
         // Stay on same row
         echo "</td><td>\n";
         $row_column_switch = 1;
       }
     else
       {
         // New row
         echo "</td></tr>\n";
         echo "<tr><td>\n";
         $row_column_switch = 0;
       }
   }
   echo " </table>\n";
   closedir($handle); 

/*  mysql_connect();
  $sql = "SELECT FCONTENTID,FCONTENTNAME FROM BOOKCONTENTS WHERE FTTEBOOKID=5";
  $res = mysql_db_query("tte", $sql);
  if (!$row = mysql_fetch_array($res))
	echo "this is wrong";
  else {
 	do {
		echo "<a href='downloadscreen.php?content_id=".
			$row['FCONTENTID']."'>".$row['FCONTENTNAME']."</a><br>";
	} while ($row = mysql_fetch_array($res));
  }
  mysql_close();
*/  ?>



</body>
