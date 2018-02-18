<?php
include "include/database.php";
include "include/user.php";

display_document_top();
echo '
  <div id="pageName"> 
    <h2>Add Book</h2> 
  </div> 

';
?>

<?php>
$format_array = array("TXT","HTML","XML","PDF","RTF","TEX","DOC","DXB","DTB","RFB","MP3");

$media ="";
foreach ($format_array as $file_type) {
	if ($_POST[$file_type]=="ON") {
		$media = $media.$file_type.",";
	}
}

$media = substr($media,0,strlen($media)-1);

$result=insert_book(addslashes($_POST[ftitle]),addslashes($_POST[fauthor1ln]),addslashes($_POST[fauthor1fn]),addslashes($_POST[fauthor1mi]),
				addslashes($_POST[fauthor2ln]),addslashes($_POST[fauthor2fn]),addslashes($_POST[fauthor2mi]),addslashes($_POST[fauthor3ln]),addslashes($_POST[fauthor3fn]),
				addslashes($_POST[fauthor3mi]),addslashes($_POST[fauthor4ln]),addslashes($_POST[fauthor4fn]),addslashes($_POST[fauthor4mi]),addslashes($_POST[fauthor5ln]),
				addslashes($_POST[fauthor5fn]),addslashes($_POST[fauthor5mi]),addslashes($_POST[fauthor6ln]),addslashes($_POST[fauthor6fn]),addslashes($_POST[fauthor6mi]),
				addslashes($_POST[fmorethan6]),addslashes($_POST[fisbn]),addslashes($_POST[fpublisher]),addslashes($_POST[fplacepub]),addslashes($_POST[fedition]),
				$media,$_POST[ftranslation],$_POST[ftransln],addslashes($_POST[ftransfn]),addslashes($_POST[ftransmi]),addslashes($_POST[fcorporate]),
				addslashes($_POST[fcorporatename]),addslashes($_POST[fcollection]),$_POST[freprint],addslashes($_POST[frepauthorln]),addslashes($_POST[frepauthorfn]),
				addslashes($_POST[frepauthormi]),$_POST[fmultivolume],$_POST[flastvolume],$_POST[flastvolyear],addslashes($_POST[fseries]),
				addslashes($_POST[fseriestitle]),$_POST[rfbd_onhand],$_POST[rfbd_checked],$_POST[rfbd_hasit],addslashes($_POST[rfbdnumber]),
				addslashes($_POST[rfbd_ordered]),addslashes($_POST[rfbd_received]),addslashes($_POST[bs_checked]),
				addslashes($_POST[bs_promised]),intval($_POST[bs_hasit]),addslashes($_POST[bs_pickedup]),$_POST[scancomplete],$_POST[ocrcomplete],$_POST[checkcomplete],
				$_POST[tapescomplete],addslashes($_POST[notes]),$_POST[fyearpub]);
//var_dump($sql);
//var_dump($feedback);
//var_dump($result);
//var_dump ($media);
if (!$result) {
  echo '
      <div id="content"> 
	    <div class="feature"> 
		<h1>There was an error in your post!</h1>
	';
	//echo mysql_error();
} else {
  echo '
	  <div id="pageNav"> 
    		<div id="sectionLinks"> 
	      <a href="newbook.php">Add another book</a> 
		<a href="index.php">Return to Scamper Home</a>
	    </div> 
	  </div>
	  <div id="content"> 
	    <div class="feature"> 
  	<h3>Book posted successfully.</h3> 
  <a href="newbook.php">Add another book</a><br>
  <a href="index.php">Return to homepage</a><br>';
}

display_document_bottom();
?>

