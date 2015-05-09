<?php
include_once('../config/config.php');
include_once('../class/data.class.php');

$mysqli = new data(HOST, USERNAME, PASSWORD, DATABASE);

if(isset($_GET['regione']))
{
	$datastore = $mysqli->getProvince($_GET['regione']);
}
if(isset($_GET['provincia']))
{
	$datastore = $mysqli->getComuni($_GET['provincia']);
}
if(isset($_GET['cod_istat']))
{
	$datastore = $mysqli->getCap($_GET['cod_istat']);
}
echo json_encode($datastore);
?>
