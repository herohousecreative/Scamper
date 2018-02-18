<?php
include "include/database.php";
include "include/tteuser.php";

display_document_center_top();
echo '
  <div id="pageName"> 
    <h2>Add TTE New Book</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';
?>

 
<form action="bookpost.php" method="post">
  <table width="65%" border="0">
    <tr> 
      <td bgcolor="#666666" colspan="2" font color="#000000">
        <h2><font color="#FFFFFF"> New Book Processing</font></h2>
        </td>
    </tr>
    <tr> 
      <td bgcolor="#cccccc" width="87%" align="top" valign="top"> 
        <h3>General Information</h3>
        <p>Title 
          <input type="text" name="title" size="75">
          <br>
          Author(s) 
          <input type="text" name="authors" size="75">
          <br>
          Publisher 
          <input type="text" name="publisher" size="75">
          <br>
          Edition 
          <input type="text" name="edition" size="15">
          <br>
          Pub Year
          <input type="text" name="pubyear" size="12">
        </p>
        <p>&nbsp;</p>
      </td>
      <td bgcolor="#cccccc" width="13%" align="right"> Format(s)<br>
          HTML<input type="checkbox" name="HTML" value="HTML" checked><br>
          TXT<input type="checkbox" name="TXT" value="TXT" checked><br>
          PDF<input type="checkbox" name="PDF" value="PDF"><br>
          BRF<input type="checkbox" name="BRF" value="BRF"><br>
          DXB<input type="checkbox" name="DXB" value="DXB"><br>
          DOC<input type="checkbox" name="DOC" value="DOC"><br>
          RTF<input type="checkbox" name="RTF" value="RTF"><br>
          RFB<input type="checkbox" name="RFB" value="RFB"><br>
          VOL<input type="checkbox" name="VOL" value="VOL">
      </td>
    </tr>
    <tr> 
      <td colspan="2"> 
        <h3>Research Information</h3>
        <p>TTE Checked? 
          <input type="checkbox" name="tte_checked" value="1">
          TTE Has It? 
          <input type="checkbox" name="tte_hasit" value="1">
          <br>
          ATS Checked 
          <input type="checkbox" name="ats_checked" value="1">
          ATS Has It? 
          <input type="checkbox" name="ats_hasit" value="1">
          <br>
          On-hand from RFBD? 
          <input type="checkbox" name="rfbd_onhand" value="1">
        </p>
        <p><b>RFB&amp;D Phone: 800.635.1403 Agency #AG77843001</b><br>
          <a href="http://www.rfbd.org/catalog.htm#catform" target="_blank"> http://www.rfbd.org/catalog.htm#catform</a> 
          <br>
          RFB&amp;D Checked? <a href="http://www.rfbd.org/catalog.htm#catform" target="_blank"> 
          <input type="checkbox" name="rfbd_checked" value="1">
          </a><br>
          RFB&amp;D Has It? <a href="http://www.rfbd.org/catalog.htm#catform" target="_blank"> 
          <input type="checkbox" name="rfbd_hasit" value="1">
          </a></p>
        </td>
    </tr>
    <tr> 
      <td bgcolor="#cccccc" colspan="2"> 
        <h3>RFBD Information</h3>
        <p>RFB&amp;D Number 
          <input type="text" name="rfbdnumber">
          <br>
          Ordered (YYYY-MM-DD) 
          <input type="text" name="rfbd_ordered">
          <br>
          Received (YYYY-MM-DD) 
          <input type="text" name="rfbd_received">
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
          <input type="text" name="bs_promised">
          <br>
          Bookstore Has It? (YYYY-MM-DD) 
          <input type="text" name="bs_hasit">
          <br>
          Picked Up (YYYY-MM-DD) 
          <input type="text" name="bs_pickedup">
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
          <textarea name="notes" rows="10" cols="75"></textarea>
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