<?php
include "include/database.php";
include "include/user.php";

display_document_top();
echo '
  <div id="pageName"> 
    <h2>Book Detailed Information</h2> 
  </div> 
  <div id="pageNav"> 
    <div id="sectionLinks"> 
	<a href="student.php">Browse Students</a> 
';


if ($_POST[submit_changes]) {
	process_update();
} elseif ($action=='addprocess') {
  $sql="SELECT primarykey as userkey from USERS where username = '" .$REMOTE_USER . "'";
  $result=db_query($sql);
  $sa=db_result($result,0,"userkey");
  "Bookkey is ".$bookkey;
  $result=add_process($bookkey,$startingpage,$endingpage,$process,$sa);
  if (!$result) {
    		echo '
			<a href="bookdetail.php?bookkey='.$_POST[FTTEBOOKID].'">View book details</a>
	  	   </div> 
	 	  </div>
		  <div id="content"> 
		  <div class="feature"> 
			<h2>Progress Update Results</h2>
			<h3>There was an error in update</h3>
		';
  } else {
    		echo '
			<a href="bookcontents.php?bookkey='.$_POST[bookkey].'">View book contents</a>
		    </div> 
		  </div>
	  <div id="content"> 
	  <div class="feature"> 
		<h2>Progress Update Results</h2>
		<h3>Progress information has been updated successfully</h3>
		';

  }
} elseif ($deleteprocess) {
  $sql="delete from PROGRESS where primarykey = $deleteprocess";
  $result=db_query($sql) or die($sql);
  $deleteprocess == null;
    	echo '
		<a href="bookdetail.php?bookkey='.$_POST[bookkey].'">View book details</a>
	    </div> 
	  </div>
	  <div id="content"> 
	  <div class="feature"> 
		<h2>Progress Update Results</h2>
		<h3>Progress information has been deleted successfully</h3>
		';

} else {
    	echo '
		<a href="bookcontents.php?bookkey='.$bookkey.'">View book contents</a>
	    </div> 
	  </div>
	  <div id="content"> 
	  <div class="feature"> 
		<h2>Edit Book Information</h2>
		';

//----------------------------------------------------
// begin book details

$result=select_book($bookkey,'','')
 or die($feedback);
$row = db_fetch_array($result);
$file_formats = explode(',',$row['ffiletypes']);

echo '
<form action="bookdetail.php" method="post">
  <table width=100% border="0">
    <tr> 
      <td bgcolor="#666666" colspan="2" font color="#000000">
        <h2><font color="#FFFFFF">General Information</font></h2>
        </td>
    </tr>
    <tr> 
  </table>
       
	<input type="hidden" name="ffiletypes">
	<input type="hidden" name="FTTEBOOKID" value='.$bookkey.'>

	<table width=100%>
	<tr>
	<td CLASS="column1">Title of book as it appears:<font color="#FF0000">*</font></td>
	<td><input type="text" name="ftitle" size="50" value="'.$row["ftitle"].'"></td>
	</tr>

	<tr>
	<td>Publisher:<font color="#FF0000">*</font></td>
	<td><input type="text" name="fpublisher" size="50" value="'.$row["FPUBLISHER"].'"></td>
	</tr>

	<tr>
	<td>City of Publication:<font color="#FF0000">*</font></td>
	<td><input type="text" name="fplacepub" size="50" value="'.$row["FPLACEPUB"].'"></td>
	</tr>

	<tr>
	<td>Year of Publication:<font color="#FF0000">*</font></td>
	<td><input type="text" name="fyearpub" size="4" value="'.$row["FYEARPUB"].'"></td>
	</tr>

	<tr>
	<td>ISBN (with dashes):<font color="#FF0000">*</font></td>
	<td><input type="text" name="fisbn" size="13" value="'.$row["FISBN"].'"></td>
	</tr>

	<tr>
	<td>File Type:<font color="#FF0000">*</font></td>
	<td>
  <input type="checkbox" name="TXT" value="ON" '; if (in_array("TXT",$file_formats)) echo "checked"; echo '>TXT
  <input type="checkbox" name="HTML" value="ON" '; if (in_array("HTML",$file_formats)) echo "checked"; echo '>HTML
  <input type="checkbox" name="XML" value="ON" '; if (in_array("XML",$file_formats)) echo "checked"; echo '>XML
  <input type="checkbox" name="SGML" value="ON" '; if (in_array("SGML",$file_formats)) echo "checked"; echo '>SGML
  <input type="checkbox" name="PDF" value="ON" '; if (in_array("PDF",$file_formats)) echo "checked"; echo '>PDF
  <input type="checkbox" name="RTF" value="ON" '; if (in_array("RTF",$file_formats)) echo "checked"; echo '>RTF
  <input type="checkbox" name="TEX" value="ON" '; if (in_array("TEX",$file_formats)) echo "checked"; echo '>TEX
  <input type="checkbox" name="DOC" value="ON" '; if (in_array("DOC",$file_formats)) echo "checked"; echo '>DOC
  <input type="checkbox" name="WPD" value="ON" '; if (in_array("WPD",$file_formats)) echo "checked"; echo '>WPD
  <input type="checkbox" name="BRF" value="ON" '; if (in_array("BRF",$file_formats)) echo "checked"; echo '>BRF
  <input type="checkbox" name="DXB" value="ON" '; if (in_array("DXB",$file_formats)) echo "checked"; echo '>DXB
  <input type="checkbox" name="DXP" value="ON" '; if (in_array("DXP",$file_formats)) echo "checked"; echo '>DXP
  <input type="checkbox" name="RFB" value="ON" '; if (in_array("RFB",$file_formats)) echo "checked"; echo '>RFB
  <input type="checkbox" name="VOL" value="ON" '; if (in_array("VOL",$file_formats)) echo "checked"; echo '>VOL
  <input type="checkbox" name="MP3" value="ON" '; if (in_array("MP3",$file_formats)) echo "checked"; echo '>MP3
	</td>
   	<tr>
	</table>

<br>
<table bgcolor="#666666" width=100%>
  <tr><td>
    <h2><font color="#FFFFFF">
      Author(s) Information</font></h2>
  </td></tr>
</table>
<br>

<P><EM><strong>Either the Corporate Author or Author #1 must be filled out</strong></EM></P>

<table width=100%>
<tr>
  <td>Corporate Author?</td><td> <input type="radio" name="fcorporate" value="Y" '; if ($row["fcorporate"]=="Y") echo "checked"; echo '> Yes
      <input type="radio" name="fcorporate" value="N" '; if ($row["fcorporate"]=="N") echo "checked"; echo '> No</td>
</tr>

<tr>
  <td WIDTH=200>Corporate Authors Name:<font color="#FF0000">*</font></td>
  <td><input type="text" name="fcorporatename" size="35" value="'.$row["FCORPORATENAME"].'"></td>
</tr>
</table>

<br>

<table width=100%>
<tr>
  <td> </td>
  <td><strong>Last Name</strong></td>
  <td><strong>First Name</strong></td>
  <td><strong>M.I.</strong></td>
  </tr>
<tr>
  <td WIDTH=200>Author #1 Name:<font color="#FF0000">*</font></td>
  <td><input type="text" name="fauthor1ln" size="30" value="'.$row["FAUTHOR1LN"].'"></td>
  <td><input type="text" name="fauthor1fn" size="25" value="'.$row["FAUTHOR1FN"].'"></td>
  <td><input type="text" name="fauthor1mi" size="1" value="'.$row["FAUTHOR1MI"].'"></td>
</tr>

<tr>
  <td class="column1">Author #2 Name:</td>
  <td><input type="text" name="fauthor2ln" size="30" value="'.$row["FAUTHOR2LN"].'"></td>
  <td><input type="text" name="fauthor2fn" size="25" value="'.$row["FAUTHOR2FN"].'"></td>
  <td><input type="text" name="fauthor2mi" size="1" value="'.$row["FAUTHOR2MI"].'"></td>
</tr>

<tr>
  <td>Author #3 Name:</td>
  <td><input type="text" name="fauthor3ln" size="30" value="'.$row["FAUTHOR3LN"].'"></td>
  <td><input type="text" name="fauthor3fn" size="25" value="'.$row["FAUTHOR3FN"].'"></td>
  <td><input type="text" name="fauthor3mi" size="1" value="'.$row["FAUTHOR3MI"].'"></td>
</tr>

<tr>
  <td>Author #4 Name:</td>
  <td><input type="text" name="fauthor4ln" size="30" value="'.$row["FAUTHOR4LN"].'"></td>
  <td><input type="text" name="fauthor4fn" size="25" value="'.$row["FAUTHOR4FN"].'"></td>
  <td><input type="text" name="fauthor4mi" size="1" value="'.$row["FAUTHOR4MI"].'"></td>
</tr>


<tr>
  <td>Author #5 Name:</td>
  <td><input type="text" name="fauthor5ln" size="30" value="'.$row["FAUTHOR5LN"].'"></td>
  <td><input type="text" name="fauthor5fn" size="25" value="'.$row["FAUTHOR5FN"].'"></td>
  <td><input type="text" name="fauthor5mi" size="1" value="'.$row["FAUTHOR5MI"].'"></td>
</tr>

<tr>
  <td>Author #6 Name:</td>
  <td><input type="text" name="fauthor6ln" size="30" value="'.$row["FAUTHOR6LN"].'"></td>
  <td><input type="text" name="fauthor6fn" size="25" value="'.$row["FAUTHOR6FN"].'"></td>
  <td><input type="text" name="fauthor6mi" size="1" value="'.$row["FAUTHOR6MI"].'"></td>
</tr>

<tr>
  <td>More than 6 authors?</td>
  <td><input type="radio" name = "fmorethan6" value="Y" '; if ($row["fmorethan6"]=="Y") echo "checked"; echo ' > Yes 
	<input type="radio" name ="fmorethan6" value="N" '; if ($row["fmorethan6"]=="N") echo "checked"; echo'> No</td>
</tr>
</table>

<br>

<table bgcolor="#666666" width=100%>
  <tr><td>
    <h2><font color="#FFFFFF">
      Additional Information</font></h2>
  </td></tr>
</table>


<br>

<table>
<tr>
  <td>Edition (if any): <input type="text" name="fedition" size="4" value="'.$row["FEDITION"].'"></td>
</tr>

<tr>
  <td>Collection? <input type="radio" name="fcollection" value="Y" '; if ($row["fcollection"]=="Y") echo "checked"; echo '> Yes
      <input type="radio" name="fcollection" value="N" '; if ($row["fmorethan6"]=="N") echo "checked"; echo '> No</td>
</tr>


<tr>
  <td>Multivolume Set? <input type="radio" name="fmultivolume" value="Y" '; if ($row["fmultivolume"]=="Y") echo "checked"; echo '> Yes
      <input type="radio" name="fmultivolume" value="N" '; if ($row["fmultivolume"]=="N") echo "checked"; echo '> No</td>
</tr>

<tr>
  <td>If multivolume, last volume # & publ. year:</td>
</tr>

<tr>
  <td>Last Volume:<input type="text" name="flastvolume" size="1" value="'.$row["FLASTVOLUME"].'"> 
	Year:<input type="text" name="flastvolyear" size="4" value="'.$row["FLASTVOLYEAR"].'"> </td>
</tr>

<tr>
  <td>Series? <input type="radio" name="fseries" value="Y" '; if ($row["fseries"]=="Y") echo "checked"; echo '> Yes
      <input type="radio" name="fseries" value="N" '; if ($row["fseries"]=="N") echo "checked"; echo '> No</td>
</tr>

<tr>
  <td>If Series, Series Title:</td>
</tr>

<tr>
  <td><input type="text" name="fseriestitle" size="35" value="'.$row["FSERIESTITLE"].'"></td>
</tr>

<tr>
  <td>Translation? <input type="radio" name="ftranslation" value="Y" '; if ($row["ftranslation"]=="Y") echo "checked"; echo '> Yes
      <input type="radio" name="ftranslation" value="N" '; if ($row["ftranslation"]=="N") echo "checked"; echo '> No</td>
</tr>

<tr>
  <td>If translation, translator\'s last, first, MI:</td>
</tr>

<tr>
  <td><input type="text" name="ftransln" size="35" value="'.$row["FTRANSLN"].'">,</td>
  <td><input type="text" name="ftransfn" size="35" value="'.$row["FTRANSFN"].'"> </td>
  <td><input type="text" name="ftransmi" size="1" value="'.$row["FTRANSMI"].'">.</td>
</tr>

<tr>
  <td>Reprint? <input type="radio" name="freprint" value="Y" '; if ($row["freprint"]=="Y") echo "checked"; echo '> Yes
      <input type="radio" name="freprint" value="N" '; if ($row["freprint"]=="N") echo "checked"; echo '> No</td>
</tr>

<tr>
  <td>If reprint, reprint author\'s last, first, MI:</td>
</tr>

<tr>
  <td><input type="text" name="frepauthorln" size="35" value="'.$row["FREPAUTHORLN"].'">,</td>
  <td><input type="text" name="frepauthorfn" size="35" value="'.$row["FREPAUTHORFN"].'"> </td>
  <td><input type="text" name="frepauthormi" size="1" value="'.$row["FREPAUTHORMI"].'">.</td>
</tr>
</table>

<br>
  <table width=100% border="0">
    <tr> 
      <td bgcolor="#666666" colspan="2" font color="#000000">
        <h2><font color="#FFFFFF">Research Information</font></h2>
        </td>
    </tr>
    <tr> 
  </table>
  <br>
  <table width=100% border="0">
	<tr>
	<td>RFB&amp;D Phone: 800.635.1403 Agency #AG77843001</td>
	</tr>
	<tr>
	<td><a href="http://www.rfbd.org/catalog.htm#catform" target="_blank"> http://www.rfbd.org/catalog.htm#catform</a></td>
	</tr>
	<tr>
	<td>RFB&amp;D Checked? <a href="http://www.rfbd.org/catalog.htm#catform" target="_blank"> 
          <input type="checkbox" name="rfbd_checked" value="1" '; if ($row["frfbd_checked"]) echo "checked"; echo '>
          </a></td>
	</tr>
	<tr>
	<td>RFB&amp;D Has It? <a href="http://www.rfbd.org/catalog.htm#catform" target="_blank"> 
          <input type="checkbox" name="rfbd_hasit" value="1" '; if ($row["frfbd_hasit"]) echo "checked"; echo '>
          </a></td>
	</tr>
	<tr>
	<td>On-hand from RFBD? 
          <input type="checkbox" name="rfbd_onhand" value="1" '; if ($row["frfbd_onhand"]) echo "checked"; echo '></td>
	</tr>
  </table>

<br>
  <table width=100% border="0">
    <tr> 
      <td bgcolor="#666666" colspan="2" font color="#000000">
        <h2><font color="#FFFFFF">RFBD Information</font></h2>
        </td>
    </tr>
    <tr> 
  </table>
  <br>

<table width=100% border="0">
    <tr> 
        <td>RFB&amp;D Number 
          <input type="text" name="rfbdnumber" value="'.$row["frfbdnumber"].'"></td>
    </tr>
    <tr>
          <td>Ordered (YYYY-MM-DD) 
          <input type="text" name="rfbd_ordered" value="'.$row["frfbd_ordered"].'"></td>
    </tr>
    <tr>
          <td>Received (YYYY-MM-DD) 
          <input type="text" name="rfbd_received" value="'.$row["frfbd_received"].'"></td>		  
    </tr>
</table>

<br>
  <table width=100% border="0">
    <tr> 
      <td bgcolor="#666666" colspan="2" font color="#000000">
        <h2><font color="#FFFFFF">Bookstore Information</font></h2>
        </td>
    </tr>
    <tr> 
  </table>
<br>

  <table width=100% border="0">
    <tr> 
      <td>Bookstore Checked? 
          <input type="checkbox" name="bs_checked" value="1" '; if ($row["fbs_checked"]) echo "checked"; echo '></td>
    </tr>
    <tr>
          <td>Promised Date (YYYY-MM-DD) 
          <input type="text" name="bs_promised" value="'.$row["fbs_promised"].'"></td>
    </tr>
    <tr>
          <td>Bookstore Has It? 
          <input type="checkbox" name="bs_hasit" value="1" '; if ($row["fbs_hasit"]) echo "checked"; echo '></td>
    </tr>
    <tr>
          <td>Picked Up (YYYY-MM-DD) 
          <input type="text" name="bs_pickedup" value="'.$row["fbs_pickedup"].'"></td>
    </tr>
  </table>

<br>
  <table width=100% border="0">
    <tr> 
      <td bgcolor="#666666" colspan="2" font color="#000000">
        <h2><font color="#FFFFFF">Processing Information</font></h2>
        </td>
    </tr>
    <tr> 
  </table>
<br>
  <table width=100% border="0">
    <tr> 
      <td>Scanning Complete 
          <input type="checkbox" name="scancomplete" value="1" '; if ($row["fscancomplete"]) echo "checked"; echo '></td>
      <td>OCR Complete
      <input type="checkbox" name="ocrcomplete" value="1" '; if ($row["focrcomplete"]) echo "checked"; echo '></td>
      <td>Corrections Complete
      <input type="checkbox" name="checkcomplete" value="1" '; if ($row["fcheckcomplete"]) echo "checked"; echo '></td>
      <td>Tapes Complete 
      <input type="checkbox" name="tapescomplete" value="1" '; if ($row["ftapescomplete"]) echo "checked"; echo '></td>
    </tr>
  </table>
<br>
  <table width=100% border="0">
    <tr> 
      <td bgcolor="#666666" colspan="2" font color="#000000">
        <h2><font color="#FFFFFF">Notes</font></h2>
        </td>
    </tr>
    <tr> 
  </table>
<br>
  <table width=100% border="0">
    <tr> 
      <td>
        <p> 
          <textarea name="notes" rows="10" cols="80">'.$row["fnotes"].'</textarea>
        </p>
      </td>
    </tr>
    <tr> 
      <td width=100%> 
        <input type="submit" name="submit_changes" value="Update Book">
      </td>
    </tr>
  </table>

  </form>
';

//-------------------------------------------------------
// begin book processing details
echo "<hr><h2>Processing Details</h2>\n";
echo "<FORM ACTION=\"". $PHP_SELF ."\" METHOD=\"POST\">\n";
echo '
<input type="hidden" name="bookkey" value='.$bookkey.'>
<p>Starting Page 
  <input type="text" name="startingpage" width="25" size="10">
  Ending Page 
  <input type="text" name="endingpage" size="10">
</p>

<table width=100% border="0">
  <tr>
    <td>Scanned 
      <input type="radio" name="process" value="scanned" checked>
    </td>
    <td>OCR\'ed 
      <input type="radio" name="process" value="ocred">
    </td>
    <td>Checked 
      <input type="radio" name="process" value="checked">
    </td>
    <td>Recorded 
      <input type="radio" name="process" value="recorded">
    </td>
    <td>
      <input type="submit" name="Submit" value="Add Process">
    </td>
  </tr>
</table>
<br>
<input type="hidden" name="action" value="addprocess">

</form>
';

$result = show_progress($bookkey);
$num_results = db_numrows($result);
echo "<h3>Total processing records: ",$num_results,"</h3>\n";
echo "<table border=\"0\" width=100%>\n";
echo "<TR  bgcolor=\"#666666\">\n";
echo "<TD width=35%><strong><font color=\"#FFFFFF\">Job Date</strong></font></TD>\n";
echo "<TD width=10%><strong><font color=\"#FFFFFF\">Starting Page</strong></font></TD>\n";
echo "<TD width=10%><strong><font color=\"#FFFFFF\">Ending Page</strong></font></TD>\n";
echo "<TD width=15%><strong><font color=\"#FFFFFF\">Process</strong></font></TD>\n";
echo "<TD width=10%><strong><font color=\"#FFFFFF\">SA</strong></font></TD>\n";
echo "<TD width=20%><strong><font color=\"#FFFFFF\">Delete Process</strong></font></TD>\n";
echo "</TR>";

// Set up variable to switch colors for me
$color_switch = 0;
for ($i=0; $i <$num_results; $i++) {
  $row = mysql_fetch_array($result);

  if ($color_switch) {
    echo "<TR bgcolor=\"#cccccc\">";
  } else {
    echo "<TR>";
  } 

  echo "<TD>",$row["jobdate"],"</TD>";
  echo "<TD>",$row["startingpage"],"</TD>";
  echo "<TD>",$row["endingpage"],"</TD>";
  echo "<TD>",$row["process"],"</TD>";
  echo "<TD>",$row["initials"],"</TD>\n";
  echo "<TD><a href=\"",$PHP_SELF,"?bookkey=" . $bookkey . "&deleteprocess=",$row["primarykey"],"\">Delete</a></TD>\n";  
  echo "</TR>\n";

  //rotate the color for the table
  if ($color_switch) {
    $color_switch = 0;
  } else {
    $color_switch = 1;
  }
}
echo "</table>";
echo "<br><hr>";

//-------------------------------------------------------
// begin students who have this book
//$result=find_students($bookkey,$semester)
if($requestkey) {
$result=find_request_students($requestkey, $semester)
 or die($feedback);
}
else {
$result=find_students($bookkey,$semester)
 or die($feedback);
}
echo"<h2>Current Student Requests<br>\n";
echo "<h3>Total requests: ",db_numrows($result),"</h3>\n";
echo "<table border=\"0\" width=100%>\n";
echo "<TR  bgcolor=\"#666666\">\n";
echo "<TD width=20%><strong><font color=\"#FFFFFF\">Student ID</strong></font></TD>\n";
echo "<TD width=30%><strong><font color=\"#FFFFFF\">Name</strong></font></TD>\n";
echo "<TD width=20%><strong><font color=\"#FFFFFF\">Telephone</strong></font></TD>\n";
echo "<TD width=30%<strong><font color=\"#FFFFFF\">Email</strong></font></TD>\n";
echo "</TR>\n";

// Set up variable to switch colors for me
$color_switch = 0;

do {
  if ($color_switch)
  {
    echo "<TR bgcolor=\"#cccccc\">\n";
  }
  else
  {
    echo "<TR>\n";
  } //endif
 echo "<TD>",$row["sid"],"</TD>\n";
  echo "<TD><a href=\"studentdetail.php?studentkey=",$row["currentstudent"],"\">",$row["firstname"]," ",$row["lastname"],"</a></TD>\n";
  echo "<TD>",$row["telephone"],"</TD>\n";
  echo "<TD><a href=mailto:",$row["email"],">",$row["email"],"</A></TD>\n";
  echo "</TR>\n";
  //rotate the color for the table
  if ($color_switch)
  {
    $color_switch = 0;
  } else {
    $color_switch = 1;
  }
} while ($row = db_fetch_array($result));

echo "</table>\n";
}
display_document_bottom();

function process_update() {
	$format_array = array("TXT","HTML","XML","SGML","PDF","RTF","TEX","DOC","WPD","BRF","DXB","DXP","RFB","VOL","MP3");

	$media ="";
	foreach ($format_array as $file_type) {
		if ($_POST[$file_type]=="ON") {
			$media = $media.$file_type.",";
		}
	}

	$media = substr($media,0,strlen($media)-1);

	$result=edit_book($_POST[FTTEBOOKID],$_POST[ftitle],$_POST[fauthor1ln],$_POST[fauthor1fn],$_POST[fauthor1mi],
				$_POST[fauthor2ln],$_POST[fauthor2fn],$_POST[fauthor2mi],$_POST[fauthor3ln],$_POST[fauthor3fn],
				$_POST[fauthor3mi],$_POST[fauthor4ln],$_POST[fauthor4fn],$_POST[fauthor4mi],$_POST[fauthor5ln],
				$_POST[fauthor5fn],$_POST[fauthor5mi],$_POST[fauthor6ln],$_POST[fauthor6fn],$_POST[fauthor6mi],
				$_POST[fmorethan6],$_POST[fisbn],$_POST[fpublisher],$_POST[fplacepub],$_POST[fedition],$media,
				$_POST[ftranslation],$_POST[ftransln],$_POST[ftransfn],$_POST[ftransmi],$_POST[fcorporate],
				$_POST[fcorporatename],$_POST[fcollection],$_POST[freprint],$_POST[frepauthorln],$_POST[frepauthorfn],
				$_POST[frepauthormi],$_POST[fmultivolume],$_POST[flastvolume],$_POST[flastvolyear],$_POST[$fseries],
				$_POST[fseriestitle],$_POST[rfbd_onhand],$_POST[rfbd_checked],$_POST[rfbd_hasit],$_POST[rfbdnumber],
				$_POST[rfbd_ordered],$_POST[rfbd_received],$_POST[bs_checked],$_POST[bs_promised],$_POST[bs_hasit],
				$_POST[bs_pickedup],$_POST[scancomplete],$_POST[ocrcomplete],$_POST[checkcomplete],
				$_POST[tapescomplete],$_POST[notes],$_POST[fyearpub]);
	if (!$result) {
  		echo '<h2>Book Information Update Results</h2>';
		echo 'There was an error in your post.';
	} else {
  		echo '<h2>Book Information Update Results</h2>';
  		echo '<h3>Book information has been updated successfully</h3>';
		echo '<h3><a href="bookdetail.php?bookkey='.$_POST[FTTEBOOKID].'">View book details</a></h3>';
	}
}

?>
