<?php if(!defined("PHORUM")) return; ?>

<div class="PhorumNavBlock" style="text-align: left;">
<span class="PhorumNavHeading PhorumHeadingLeft"><?php echo $PHORUM['DATA']['LANG']['Goto']; ?>:</span>&nbsp;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['INDEX']; ?>"><?php echo $PHORUM['DATA']['LANG']['ForumList']; ?></a>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['POST']; ?>"><?php echo $PHORUM['DATA']['LANG']['NewTopic']; ?></a>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['SEARCH']; ?>"><?php echo $PHORUM['DATA']['LANG']['Search']; ?></a><?php if(isset($PHORUM['DATA']['LOGGEDIN']) && $PHORUM['DATA']['LOGGEDIN']==true){ ?>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['REGISTERPROFILE']; ?>"><?php echo $PHORUM['DATA']['LANG']['MyProfile']; ?></a><?php if(isset($PHORUM['DATA']['ENABLE_PM']) && !empty($PHORUM['DATA']['ENABLE_PM'])){ ?>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['PRIVATE_MESSAGES']['inbox_url']; ?>"><?php echo $PHORUM['DATA']['LANG']['PrivateMessages']; ?></a><?php } ?>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['LOGINOUT']; ?>"><?php echo $PHORUM['DATA']['LANG']['LogOut']; ?></a><?php } ?><?php if(isset($PHORUM['DATA']['LOGGEDIN']) && $PHORUM['DATA']['LOGGEDIN']==false){ ?>&bull;    <a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['LOGINOUT']; ?>"><?php echo $PHORUM['DATA']['LANG']['LogIn']; ?></a><?php } ?>
</div>


<?php if(isset($PHORUM['DATA']['PAGES']) && !empty($PHORUM['DATA']['PAGES'])){ ?>
<div class="PhorumNavBlock" style="text-align: left;">
<div style="float: right;">
<span class="PhorumNavHeading"><?php echo $PHORUM['DATA']['LANG']['Pages']; ?>:</span>&nbsp;
<?php if(isset($PHORUM['DATA']['URL']['PREVPAGE']) && !empty($PHORUM['DATA']['URL']['PREVPAGE'])){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['PREVPAGE']; ?>"><?php echo $PHORUM['DATA']['LANG']['PrevPage']; ?></a><?php } ?>
<?php if(isset($PHORUM['DATA']['URL']['FIRSTPAGE']) && !empty($PHORUM['DATA']['URL']['FIRSTPAGE'])){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['FIRSTPAGE']; ?>"><?php echo $PHORUM['DATA']['LANG']['FirstPage']; ?>...</a><?php } ?>
<?php if(isset($PHORUM['DATA']['PAGES']) && is_array($PHORUM['DATA']['PAGES'])) foreach($PHORUM['DATA']['PAGES'] as $PHORUM['TMP']['PAGES']){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['TMP']['PAGES']['url']; ?>"><?php echo $PHORUM['TMP']['PAGES']['pageno']; ?></a><?php } unset($PHORUM['TMP']['PAGES']); ?>
<?php if(isset($PHORUM['DATA']['URL']['LASTPAGE']) && !empty($PHORUM['DATA']['URL']['LASTPAGE'])){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['LASTPAGE']; ?>">...<?php echo $PHORUM['DATA']['LANG']['LastPage']; ?></a><?php } ?>
<?php if(isset($PHORUM['DATA']['URL']['NEXTPAGE']) && !empty($PHORUM['DATA']['URL']['NEXTPAGE'])){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['NEXTPAGE']; ?>"><?php echo $PHORUM['DATA']['LANG']['NextPage']; ?></a><?php } ?>
</div>
<span class="PhorumNavHeading PhorumHeadingLeft"><?php echo $PHORUM['DATA']['LANG']['CurrentPage']; ?>:</span><?php echo $PHORUM['DATA']['CURRENTPAGE']; ?> <?php echo $PHORUM['DATA']['LANG']['of']; ?> <?php echo $PHORUM['DATA']['TOTALPAGES']; ?>
</div>
<?php } ?>
<table class="PhorumStdTable" cellspacing="0">
<tr>
    <th class="PhorumTableHeader" align="left"><?php echo $PHORUM['DATA']['LANG']['Subject']; ?></th>
<?php if(isset($PHORUM['DATA']['VIEWCOUNT_COLUMN']) && !empty($PHORUM['DATA']['VIEWCOUNT_COLUMN'])){ ?>    <th class="PhorumTableHeader" align="center"><?php echo $PHORUM['DATA']['LANG']['Views']; ?></th><?php } ?>
    <th class="PhorumTableHeader" align="left" nowrap><?php echo $PHORUM['DATA']['LANG']['WrittenBy']; ?></th>
    <th class="PhorumTableHeader" align="left" nowrap><?php echo $PHORUM['DATA']['LANG']['Posted']; ?></th>
</tr>
<?php
  $oldthread=0;
  $rclass="";
?>
<?php if(isset($PHORUM['DATA']['ROWS']) && is_array($PHORUM['DATA']['ROWS'])) foreach($PHORUM['DATA']['ROWS'] as $PHORUM['TMP']['ROWS']){ ?>
<?php
  if($oldthread != $PHORUM['TMP']['ROWS']['thread']){
    if($rclass=="Alt"){
        $rclass="";
    } else {
        $rclass="Alt";
    }
    $oldthread=$PHORUM['TMP']['ROWS']['thread'];
  }
?>
<tr>
    <td class="PhorumTableRow<?php echo $rclass;?>"><?php echo $PHORUM['TMP']['ROWS']['indent']; ?><?php if(isset($PHORUM['TMP']['ROWS']['sort']) && $PHORUM['TMP']['ROWS']['sort']==PHORUM_SORT_STICKY){ ?><span class="PhorumListSubjPrefix"><?php echo $PHORUM['DATA']['LANG']['Sticky']; ?>:&nbsp;</span><?php } ?><?php if(isset($PHORUM['TMP']['ROWS']['sort']) && $PHORUM['TMP']['ROWS']['sort']==PHORUM_SORT_ANNOUNCEMENT){ ?><span class="PhorumListSubjPrefix"><?php echo $PHORUM['DATA']['LANG']['Announcement']; ?>:&nbsp;</span><?php } ?><a href="<?php echo $PHORUM['TMP']['ROWS']['url']; ?>"><?php echo $PHORUM['TMP']['ROWS']['subject']; ?></a>&nbsp;<span class="PhorumNewFlag"><?php echo $PHORUM['TMP']['ROWS']['new']; ?></span></td>
<?php if(isset($PHORUM['DATA']['VIEWCOUNT_COLUMN']) && !empty($PHORUM['DATA']['VIEWCOUNT_COLUMN'])){ ?>        <td class="PhorumTableRow<?php echo $rclass;?>" nowrap="nowrap" align="center" width="80"><?php echo $PHORUM['TMP']['ROWS']['viewcount']; ?></td><?php } ?>
    <td class="PhorumTableRow<?php echo $rclass;?>" nowrap="nowrap" width="150"><?php echo $PHORUM['TMP']['ROWS']['linked_author']; ?></td>
    <td class="PhorumTableRow<?php echo $rclass;?> PhorumSmallFont" nowrap="nowrap" width="150"><?php echo $PHORUM['TMP']['ROWS']['datestamp']; ?><?php if(isset($PHORUM['DATA']['MODERATOR']) && $PHORUM['DATA']['MODERATOR']==true){ ?><br /><span class="PhorumListModLink"><?php if(isset($PHORUM['TMP']['ROWS']['threadstart']) && $PHORUM['TMP']['ROWS']['threadstart']==false){ ?><a class="PhorumListModLink" href="javascript:if(window.confirm('<?php echo $PHORUM['DATA']['LANG']['ConfirmDeleteMessage']; ?>')) window.location='<?php echo $PHORUM['TMP']['ROWS']['delete_url1']; ?>';"><?php echo $PHORUM['DATA']['LANG']['DeleteMessage']; ?></a><?php } ?><?php if(isset($PHORUM['TMP']['ROWS']['threadstart']) && $PHORUM['TMP']['ROWS']['threadstart']==true){ ?><a class="PhorumListModLink" href="javascript:if(window.confirm('<?php echo $PHORUM['DATA']['LANG']['ConfirmDeleteThread']; ?>')) window.location='<?php echo $PHORUM['TMP']['ROWS']['delete_url2']; ?>';"><?php echo $PHORUM['DATA']['LANG']['DeleteThread']; ?></a>|&nbsp;<a class="PhorumListModLink" href="<?php echo $PHORUM['TMP']['ROWS']['move_url']; ?>"><?php echo $PHORUM['DATA']['LANG']['MoveThread']; ?></a><?php } ?></span><?php } ?></td>
</tr>
<?php } unset($PHORUM['TMP']['ROWS']); ?>
</table>

<?php if(isset($PHORUM['DATA']['PAGES']) && !empty($PHORUM['DATA']['PAGES'])){ ?>
<div class="PhorumNavBlock" style="text-align: left;">
<div style="float: right;">
<span class="PhorumNavHeading"><?php echo $PHORUM['DATA']['LANG']['Pages']; ?>:</span>&nbsp;
<?php if(isset($PHORUM['DATA']['URL']['PREVPAGE']) && !empty($PHORUM['DATA']['URL']['PREVPAGE'])){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['PREVPAGE']; ?>"><?php echo $PHORUM['DATA']['LANG']['PrevPage']; ?></a><?php } ?>
<?php if(isset($PHORUM['DATA']['URL']['FIRSTPAGE']) && !empty($PHORUM['DATA']['URL']['FIRSTPAGE'])){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['FIRSTPAGE']; ?>"><?php echo $PHORUM['DATA']['LANG']['FirstPage']; ?>...</a><?php } ?>
<?php if(isset($PHORUM['DATA']['PAGES']) && is_array($PHORUM['DATA']['PAGES'])) foreach($PHORUM['DATA']['PAGES'] as $PHORUM['TMP']['PAGES']){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['TMP']['PAGES']['url']; ?>"><?php echo $PHORUM['TMP']['PAGES']['pageno']; ?></a><?php } unset($PHORUM['TMP']['PAGES']); ?>
<?php if(isset($PHORUM['DATA']['URL']['LASTPAGE']) && !empty($PHORUM['DATA']['URL']['LASTPAGE'])){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['LASTPAGE']; ?>">...<?php echo $PHORUM['DATA']['LANG']['LastPage']; ?></a><?php } ?>
<?php if(isset($PHORUM['DATA']['URL']['NEXTPAGE']) && !empty($PHORUM['DATA']['URL']['NEXTPAGE'])){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['NEXTPAGE']; ?>"><?php echo $PHORUM['DATA']['LANG']['NextPage']; ?></a><?php } ?>
</div>
<span class="PhorumNavHeading PhorumHeadingLeft"><?php echo $PHORUM['DATA']['LANG']['CurrentPage']; ?>:</span><?php echo $PHORUM['DATA']['CURRENTPAGE']; ?> <?php echo $PHORUM['DATA']['LANG']['of']; ?> <?php echo $PHORUM['DATA']['TOTALPAGES']; ?>
</div>
<?php } ?>
<div class="PhorumNavBlock" style="text-align: left;">
<span class="PhorumNavHeading PhorumHeadingLeft"><?php echo $PHORUM['DATA']['LANG']['Options']; ?>:</span>&nbsp;<?php if(isset($PHORUM['DATA']['LOGGEDIN']) && $PHORUM['DATA']['LOGGEDIN']==true){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['MARKREAD']; ?>"><?php echo $PHORUM['DATA']['LANG']['MarkRead']; ?></a><?php } ?>
</div>