<?php

$connectie = new mysqli('localhost', 'root', '', 'dbpersonen');
if ($connectie->connect_error)
    die($connectie->connect_error);
$query = 'DROP TABLE IF EXISTS dbPersonen.personen';

echo "<br>\n";
//echo $query;
//$result = $connectie->query($query);
$query = 'USE dbpersonen ';
$result = $connectie->query($query);
$query = "CREATE TABLE  personen ( naam VARCHAR(30)   , adres VARCHAR(30)  , woonplaats VARCHAR(30) , gender VARCHAR(30), PRIMARY KEY (naam) )" ;
//$query = "CREATE TABLE  personen ( naam VARCHAR(30))   , adres VARCHAR(30)  , woonplaats VARCHAR(30) , gender VARCHAR(30) PRIMARY KEY (naam) )";
//$query = 'CREATE TABLE  personen (naam VARCHAR(30))   , (adres VARCHAR(30) , (adres VARCHAR(30))  , (woonplaats VARCHAR(30)) ,(gender VARCHAR(30))';
echo "<br>\n";
//echo $query;
$result = $connectie->query($query);

//echo "<br> connectie\n";
echo $connectie->connect_error ;
$result = $connectie->query($query);

//echo $result;

//                header("Location: index.php");

?>