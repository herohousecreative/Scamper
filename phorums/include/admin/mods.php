<?php

    if(!defined("PHORUM_ADMIN")) return;

    $error="";

    if(count($_POST)){

        foreach($_POST as $key=>$value){

            if(substr($key, 0, 5)=="mods_") {

                $mod=substr($key, 5);
                $mods[$mod]=$value;
            }
        }

        foreach($_POST as $key=>$value){

            if(substr($key, 0, 6)=="hooks_"){
                $mod=substr($key, 6);
                if($mods[$mod]==1){

                    $hook_arr=explode(",", $value);
                    foreach($hook_arr as $hk){
                        $parts=explode("|", $hk);
                        $hooks[$parts[0]]["mods"][]=$mod;
                        $hooks[$parts[0]]["funcs"][]=$parts[1];
                    }
                }
            }
        }

        $data=array("hooks"=>$hooks, "mods"=>$mods);

        if(phorum_db_update_settings($data)){
            echo "Mods Updated<br />";
        } else {
            $error="Database error while updating settings.";
        }

    }

    if($error){
        phorum_admin_error($error);
    }

    // read plugin info

    $d = dir("./mods");
    while (false !== ($entry = $d->read())) {
        if(file_exists("./mods/$entry/info.txt")){
            $plugins[$entry]=array();
            $lines=file("./mods/$entry/info.txt");
            foreach($lines as $line){
                if(strstr($line, ":")){
                    $parts=explode(":", trim($line), 2);
                    if($parts[0]=="hook"){
                        $plugins[$entry]["hooks"][]=trim($parts[1]);
                    } else {
                        $plugins[$entry][$parts[0]]=trim($parts[1]);
                    }
                }
            }
            $plugins[$entry]["hooks"]=implode(",", $plugins[$entry]["hooks"]);

            if(file_exists("./mods/$entry/settings.php")){
                $plugins[$entry]["settings"]=true;
            } else {
                $plugins[$entry]["settings"]=false;
            }
        }
    }
    $d->close();

    include_once "./include/admin/PhorumInputForm.php";

    $frm =& new PhorumInputForm ("", "post");

    $frm->addbreak("Phorum Module Settings");

    $frm->hidden("module", "mods");

    foreach($plugins as $name => $plugin){

        if(isset($mods[$name])){
            $thisval=$mods[$name];
        } elseif(isset($PHORUM["mods"]["$name"])){
            $thisval=$PHORUM["mods"]["$name"];
        } else {
            $thisval=0;
        }

        if($plugin["settings"]){
            if($thisval==0){
                $settings_link="<br /><a href=\"javascript:alert('You can not edit settings for a module unless it is turned On.');\">Settings</a>";
            } else {
                $settings_link="<br /><a href=\"$_SERVER[PHP_SELF]?module=modsettings&mod=$name\">Settings</a>";
            }
        } else {
            $settings_link="";
        }

        $frm->hidden("hooks_$name", $plugin["hooks"]);
        $frm->addrow("$plugin[title]<div class=\"small\">".wordwrap($plugin["desc"], 72, "<br />")."</div>", $frm->select_tag("mods_$name", array("Off", "On"), $thisval).$settings_link);

    }

    $frm->show();

?>
