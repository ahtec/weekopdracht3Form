<html>
    <head>
    </head>
    <div>
        <?php
        require_once 'loginGegevens.php';
        $allesOK = FALSE;
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
        } else {

            $query = "INSERT INTO `personen` (`naam`, `adres`, `woonplaats`, `gender`) VALUES ( '$naam', '$adres', '$woonplaats', '$gender'  )";

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
        if($allesOK) {
            header("Location: index.php");   // terug naar index.php
                exit;
        }

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
        ?>

    </div>

</body>
</html>
