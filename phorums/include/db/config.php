<?php
/*  type: The type of database. Typically 'mysql'.
    name: The name of the database Phorum will be using.
    server: The address of the database server. Typically 'localhost'.
    user: Your username to connect to the database.
    password: Your password to connect to the database.
    table_prefix: This will be at the front of the name of tables Phorum creates. */

    if(!defined("PHORUM")) return;

    $PHORUM["DBCONFIG"]=array(
	
        "type"          =>  "mysql",
        "name"          =>  "phorums",
        "server"        =>  "mysql2.dsa.reldom.tamu.edu",
        "user"          =>  "ttepass",
        "password"      =>  "DSAtemptte12&",
        "table_prefix"  =>  "phorum"

    );

?>
