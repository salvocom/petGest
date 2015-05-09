<?php
include_once('../config/config.php');
include_once('../class/data.class.php');

$mysqli = new data(HOST, USERNAME, PASSWORD, DATABASE);

if(isset($_GET['specie']))
{
	$datastore = $mysqli->getRazze($_GET['specie']);
}
echo json_encode($datastore);
?>
