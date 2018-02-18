<?php
include "include/ttedatabase.php";
include "include/tteuser.php";

display_document_center_top();
echo '
  <div id="pageName"> 
    <h2>TTE Member Posted</h2> 
  </div> 
  <div id="content"> 
    <div class="feature"> 
';

?>

<?php
$result=insert_member($FMEMFNAME,$FMEMLNAME,$FORGNAME,$FORGADDRESS1,$FORGADDRESS2,$FORGCITY,$FORGSTATE,$FORGZIP,$FORGCOUNTRY,$FORGPHONE,$FMEMLOGONNAME,$FMEMPASSWORD,$FEMAIL,$FAPPMAILED,$FAPPSUBMIT,$FAPPAPPROVED,$FAPPDECREASON,$FREGDATE,$FOFFICE,$FFAX,$FTAPEDATA);
if (!$result) {
  echo 'There was an error in you post.';
} else {
  $id = mysql_insert_id();
  echo "<h4>You have successfully posted the following...</h4>
  <table cellpadding=\"2\" cellspacing=\"0\"  border=\"0\" >";
  echo "<br>"; 	
  echo "<tr>
  	<TD width=\"185\" >Member First Name</TD>
  	<TD width=175 ><strong>",$FMEMFNAME,"</strong></TD>
  </TR>";
  echo "<tr>
 	 <TD width=\"185\" >Member Last Name</TD>
  	<TD width=175 ><strong>",$FMEMLNAME,"</strong></TD>
  </TR>";
  echo "<tr>
  	<TD width=\"185\" >Organization Name</TD>
  	<TD width=175 ><strong>",$FORGNAME,"</strong></TD>
  </TR>";
  echo "<tr>
 	 <TD width=\"185\" >Organization Address(Line 1)</TD>
 	 <TD width=175 ><strong>",$FORGADDRESS1,"</strong></TD>
  </TR>";
  echo "<tr>
 	 <TD width=\"185\" >Organization Address(Line 2)</TD>
  	<TD width=175 ><strong>",$FORGADDRESS2,"</strong></TD>
  </TR>";
  echo "<tr>
  	<TD width=\"175\" >Organization City</TD>
  	<TD width=175 ><strong>",$FORGCITY,"</strong></TD>
  </TR>";
  echo "<tr>
 	 <TD width=\"175\" >Organization State</TD>
 	 <TD width=175 ><strong>",$FORGSTATE,"</strong></TD>
  </TR>";
  echo "<tr>
 	 <TD width=\"175\" >Organization Zip</TD>
 	 <TD width=175 ><strong>",$FORGZIP,"</strong></TD>
  </TR>";
  echo "<tr>
 	 <TD width=\"175\" >Organization Country</TD>
 	 <TD width=175 ><strong>",$FORGCOUNTRY,"</strong></TD>
  </TR>";
  echo "<tr>
 	 <TD width=\"175\" >Organization Phone</TD>
 	 <TD width=175 ><strong>",$FORGPHONE,"</strong></TD>
  </TR>";
  echo "<tr>
 	 <TD width=\"175\" >Member Logon Name</TD>
  	<TD width=175 ><strong>",$FMEMLOGONNAME,"</strong></TD>
  </TR>";
  echo "<tr>
 	 <TD width=\"175\" >Member Password</TD>
 	 <TD width=175 ><strong>",$FMEMPASSWORD,"</strong></TD>
  </TR>";
 echo "<tr>
 	 <TD width=\"175\" >Member Email</TD>
 	 <TD width=175 ><strong>",$FEMAIL,"</strong></TD>
  </TR>";
  echo "<tr>
 	 <TD width=\"175\" >Application Mailed?</TD>
 	 <TD width=175 ><strong>",$FAPPMAILED,"</strong></TD>
  </TR>";
  echo "<tr>
  	<TD width=\"175\" >Application Submitted?</TD>
  	<TD width=175 ><strong>",$FAPPSUBMIT,"</strong></TD>
  </TR>";
 echo "<tr>
  	<TD width=\"175\" >Application Approved?</TD>
  	<TD width=175 ><strong>",$FAPPAPPROVED,"</strong></TD>
  </TR>";
 echo "<tr>
  	<TD width=\"175\" >Application Declined Reason</TD>
  	<TD width=175 ><strong>",$FAPPDECREASON,"</strong></TD>
  </TR>";
echo "<tr>
  	<TD width=\"175\" >Registration Date</TD>
  	<TD width=175 ><strong>",$FREGDATE,"</strong></TD>
  </TR>";
 echo "<tr>
  	<TD width=\"175\" >Office</TD>
  	<TD width=175 ><strong>",$FOFFICE,"</strong></TD>
  </TR>";
 echo "<tr>
  	<TD width=\"175\" >Fax</TD>
  	<TD width=175 ><strong>",$FFAX,"</strong></TD>
  </TR>";
 echo "<tr>
  	<TD width=\"175\" >TAPEDATA</TD>
  	<TD width=175 ><strong>",$FTAPEDATA,"</strong></TD>
  </TR>";
  echo "</table>";
  
  echo "<br><a href=\"index.php\">Return to homepage</a>";
  echo "<br><a href=\"ttenewmember.php\">Add another member.</a>";
}

display_document_bottom();
?>


