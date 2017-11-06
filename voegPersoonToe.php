<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>


    <div>
        <?php
        
        define("ROOMNUMBER",204);
//        $connectie = new mysqli('localhost', 'root', 'root', 'dbPersonen');
        $connectie = new mysqli('localhost', 'root', '', 'dbPersonen');
        if ($connectie->connect_error) die($connectie->connect_error);
        
        
      //INSERT INTO `personen` (`naam`, `adres`, `woonplaats`, `gender`) VALUES ('gerard', 'adres', 'mepp', 'Male');  
        
        
        $naam       = $_GET['naam'];
        $adres      = $_GET['adres'];
        $woonplaats = $_GET['woonplaats'];        
        $gender     = $_GET['gender'];
        
        
//        echo $gender;
        

        $regel = "naam: " . $_GET['naam'];
        storeRegel($naam, $regel);

        $regel = "adres: " . $_GET['adres'];
        storeRegel($naam, $regel);

        $regel = "Woonplaats: " . $_GET['woonplaats'];
        storeRegel($naam, $regel);

        $regel  = "Gender : " .  $_GET['gender'];
        storeRegel($naam, $regel);

        
        function storeRegel($erinNaam, $erin) {
            $fh = fopen($erinNaam . ".txt", 'a+');
            fwrite($fh, "\n");
            fwrite($fh, $erin);
            fwrite($fh, ";");
            fclose($fh);
        }
        
        
        $query = "INSERT INTO `personen` (`naam`, `adres`, `woonplaats`, `gender`) VALUES ( '$naam', '$adres', '$woonplaats', '$gender'  )";
        
        echo $query;
        $result = $connectie->query($query);

        $query =  "SELECT * FROM `personen` ";
 
        $result = $connectie->query($query);

        $rows = $result->num_rows;
        for ($i = 0; $i < $rows ; $i++){
            
            $result->data_seek($i);
            echo "\n <br>naam : ".$result->fetch_assoc()['naam'];
            echo "\n <br>adres : ".$result->fetch_assoc()['adres'];
            echo "\n <br>woonplaats : ".$result->fetch_assoc()['woonplaats'];
            echo "\n <br>gender : ".$result->fetch_assoc()['gender'];
            echo "<br>";
        }
        
        
        $result;
        
//                header("Location: index.php");
        exit;

        ?>

    </div>

</body>
</html>
