<?php if(!defined("PHORUM")) return; ?>
<?php if(isset($PHORUM['DATA']['ERROR']) && !empty($PHORUM['DATA']['ERROR'])){ ?>
<div class="PhorumUserError"><?php echo $PHORUM['DATA']['ERROR']; ?></div>
<?php } ?>

<div align="center">
<div class="PhorumNavBlock PhorumNarrowBlock" style="text-align: left;">
<span class="PhorumNavHeading"><?php echo $PHORUM['DATA']['LANG']['Goto']; ?>:</span>&nbsp;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['INDEX']; ?>"><?php echo $PHORUM['DATA']['LANG']['ForumList']; ?></a>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['TOP']; ?>"><?php echo $PHORUM['DATA']['LANG']['MessageList']; ?></a>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['SEARCH']; ?>"><?php echo $PHORUM['DATA']['LANG']['Search']; ?></a>
</div>

<form action="<?php echo $PHORUM['DATA']['URL']['ACTION']; ?>" method="post" style="display: inline;">
<?php echo $PHORUM['DATA']['POST_VARS']; ?>
<input type="hidden" name="forum_id" value="<?php echo $PHORUM['DATA']['LOGIN']['forum_id']; ?>" />
<input type="hidden" name="redir" value="<?php echo $PHORUM['DATA']['LOGIN']['redir']; ?>" />
<div class="PhorumStdBlockHeader PhorumNarrowBlock PhorumHeaderText" style="text-align: left;"><?php echo $PHORUM['DATA']['LANG']['LoginTitle']; ?></div>
<div align="center" class="PhorumStdBlock PhorumNarrowBlock">
<table cellspacing="0" align="center">
<tr>
    <td><?php echo $PHORUM['DATA']['LANG']['Username']; ?>:&nbsp;</td>
    <td><input type="text" name="username" size="30" value="<?php echo $PHORUM['DATA']['LOGIN']['username']; ?>" /></td>
</tr>
<tr>
    <td><?php echo $PHORUM['DATA']['LANG']['Password']; ?>:&nbsp;</td>
    <td><input type="password" name="password" size="30" value="" /></td>
</tr>
<tr>
    <td colspan="2" align="right"><input type="submit" class="PhorumSubmit" value="<?php echo $PHORUM['DATA']['LANG']['Submit']; ?>" /></td>
</tr>
</table>
<div class="PhorumFloatingText"><a href="<?php echo $PHORUM['DATA']['URL']['REGISTER']; ?>"><?php echo $PHORUM['DATA']['LANG']['NotRegistered']; ?></a></div>
</div>
</form>

</div>

<div align="center" style="margin-top: 30px;">

<form action="<?php echo $PHORUM['DATA']['URL']['ACTION']; ?>" method="post" style="display: inline;">
<?php echo $PHORUM['DATA']['POST_VARS']; ?>
<input type="hidden" name="lostpass" value="1" />
<input type="hidden" name="forum_id" value="<?php echo $PHORUM['DATA']['LOGIN']['forum_id']; ?>" />
<input type="hidden" name="redir" value="<?php echo $PHORUM['DATA']['LOGIN']['redir']; ?>" />
<div class="PhorumStdBlockHeader PhorumNarrowBlock PhorumHeaderText" style="text-align: left;"><?php echo $PHORUM['DATA']['LANG']['LostPassword']; ?></div>
<div class="PhorumStdBlock PhorumNarrowBlock">
<div class="PhorumFloatingText"><?php echo $PHORUM['DATA']['LANG']['LostPassInfo']; ?></div><div class="PhorumFloatingText"><input type="text" name="lostpass" size="30" value="" /> <input type="submit" class="PhorumSubmit" value="<?php echo $PHORUM['DATA']['LANG']['Submit']; ?>" /></div>
</div>
</form>

</div>