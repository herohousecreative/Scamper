<?php
include "include/database.php";
include "include/user.php";

display_document_top();
echo '
  <div id="pageName"> 
    <h2>New Book</h2> 
  </div> 
  <div id="pageNav"> 
    <div id="sectionLinks"> 
      <a href="ebooks.php">E-Text Books</a> 
	  <a href="booksontape.php">Books on CD</a> 
	  <a href="student.php">Students Link</a> 
	  <a href="request.php">Pending Requests</a> 
	  <a href="priority.php">Scanning Priority</a> 
	  <a href="rfbpriority.php">Learning Ally priority</a> 
	  <a href="ttehome.php">TTE</a> 
	  <a href="phorums/">ShiftLog</a> 
	  <a href="howto.php">Procedures</a> 
    </div> 
  </div>
  <div id="content"> 
    <div class="feature"> 
';
?>

<form action="bookpost.php" method="post">
  <table width="650" border="0">
    <tr> 
      <td bgcolor="#666666" colspan="2" font color="#000000">
        <h2><font color="#FFFFFF"> New Book Processing</font></h2>
        </td>
    </tr>
    <tr> 
      <td bgcolor="#cccccc" colspan=2 align="top" valign="top"> 
        <h3>General Information</h3>
	
		<input type="hidden" name="ffiletypes">

<table width="100%">
<tr>
  <td CLASS="column1">Title of book as it appears:<font color="#FF0000">*</font></td>
  <td><input type="text" name="ftitle" size="50"></td>
</tr>

<tr>
  <td>Publisher:<font color="#FF0000">*</font></td>
  <td><input type="text" name="fpublisher" size="50"></td>
</tr>

<tr>
  <td>City of Publication:<font color="#FF0000">*</font></td>
  <td><input type="text" name="fplacepub" size="50"></td>
</tr>

<tr>
  <td>Year of Publication:<font color="#FF0000">*</font></td>
  <td><input type="text" name="fyearpub" size="4"></td>
</tr>

<tr>
  <td>ISBN (with dashes):<font color="#FF0000">*</font></td>
  <td><input type="text" name="fisbn" size="13"></td>
</tr>

<tr>
  <td>File Type:<font color="#FF0000">*</font></td>
  <td>
  <input type="checkbox" name="TXT" value="ON" checked>TXT
  <input type="checkbox" name="HTML" value="ON">HTML
  <input type="checkbox" name="PDF" value="ON">PDF
  <input type="checkbox" name="RTF" value="ON" checked>RTF
  <input type="checkbox" name="DOC" value="ON">DOC
  <input type="checkbox" name="DTB" value="ON">DTB
  <input type="checkbox" name="DXB" value="ON">DXB
  <input type="checkbox" name="RFB" value="ON">RFB
  <input type="checkbox" name="MP3" value="ON">MP3
  <input type="checkbox" name="TEX" value="ON">TEX
  <input type="checkbox" name="VOL" value="ON">VOL
  <input type="checkbox" name="XML" value="ON">XML
   <tr>
   <td></td>
  </tr>
</table>

<br>
<table bgcolor="#666666" width="100%" font color="#000000">
  <tr><td>
    <font color="#FFFFFF">
      <h2><font color="#FFFFFF">Author(s) Information</font></h2>
    </font>
  </td></tr>
</table>
<br>

<P><EM><strong>Either the Corporate Author or Author #1 must be filled out</strong></EM></P>

<table width="100%">
<!--<tr>
  <td>Corporate Author?</td><td> <input type="radio" name="fcorporate" value="Y" '; if ($row["fcorporate"]=="Y") echo "checked"; echo '> Yes
      <input type="radio" name="fcorporate" value="N" '; if ($row["fcorporate"]=="N") echo "checked"; echo '> No</td>
</tr>-->

<tr>
  <td>Corporate Author?</td><td> <input type="radio" name="fcorporate" value="Y"> Yes
      <input type="radio" name="fcorporate" value="N" checked> No</td>
</tr>

<tr>
  <td WIDTH=200>Corporate Author's Name:</td>
  <td><input type="text" name="fcorporatename" size="35"></td>
</tr>
</table>

<br>

<table width="100%">
<tr>
  <td> </td>
  <td><strong>Last Name</strong></td>
  <td><strong>First Name</strong></td>
  <td><strong>M.I.</strong></td>
  </tr>
<tr>
  <td WIDTH=200>Author #1 Name:<font color="#FF0000">*</font></td>
  <td><input type="text" name="fauthor1ln" size="30"></td>
  <td><input type="text" name="fauthor1fn" size="25"></td>
  <td><input type="text" name="fauthor1mi" size="1"></td>
</tr>

<tr>
  <td class="column1">Author #2 Name:</td>
  <td><input type="text" name="fauthor2ln" size="30"></td>
  <td><input type="text" name="fauthor2fn" size="25"></td>
  <td><input type="text" name="fauthor2mi" size="1"></td>
</tr>

<tr>
  <td>Author #3 Name:</td>
  <td><input type="text" name="fauthor3ln" size="30"></td>
  <td><input type="text" name="fauthor3fn" size="25"></td>
  <td><input type="text" name="fauthor3mi" size="1"></td>
</tr>

<tr>
  <td>Author #4 Name:</td>
  <td><input type="text" name="fauthor4ln" size="30"></td>
  <td><input type="text" name="fauthor4fn" size="25"></td>
  <td><input type="text" name="fauthor4mi" size="1"></td>
</tr>


<tr>
  <td>Author #5 Name:</td>
  <td><input type="text" name="fauthor5ln" size="30"></td>
  <td><input type="text" name="fauthor5fn" size="25"></td>
  <td><input type="text" name="fauthor5mi" size="1"></td>
</tr>

<tr>
  <td>Author #6 Name:</td>
  <td><input type="text" name="fauthor6ln" size="30"></td>
  <td><input type="text" name="fauthor6fn" size="25"></td>
  <td><input type="text" name="fauthor6mi" size="1"></td>
</tr>

<tr>
  <td>More than 6 authors?</td>
  <td><input type="radio" name = "fmorethan6" value="Y"> Yes <input type="radio" name ="fmorethan6" value="N" checked> No</td>
</tr>
</table>

<br>
<table bgcolor="#666666" width="100%" font color="#000000">
  <tr><td>
    <font color="#FFFFFF">
      <h2><font color="#FFFFFF">Additional Information</font></h2>
    </font>
  </td></tr>
</table>
<br>

<table>
<tr>
  <td>Edition (if any): <input type="text" name="fedition" size="4"></td>
</tr>

<tr>
  <td>Collection? <input type="radio" name="fcollection" value="Y"> Yes
      <input type="radio" name="fcollection" value="N" checked> No</td>
</tr>


<tr>
  <td>Multivolume Set? <input type="radio" name="fmultivolume" value="Y"> Yes
      <input type="radio" name="fmultivolume" value="N" checked> No</td>
</tr>

<tr>
  <td>If multivolume, last volume # & publ. year:</td>
</tr>

<tr>
  <td>Last Volume:<input type="text" name="flastvolume" size="1"> Year:<input type="text" name="flastvolyear" size="4"> </td>
</tr>

<tr>
  <td>Series? <input type="radio" name="fseries" value="Y"> Yes
      <input type="radio" name="fseries" value="N" checked> No</td>
</tr>

<tr>
  <td>If Series, Series' Title:</td>
</tr>

<tr>
  <td><input type="text" name="fseriestitle" size="35"></td>
</tr>

<tr>
  <td>Translation? <input type="radio" name="ftranslation" value="Y"> Yes
      <input type="radio" name="ftranslation" value="N" checked> No</td>
</tr>

<tr>
  <td>If translation, translator's last, first, MI:</td>
</tr>

<tr>
  <td><input type="text" name="ftransln" size="35">,</td>
  <td><input type="text" name="ftransfn" size="35"> </td>
  <td><input type="text" name="ftransmi" size="1">.</td>
</tr>

<tr>
  <td>Reprint? <input type="radio" name="freprint" value="Y"> Yes
      <input type="radio" name="freprint" value="N" checked> No</td>
</tr>

<tr>
  <td>If reprint, reprint author's last, first, MI:</td>
</tr>

<tr>
  <td><input type="text" name="frepauthorln" size="35">,</td>
  <td><input type="text" name="frepauthorfn" size="35"> </td>
  <td><input type="text" name="frepauthormi" size="1">.</td>
</tr>

</table>


	</td>
    </tr>
    <tr> 
      <td colspan="2"> 
        <h3>Research Information</h3>
        <p><b>Learning Ally (RFB&amp;D) Phone: 800.635.1403 Agency #AG77843001</b><br>
          <a href="http://www.rfbd.org" target="_blank"> http://www.learningally.org</a> 
          <br>
          Learning Ally (RFB&amp;D) Checked? 
          <input type="checkbox" name="rfbd_checked" value="1">
          <br>
          Learning Ally (RFB&amp;D) Has It?  
          <input type="checkbox" name="rfbd_hasit" value="1">
          <br>
		  On-hand from Learning Ally (RFB&amp;D)? 
          <input type="checkbox" name="rfbd_onhand" value="1">
        </p>
        </td>
    </tr>
    <tr> 
      <td bgcolor="#cccccc" colspan="2"> 
        <h3>Learning Ally (RFB&amp;D) Information</h3>
        <p>Catalog Number 
          <input type="text" name="rfbdnumber">
          <br>
          Ordered (YYYY-MM-DD) 
          <input type="text" name="rfbd_ordered" value="0000-00-00">
          <br>
          Received (YYYY-MM-DD) 
          <input type="text" name="rfbd_received" value="0000-00-00">
        </p>
        <p>&nbsp;</p>
      </td>
    </tr>
    <tr> 
      <td colspan="2"> 
        <h3>Bookstore Information</h3>
        <p>Bookstore Checked? 
          <input type="checkbox" name="bs_checked" value="1">
          <br>
          Promised Date (YYYY-MM-DD) 
          <input type="text" name="bs_promised" value="0000-00-00">
          <br>
          Bookstore Has It?  
          <input type="checkbox" name="bs_hasit" value="1">
          <br>
          Picked Up (YYYY-MM-DD) 
          <input type="text" name="bs_pickedup" value="0000-00-00">
        </p>
        <p>&nbsp;</p>
      </td>
    </tr>
    <tr> 
      <td bgcolor="#cccccc" colspan="2"> 
        <h3>Processing Information</h3>
        <p>Scanning Complete 
          <input type="checkbox" name="scancomplete" value="1">
          OCR Complete 
          <input type="checkbox" name="ocrcomplete" value="1">
          Corrections Complete 
          <input type="checkbox" name="checkcomplete" value="1">
          <br>
          Tapes Complete 
          <input type="checkbox" name="tapescomplete" value="1">
        </p>
        <p>&nbsp;</p>
      </td>
    </tr>
    <tr> 
      <td colspan="2"> 
        <h3>Notes </h3>
        <p> 
          <textarea name="notes" rows="10" cols="80"></textarea>
        </p>
      </td>
    </tr>
    <tr> 
      <td colspan="2"> 
        <input type="submit" name="Submit" value="Add Book">
      </td>
    </tr>
  </table>
  <p><br>
    <br>
    <br>
    <br>
    <br>
    <br>
  </p>
  <p>&nbsp; </p>
  </form>
<?php
display_document_bottom();
?>
