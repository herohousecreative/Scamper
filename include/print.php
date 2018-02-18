<?php
/* $num_results is the total number of accurencs of your sql query in the 
  database.  

  $result is the actual information itslef.  result is what is returned 
  from db_query 
*/
function print_results ($num_results, $result)
{
	for ($i=0;$i<$num_results;$i++) 
	{
          $row=mysql_fetch_array($result);
          echo 
		     "Student primary key = ". $row["primarykey"] . 
		     " is " . $row["firstname"] . " " . $row["lastname"] . "<br/>";
	}
}

?>