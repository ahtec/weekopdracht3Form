<?php
//$allesOK = FALSE;
require_once 'loginGegevens.php';
$conextion = new mysqli(DBSERVER, DBUSER, DBPASS, DBASE);

if (!$conextion) {
    die('Could not connect: ' . mysqli_error($conextion));
}


// verwijder tabel

if ($conextion->connect_error)
    die($connectie->connect_error);
$query = 'DROP TABLE IF EXISTS dbPersonen.personen';
echo "<br>\n".$query;
$result = $conextion->query($query);

// gebruikt database dbpersonen


$query = 'USE dbpersonen ';
$result = $conextion->query($query);

// maak tabel personen
$query = "CREATE TABLE  personen ( naam VARCHAR(30)   , adres VARCHAR(30)  , woonplaats VARCHAR(30) , gender VARCHAR(30) , objectPersoon VARCHAR(100) , PRIMARY KEY (naam) )";
//ALTER TABLE `personen` ADD `objectPersoon` BLOB NOT NULL AFTER `gender`;
//$query = "CREATE TABLE  personen ( naam VARCHAR(30))   , adres VARCHAR(30)  , woonplaats VARCHAR(30) , gender VARCHAR(30) PRIMARY KEY (naam) )";
//$query = 'CREATE TABLE  personen (naam VARCHAR(30))   , (adres VARCHAR(30) , (adres VARCHAR(30))  , (woonplaats VARCHAR(30)) ,(gender VARCHAR(30))';
echo "<br>\n".$query;

$result = $conextion->query($query);

//$query =  "ALTER TABLE `personen` CHANGE `objectPersoon` `objectPersoon` LONGTEXT NULL DEFAULT NULL";
//$query =  "ALTER TABLE `personen` CHANGE `objectPersoon` `objectPersoon` BLOB  NULL";
//$query = "ALTER TABLE personen ADD objectPersoon BLOB  BINARY AFTER gender";
//$result = $conextion->query($query);



echo "<br> connectie\n";
echo $conextion->connect_error;
//
//// maak index, pri
//$query = "CREATE INDEX naamindex ON personen (naam(30)";
//$result = $conextion->query($query);

echo $result;

//$sql = "ALTER TABLE `personen`  ADD `objectPersoon` MEDIUMBLOB NOT NULL  AFTER `gender`";
                header("Location: index.php");
?>