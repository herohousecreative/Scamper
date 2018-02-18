<html> 
<head> 
<title>Example 2.23</title><basefont face="Arial"> 
</head> 
<body bgcolor="white"> 

<font size="+3">Sammy's Sports Store</font> 
<br> 
<font size="-2">14, Ocean View, CA 12345, USA http://www.sammysportstore.com/</font> 
<p> 
<hr>   
<center>INVOICE</center> 
<hr> 
<?php 

// element handlers 
// these look up the element in the associative arrays 
// and print the equivalent HTML code 
function startElementHandler($parser, $name, $attribs) 
{
      global $startTagsArray; 

      // expose element being processed 
      global $currentTag; 
      $currentTag = $name; 

      // look up element in array and print corresponding HTML 
      if ($startTagsArray[$name]) 
      {
            echo $startTagsArray[$name]; 
      } 
} 

function endElementHandler($parser, $name) 
{
      global $endTagsArray; 
      if ($endTagsArray[$name]) 
      {
            echo $endTagsArray[$name]; 
      } 
} 

// character data handler 
// this prints CDATA as it is found 
function characterDataHandler($parser, $data) 
{
      global $currentTag; 
      global $subTotals; 

      echo $data; 

      // record subtotals for calculation of grand total 
      if ($currentTag == "SUBTOTAL") 
      {
            $subTotals[] = $data; 
      } 
} 

// external entity handler 
// if SYSTEM-type entity, this function looks up the entity and parses it 
function externalEntityHandler($parser, $name, $base, $systemId, $publicId) 
{
      if ($systemId) 
      {
            parse($systemId); 
            // explicitly return true 
            return true; 
      } 
      else 
      {
            return false; 
      } 


} 

// PI handler 
// this function processes PHP code if it finds any 
function PIHandler($parser, $target, $data) 
{
      // if php code, execute it 
      if (strtolower($target) == "php") 
      {
            eval($data); 
      } 
} 

// this function adds up all the subtotals 
// and prints a grand total 
function displayTotal() 
{
      global $subTotals; 
      foreach($subTotals as $element) 
      {
            $total += $element; 
      } 
      echo "<p> <b>Total payable: </b> " . $total; 
} 

// function to actually perform parsing 
function parse($xml_file) 
{
      // initialize parser 
      $xml_parser = xml_parser_create(); 

      // set callback functions 
      xml_set_element_handler($xml_parser, "startElementHandler", "endElementHandler"); 
xml_set_character_data_handler($xml_parser, "characterDataHandler"); 
xml_set_processing_instruction_handler($xml_parser, "PIHandler");   
xml_set_external_entity_ref_handler($xml_parser, "externalEntityHandler"); 

      // read XML file 
      if (!($fp = fopen($xml_file, "r"))) 
      {
            die("File I/O error: $xml_file"); 
      } 

      // parse XML 
      while ($data = fread($fp, 4096)) 
      {
          // error handler 
            if (!xml_parse($xml_parser, $data, feof($fp))) 
            {
                  $ec = xml_get_error_code($xml_parser); 
                  die("XML parser error (error code " . $ec . "): " . 
xml_error_string($ec) . "<br>Error occurred at line " . 
xml_get_current_line_number($xml_parser)); 
            } 
      } 

// all done, clean up! 
xml_parser_free($xml_parser); 
} 

// arrays to associate XML elements with HTML output 
$startTagsArray = array(
'CUSTOMER' => '<p> <b>Customer: </b>', 
'ADDRESS' => '<p> <b>Billing address: </b>', 
'DATE' => '<p> <b>Invoice date: </b>', 
'REFERENCE' => '<p> <b>Invoice number: </b>', 
'ITEMS' => '<p> <b>Details: </b> <table width="100%" border="1" cellspacing="0" 
cellpadding="3"><tr><td><b>Item 
description</b></td><td><b>Price</b></td><td><b>Quantity</b></td><td><b>Subtotal</b></
td></tr>', 
'ITEM' => '<tr>', 
'DESC' => '<td>', 
'PRICE' => '<td>', 
'QUANTITY' => '<td>', 
'SUBTOTAL' => '<td>', 
'DELIVERY' => '<p> <b>Shipping option:</b> ', 
'TERMS' => '<p> <b>Terms and conditions: </b> <ul>', 
'TERM' => '<li>' 
); 

$endTagsArray = array(
'LINE' => ',', 
'ITEMS' => '</table>', 
'ITEM' => '</tr>', 
'DESC' => '</td>', 
'PRICE' => '</td>', 
'QUANTITY' => '</td>', 
'SUBTOTAL' => '</td>', 
'TERMS' => '</ul>', 
'TERM' => '</li>' 
); 

// create array to hold subtotals 
$subTotals = array(); 

// begin parsing 
$xml_file = "invoice.xml"; 
parse($xml_file); 

?> 
</body> 
</html> 
