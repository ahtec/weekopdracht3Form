<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>


    <div>
        <?php
        
        define("ROOMNUMBER",204);
        
        $naam = $_GET['naam'];
        $gender = $_GET['gender'];
        
        echo $gender;
        

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
        
                header("Location: index.php");
        exit;

        ?>

    </div>

</body>
</html>
