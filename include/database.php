<?php

// This is for Production
//$sys_dbhost='localhost'; (or likely)
//$sys_dbuser='scamper';
//$sys_dbpasswd='trustme';
$sys_dbhost='mysql2.dsa.reldom.tamu.edu';
$sys_dbuser='michaelb';
$sys_dbpasswd='baggins';
$sys_dbname='tte';
$semester='18A';
$nextsemester='18B';
$nextsemester2='18C';


//This is for testing
//sys_dbhost='mysql2.dsa.reldom.tamu.edu';
//$sys_dbuser='michaelb';
//$sys_dbpasswd='baggins';
//$sys_dbname='tte';
//$semester='12A';
//$nextsemester='12B';
//$nextsemester2='12C';

// Compensate for lack of "register_globals" setting in PHP.
if ($_REQUEST)
	extract($_REQUEST);

if (!isset($_SERVER['HTTP_AUTHORIZATION']))
{
    auth();
}
else
{
	$conn = db_connect();
	
	list($user, $pw) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
	$user = mysql_real_escape_string($user, $conn);
	$pw = mysql_real_escape_string($pw, $conn);
	
	$query = mysql_query("SELECT u.* FROM tte.users u WHERE u.username = '{$user}' AND u.password != '**INACTIVE**' AND u.password = '{$pw}'", $conn);
	$result = mysql_fetch_array($query, MYSQL_ASSOC);
	
	if (!$result)
		auth();
}

function auth()
{
	header('WWW-Authenticate: Basic realm="Scamper"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Access denied. Please submit your request again.';
    exit;
}

function db_connect() {
	global $sys_dbhost,$sys_dbuser,$sys_dbpasswd;
	$conn = mysql_connect($sys_dbhost,$sys_dbuser,$sys_dbpasswd);
	if (!$conn) {
		echo mysql_error();
	}
	return $conn;
}

function db_query($qstring,$print=0) {
	global $sys_dbname;
	return @mysql($sys_dbname,$qstring);
}

function db_numrows($qhandle) {
	// return only if qhandle exists, otherwise 0
	if ($qhandle) {
		return @mysql_numrows($qhandle);
	} else {
		return 0;
	}
}

function db_result($qhandle,$row,$field) {
	return @mysql_result($qhandle,$row,$field);
}

function db_numfields($lhandle) {
	return @mysql_numfields($lhandle);
}

function db_fieldname($lhandle,$fnumber) {
	return @mysql_fieldname($lhandle,$fnumber);
}

function db_affected_rows($qhandle) {
	return @mysql_affected_rows();
}

function db_fetch_array($qhandle) {
	return @mysql_fetch_array($qhandle);
}

function db_insertid($qhandle) {
	return @mysql_insert_id($qhandle);
}

function db_error() {
	return "\n\n<P><B>".@mysql_error()."</B><P>\n\n";
}

/** Book Retrieval **/
function getBookContents($id)
{
	$book_file = getBookFilename($id);
	
	if (!file_exists($book_file))
		return NULL;
		
	$fp = gzopen($book_file, 'rb');
	gzpassthru($fp);
	gzclose($fp);
}
function setBookContents($id, $content)
{
	$book_file = getBookFilename($id);
	
	$gz = gzopen($book_file,'wb9');
	gzwrite($gz, $content);
	gzclose($gz);
	return true;
}
function deleteBookContents($id)
{
	$book_file = getBookFilename($id);
	@unlink($book_file);
	return true;
}
function getBookFilename($id)
{
	$books_dir = 'E:/TTEBooks';
	return $books_dir.'/'.$id.'.gz';
}