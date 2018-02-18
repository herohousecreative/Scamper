<?php if(!defined("PHORUM")) return; ?>
<?php // ! --- defines are used by the engine and vars are used by the template ---  ?>

<?php // ! --- This is used to indent messages in threaded view ---  ?>
<?php $PHORUM["TMP"]['indentstring']='&nbsp;&nbsp;&nbsp;'; ?>

<?php // ! --- This is used to load the message-bodies in the message-list for that template if set to 1 ---  ?>
<?php $PHORUM["TMP"]['bodies_in_list']='0'; ?>

<?php // ! --- This is the marker for messages in threaded view ---  ?>
<?php $PHORUM["TMP"]['marker']='<img src="templates/default/images/carat.gif" border="0" width="8" height="8" alt="" style="vertical-align: middle;" />&nbsp;'; ?>

<?php // ! --- these are the colors used in the style sheet ---  ?>

<?php // ! --- you can use them or replace them in the style sheet ---  ?>



<?php // ! --- common body-colors ---  ?>
<?php $PHORUM["DATA"]['bodybackground']='White'; ?>
<?php $PHORUM["DATA"]['defaulttextcolor']='Black'; ?>
<?php $PHORUM["DATA"]['backcolor']='White'; ?>
<?php $PHORUM["DATA"]['forumwidth']='100%'; ?>
<?php $PHORUM["DATA"]['forumalign']='center'; ?>
<?php $PHORUM["DATA"]['newflagcolor']='#CC0000'; ?>
<?php $PHORUM["DATA"]['errorfontcolor']='Red'; ?>


<?php // ! --- for the forum-list ... alternating colors ---  ?>
<?php $PHORUM["DATA"]['altbackcolor']='#EEEEEE'; ?>
<?php $PHORUM["DATA"]['altlisttextcolor']='#000000'; ?>

<?php // ! --- common link-settings ---  ?>
<?php $PHORUM["DATA"]['linkcolor']='#000099'; ?>
<?php $PHORUM["DATA"]['activelinkcolor']='#FF6600'; ?>
<?php $PHORUM["DATA"]['visitedlinkcolor']='#000099'; ?>
<?php $PHORUM["DATA"]['hoverlinkcolor']='#FF6600'; ?>

<?php // ! --- for the Navigation ---  ?>
<?php $PHORUM["DATA"]['navbackcolor']='#EEEEEE'; ?>
<?php $PHORUM["DATA"]['navtextcolor']='#000000'; ?>
<?php $PHORUM["DATA"]['navhoverbackcolor']='#FFFFFF'; ?>
<?php $PHORUM["DATA"]['navhoverlinkcolor']='#FF6600'; ?>
<?php $PHORUM["DATA"]['navtextweight']='normal'; ?>
<?php $PHORUM["DATA"]['navfont']='Lucida Sans Unicode, Lucida Grande, Arial'; ?>
<?php $PHORUM["DATA"]['navfontsize']='12px'; ?>

<?php // ! --- for the PhorumHead ... the list-header ---  ?>
<?php $PHORUM["DATA"]['headerbackcolor']='#EEEEEE'; ?>
<?php $PHORUM["DATA"]['headertextcolor']='#000000'; ?>
<?php $PHORUM["DATA"]['headertextweight']='bold'; ?>
<?php $PHORUM["DATA"]['headerfont']='Lucida Sans Unicode, Lucida Grande, Arial'; ?>
<?php $PHORUM["DATA"]['headerfontsize']='12px'; ?>



<?php $PHORUM["DATA"]['tablebordercolor']='#808080'; ?>

<?php $PHORUM["DATA"]['listlinecolor']='#F2F2F2'; ?>

<?php $PHORUM["DATA"]['listpagelinkcolor']='#707070'; ?>
<?php $PHORUM["DATA"]['listmodlinkcolor']='#707070'; ?>





<?php // ! --- You can set the table width globaly here ... ONLY tables, no divs are changed---  ?>
<?php $PHORUM["DATA"]['tablewidth']='100%'; ?>
<?php $PHORUM["DATA"]['narrowtablewidth']='600px'; ?>



<?php // ! --- Some font stuff ---  ?>
<?php $PHORUM["DATA"]['defaultfont']='Lucida Sans Unicode, Lucida Grande, Arial'; ?>
<?php $PHORUM["DATA"]['largefont']='Trebuchet MS,Verdana, Arial, Helvetica, sans-serif'; ?>
<?php $PHORUM["DATA"]['tinyfont']='Arial, Helvetica, sans-serif'; ?>
<?php $PHORUM["DATA"]['fixedfont']='Lucida Console, Andale Mono, Courier New, Courier'; ?>
<?php $PHORUM["DATA"]['defaultfontsize']='12px'; ?>
<?php $PHORUM["DATA"]['largefontsize']='16px'; ?>
<?php $PHORUM["DATA"]['smallfontsize']='11px'; ?>
<?php $PHORUM["DATA"]['tinyfontsize']='10px'; ?>