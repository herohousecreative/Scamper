<?php if(!defined("PHORUM")) return; ?>
<?php echo '<?xml version="1.0" encoding="iso-8859-1"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "DTD/xhtml1-transitional.dtd">
<html lang="<?php echo $PHORUM['locale']; ?>">
<head>
<title><?php echo $PHORUM['DATA']['HTML_TITLE']; ?></title>
<style type="text/css">
<?php include_once phorum_get_template('css'); ?>
</style>
<?php if(isset($PHORUM['DATA']['URL']['REDIRECT']) && !empty($PHORUM['DATA']['URL']['REDIRECT'])){ ?>
<meta http-equiv="refresh" content="5; url=<?php echo $PHORUM['DATA']['URL']['REDIRECT']; ?>" />
<?php } ?>
<?php echo $PHORUM['DATA']['LANG_META']; ?>
<?php echo $PHORUM['DATA']['HEAD_TAGS']; ?>
</head>
<body>
<div align="<?php echo $PHORUM['DATA']['forumalign']; ?>">
<div class="PDDiv">
<?php if(isset($PHORUM['DATA']['notice_all']) && !empty($PHORUM['DATA']['notice_all'])){ ?>
<div class="PhorumNotificationArea PhorumNavBlock">
<?php if(isset($PHORUM['DATA']['PRIVATE_MESSAGES']['new']) && !empty($PHORUM['DATA']['PRIVATE_MESSAGES']['new'])){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['PRIVATE_MESSAGES']['inbox_url']; ?>"><?php echo $PHORUM['DATA']['LANG']['NewPrivateMessages']; ?></a><br /><?php } ?>
<?php if(isset($PHORUM['DATA']['notice_messages']) && !empty($PHORUM['DATA']['notice_messages'])){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['notice_messages_url']; ?>"><?php echo $PHORUM['DATA']['LANG']['UnapprovedMessagesLong']; ?></a><br /><?php } ?>
<?php if(isset($PHORUM['DATA']['notice_users']) && !empty($PHORUM['DATA']['notice_users'])){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['notice_users_url']; ?>"><?php echo $PHORUM['DATA']['LANG']['UnapprovedUsersLong']; ?></a><br /><?php } ?>
<?php if(isset($PHORUM['DATA']['notice_groups']) && !empty($PHORUM['DATA']['notice_groups'])){ ?><a class="PhorumNavLink" href="<?php echo $PHORUM['DATA']['notice_groups_url']; ?>"><?php echo $PHORUM['DATA']['LANG']['UnapprovedGroupMembers']; ?></a><br /><?php } ?>
</div>
<?php } ?>
<span class="PhorumTitleText PhorumLargeFont">
<?php if(isset($PHORUM['DATA']['NAME']) && !empty($PHORUM['DATA']['NAME'])){ ?><a href="<?php echo $PHORUM['DATA']['URL']['TOP']; ?>"><?php echo $PHORUM['DATA']['NAME']; ?></a>&nbsp;:&nbsp;<?php } ?><?php echo $PHORUM['DATA']['TITLE']; ?></span>
<?php if(isset($PHORUM['DATA']['DESCRIPTION']) && !empty($PHORUM['DATA']['DESCRIPTION'])){ ?><div class="PhorumFloatingText"><?php echo $PHORUM['DATA']['DESCRIPTION']; ?></div><?php } ?>
<img src="templates/default/images/logo.png" alt="The fastest message board....ever." width="75" height="72" /> 
