<html>
    <head>
    </head>
    <div>
        <?php
        require_once 'loginGegevens.php';
        require_once 'objectPersoon.php';
        $allesOK = FALSE;
        $returnText = "";
        $connectie = new mysqli(DBSERVER, DBUSER, DBPASS, DBASE);

        if ($connectie->connect_error) {
            die($connectie->connect_error);
        }

        $naam = $_GET['naam'];
        $adres = $_GET['adres'];
        $woonplaats = $_GET['woonplaats'];
        $gender = $_GET['gender'];


        $regel = "naam: " . $_GET['naam'];
        storeRegel($naam, $regel);
        $regel = "adres: " . $_GET['adres'];
        storeRegel($naam, $regel);
        $regel = "Woonplaats: " . $_GET['woonplaats'];
        storeRegel($naam, $regel);
        $regel = "Gender : " . $_GET['gender'];
        storeRegel($naam, $regel);

        if (naamBestaat($naam, $connectie)) {
            // naam bestaat al, we doen niets
            $returnText = "Naam $naam bestaat al";
        } else {
            $ojPersoon = new persoon();
            $ojPersoon->naam = "objectpersoon naam";

//            
            $serializeData = serialize($ojPersoon);
              storeRegel($naam, $serializeData);
//            $serializeData = addslashes($serializeData);
            $serializeData = htmlspecialchars($serializeData);
            $serializeData = "ggggg";
            
//             file_put_contents("serpersonn.txt", $serializeData);
            echo $serializeData;
            var_dump($serializeData);
//            $packedData = pack('H*', base_convert($input, 2, 16));
//            echo $packedData;
//            $packedData = pack("H*", $serializeData);
//              $query = "INSERT INTO `personen` (`naam`, `adres`, `woonplaats`, `gender`, `objectPersoon`) VALUES ('naam', NULL, NULL, NULL, 'hhhhhhh')";
            $query = "INSERT INTO `personen` (`naam`, `adres`, `woonplaats`, `gender` ) VALUES ( '$naam', '$adres', '$woonplaats', '$gender'  )";
//$query = "INSERT INTO `personen` (`naam`, `adres`, `woonplaats`, `gender`,'objectPersoon') VALUES ( '$naam', '$adres', '$woonplaats','$gender' , {$serializeData} )";
//
////Recoverable fatal error: Object of class persoon could not be converted to string in C:\xampp\htdocs\weekOpdracht3\voegPersoonToe.php on line 39
//
//            $query = "INSERT INTO `personen` (`naam`, `adres`, `woonplaats`, `gender`) VALUES ( '$naam', '$adres', '$woonplaats', '$gender'  )";


            echo "<br>";
            echo $query;
            $result = $connectie->query($query);



            if (naamBestaat($naam, $connectie)) {
                mysqli_close($connectie);        // sluit de connectie
                $allesOK = TRUE;
            } else {
                // persoon is  NIET  toegevoegd
                echo "Er ging iets mis met het toevoegen van :" . $query;
                echo "<br>" . mysqli_error($connectie);
            }
        }
//        if($allesOK) {
        header("Location: index.php?errorText=$returnText ");   // terug naar index.php
        exit;

//        }
        //  Begin van de functies ///////
        function naamBestaat($paramNaam, $connectie) {
            $eruit = TRUE;

            $sql = "SELECT * FROM personen WHERE naam = '" . $paramNaam . "'";
            $result = mysqli_query($connectie, $sql);
//            var_dump($result);
            if ($result->num_rows == 0) {
                $eruit = FALSE;
            }
            return $eruit;
        }

        function storeRegel($erinNaam, $erin) {
            $fh = fopen($erinNaam . ".txt", 'a+');
            fwrite($fh, "\n");
            fwrite($fh, $erin);
            fwrite($fh, ";");
            fclose($fh);
        }

        function convert2bin($regel) {
            $eruit = "";
            for ($i = 0; $i < count($regel); $i++) {
                
            }
        }
        ?>

    </div>

</body>
</html>
