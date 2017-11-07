<?php
//$allesOK = FALSE;
require_once 'loginGegevens.php';
$conextion = new mysqli(DBSERVER, DBUSER, DBPASS, DBASE);

if (!$conextion) {
    die('Could not connect: ' . mysqli_error($conextion));
}

if ($conextion->connect_error)
    die($connectie->connect_error);
$query = 'DROP TABLE IF EXISTS dbPersonen.personen';

echo "<br>\n".$query;
$result = $conextion->query($query);

$query = 'USE dbpersonen ';
$result = $conextion->query($query);
$query = "CREATE TABLE  personen ( naam VARCHAR(30)   , adres VARCHAR(30)  , woonplaats VARCHAR(30) , gender VARCHAR(30), PRIMARY KEY (naam) )";
//$query = "CREATE TABLE  personen ( naam VARCHAR(30))   , adres VARCHAR(30)  , woonplaats VARCHAR(30) , gender VARCHAR(30) PRIMARY KEY (naam) )";
//$query = 'CREATE TABLE  personen (naam VARCHAR(30))   , (adres VARCHAR(30) , (adres VARCHAR(30))  , (woonplaats VARCHAR(30)) ,(gender VARCHAR(30))';
echo "<br>\n".$query;

$result = $conextion->query($query);

echo "<br> connectie\n";
echo $conextion->connect_error;
$result = $conextion->query($query);

echo $result;
                header("Location: index.php");
?>