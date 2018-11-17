<?php
require_once 'app/config.php';
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

$query = "SELECT * FROM Task WHERE 1";
$result = mysqli_query($connection, $query);
if (!$result) {
    die('Invalid query: ' . mysqli_error($connection));
}

header("Content-type: text/xml");
while ($row = @mysqli_fetch_assoc($result)){
    // Add to XML document node
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("id",$row['id']);
    $newnode->setAttribute("name",$row['nameOfBuilding']);
    $newnode->setAttribute("address", $row['address']);
    $newnode->setAttribute("lat", $row['Latitude']);
    $newnode->setAttribute("lng", $row['Longitude']);
    $newnode->setAttribute("type", $row['building_type']);
    $newnode->setAttribute("hasElevator", $row['hasElevator']);
    $newnode->setAttribute("hasRamp", $row['hasRamp']);
    $newnode->setAttribute("numFloors", $row['numFloors']);
}

echo $dom->saveXML();
?>