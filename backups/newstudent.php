<html>
<head>
<title>New Student</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "include/menubar.htm"; ?>
<h2>New Student Information </h2>
  <form action="studentpost.php" method="post">
  <p>Student ID Number (123-45-6789) : 
    <input type="text" name="sid">
  </p>
  <p>FirstName: 
    <input type="text" name="firstname">
    Last Name: 
    <input type="text" name="lastname">
  </p>
  <p>Telephone (999)123-4567: 
    <input type="text" name="telephone">
  </p>
  <p>Email: 
    <input type="text" name="email" size="75">
    <input type="submit" name="Submit" value="Submit">
  </p>
  </form>

