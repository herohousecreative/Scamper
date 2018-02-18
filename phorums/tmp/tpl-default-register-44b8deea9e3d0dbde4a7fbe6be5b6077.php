<?php if(!defined("PHORUM")) return; ?>
<?php if(isset($PHORUM['DATA']['ERROR']) && !empty($PHORUM['DATA']['ERROR'])){ ?>
<div class="PhorumUserError"><?php echo $PHORUM['DATA']['ERROR']; ?></div>
<?php } ?>

<div align="center">
<form action="<?php echo $PHORUM['DATA']['URL']['ACTION']; ?>" method="post" style="display: inline;">
<?php echo $PHORUM['DATA']['POST_VARS']; ?>
<input type="hidden" name="forum_id" value="<?php echo $PHORUM['DATA']['REGISTER']['forum_id']; ?>" />

<div class="PhorumNavBlock PhorumNarrowBlock" style="text-align: left;">
<span class="PhorumNavHeading"><?php echo $PHORUM['DATA']['LANG']['Goto']; ?>:</span>&nbsp;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['INDEX']; ?>"><?php echo $PHORUM['DATA']['LANG']['ForumList']; ?></a>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['TOP']; ?>"><?php echo $PHORUM['DATA']['LANG']['MessageList']; ?></a>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['SEARCH']; ?>"><?php echo $PHORUM['DATA']['LANG']['Search']; ?></a><?php if(isset($PHORUM['DATA']['LOGGEDIN']) && $PHORUM['DATA']['LOGGEDIN']==true){ ?>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['REGISTERPROFILE']; ?>"><?php echo $PHORUM['DATA']['LANG']['MyProfile']; ?></a><?php if(isset($PHORUM['DATA']['ENABLE_PM']) && !empty($PHORUM['DATA']['ENABLE_PM'])){ ?>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['PRIVATE_MESSAGES']['inbox_url']; ?>"><?php echo $PHORUM['DATA']['LANG']['PrivateMessages']; ?></a><?php } ?>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['LOGINOUT']; ?>"><?php echo $PHORUM['DATA']['LANG']['LogOut']; ?></a><?php } ?><?php if(isset($PHORUM['DATA']['LOGGEDIN']) && $PHORUM['DATA']['LOGGEDIN']==false){ ?>&bull;<a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['URL']['LOGINOUT']; ?>"><?php echo $PHORUM['DATA']['LANG']['LogIn']; ?></a><?php } ?></a>
</div>

<div class="PhorumStdBlockHeader PhorumNarrowBlock PhorumHeaderText" style="text-align: left;"><?php echo $PHORUM['DATA']['LANG']['Register']; ?></div>

<div class="PhorumStdBlock PhorumNarrowBlock" style="text-align: left;">
<table class="PhorumFormTable" cellspacing="0" border="0">
<tr>
    <td nowrap="nowrap"><?php echo $PHORUM['DATA']['LANG']['Username']; ?>*:&nbsp;</td>
    <td><input type="text" name="username" size="30" value="<?php echo $PHORUM['DATA']['REGISTER']['username']; ?>" /></td>
</tr>
<tr>
    <td nowrap="nowrap"><?php echo $PHORUM['DATA']['LANG']['Email']; ?>*:&nbsp;</td>
    <td><input type="text" name="email" size="30" value="<?php echo $PHORUM['DATA']['REGISTER']['email']; ?>" /></td>
</tr>
<tr>
    <td nowrap="nowrap"><?php echo $PHORUM['DATA']['LANG']['Password']; ?>*:&nbsp;</td>
    <td><input type="password" name="password" size="30" value="" /></td>
</tr>
<tr>
    <td nowrap="nowrap">&nbsp;</td>
    <td><input type="password" name="password2" size="30" value="" /> (<?php echo $PHORUM['DATA']['LANG']['again']; ?>)</td>
</tr>
</table>

<div style="float: left; margin-top: 5px;">*<?php echo $PHORUM['DATA']['LANG']['Required']; ?></div>
<div style="margin-top: 3px;" align="right"><input type="submit" class="PhorumSubmit" value=" <?php echo $PHORUM['DATA']['LANG']['Submit']; ?> " /></div>

</div>


</form>
</div>
