<?php
if(!defined("PHORUM_CONTROL_CENTER")) return;

if(count($_POST)) {
     $error = phorum_controlcenter_user_save($panel);
}


$PHORUM["DATA"]["PROFILE"]["block_title"] = $PHORUM["DATA"]["LANG"]["EditSignature"];

$PHORUM['DATA']['PROFILE']['SIGSETTINGS'] = 1;
$template = "cc_usersettings";

?>
