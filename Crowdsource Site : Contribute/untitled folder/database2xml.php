<?php
require_once 'app/config.php';

$xml          = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
$root_element = "buildings"; //fruits
$xml         .= "<$root_element>";

//select all items in table
$sql = "SELECT * FROM ".$config['database_table'];

$result = mysqli_query($connection, $sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($connection));
}

if(mysqli_num_rows($result)>0)
{
    while($result_array = mysqli_fetch_assoc($result))
    {
        $xml .= "<".$config['database_table'].">";

        //loop through each key,value pair in row
        foreach($result_array as $key => $value)
        {
            //$key holds the table column name
            $xml .= "<$key>";

            //embed the SQL data in a CDATA element to avoid XML entity issues
            $xml .= "$value";

            //and close the element
            $xml .= "</$key>";
        }

        $xml.="</".$config['database_table'].">";
    }
}
//close the root element
$xml .= "</$root_element>";

//send the xml header to the browser
header ("Content-Type:text/xml");

//output the XML data
echo $xml;
?>