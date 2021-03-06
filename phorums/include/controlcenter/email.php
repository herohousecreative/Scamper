<?php
if ( !defined( "PHORUM_CONTROL_CENTER" ) ) return;

// email-verification
if($PHORUM['registration_control']) {
    //$PHORUM['DATA']['PROFILE']['email_temp']="email_address@bogus.com|bla";
    if (!empty($PHORUM['DATA']['PROFILE']['email_temp'])) {
            list($PHORUM['DATA']['PROFILE']['email_temp_part'],$bogus)=explode("|",$PHORUM['DATA']['PROFILE']['email_temp']);
    }
}

if ( count( $_POST ) ) {
    if ( empty( $_POST["email"] ) ) {
        $error = $PHORUM["DATA"]["LANG"]["ErrRequired"];
    } elseif ( !phorum_valid_email( $_POST["email"] ) 
            || ($PHORUM['user']['email'] != $_POST["email"] && phorum_user_check_email( $_POST["email"]) ) ) {
                // second part could get another section and its own error-message
                
        $error = $PHORUM["DATA"]["LANG"]["ErrEmail"];
        
    } elseif (isset($PHORUM['DATA']['PROFILE']['email_temp_part']) && !empty($_POST['email_verify_code']) && $PHORUM['DATA']['PROFILE']['email_temp_part']."|".$_POST['email_verify_code'] != $PHORUM['DATA']['PROFILE']['email_temp']) {
        $error = $PHORUM['DATA']['LANG']['ErrWrongMailcode'];
    } else {
        // flip this due to db vs. UI wording.
        $_POST["hide_email"] = ( $_POST["hide_email"] ) ? 0 : 1;
        
        // do we need to send a confirmation-mail?
        /*print_var($PHORUM);
        print_var($_POST);*/
        if(isset($PHORUM['DATA']['PROFILE']['email_temp_part']) && !empty($_POST['email_verify_code']) && $PHORUM['DATA']['PROFILE']['email_temp_part']."|".$_POST['email_verify_code'] == $PHORUM['DATA']['PROFILE']['email_temp']) {
               $_POST['email']=$PHORUM['DATA']['PROFILE']['email_temp_part'];
               $_POST['email_temp']="";
        } elseif($PHORUM['registration_control'] && !empty($_POST['email']) && strtolower($_POST['email']) != strtolower($PHORUM["DATA"]["PROFILE"]['email'])) {
            // ... generate the confirmation-code ... // 
            $conf_code= mt_rand ( 1000000, 9999999);
            $_POST['email_temp']=$_POST['email']."|".$conf_code;
            // ... send email ... // 
            $maildata=array(
            'mailmessage'   => $PHORUM['DATA']['LANG']['EmailVerifyBody'],
            'mailsubject'   => $PHORUM['DATA']['LANG']['EmailVerifySubject'],
            'uname'         => $PHORUM['DATA']['PROFILE']['username'],
            'newmail'       => $_POST['email'],
            'mailcode'      => $conf_code,
            'cc_url'        => phorum_get_url(PHORUM_CONTROLCENTER_URL, "panel=" . PHORUM_CC_MAIL)
            );
            phorum_email_user(array($_POST['email']),$maildata);
            // set this up for the template
            $PHORUM['DATA']['PROFILE']['email_temp_part']=$_POST['email'];
            unset($_POST['email']);
        }
        $error = phorum_controlcenter_user_save( $panel );
    } 
} 

// flip this due to db vs. UI wording.
if ( !empty( $PHORUM['DATA']['PROFILE']["hide_email"] ) ) {
    $PHORUM["DATA"]["PROFILE"]["hide_email_checked"] = "";
} else {
    // more html stuff in the code. yuck.
    $PHORUM["DATA"]["PROFILE"]["hide_email_checked"] = " checked=\"checked\"";
} 

$PHORUM["DATA"]["PROFILE"]["EMAIL_CONFIRM"]=$PHORUM["registration_control"];


$PHORUM["DATA"]["PROFILE"]["block_title"] = $PHORUM["DATA"]["LANG"]["EditMailsettings"];

$PHORUM['DATA']['PROFILE']['MAILSETTINGS'] = 1;
$template = "cc_usersettings";

?>
