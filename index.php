<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html  >
    <head>
        <style>
      p {
          align-self: center;
       background-color: red;
       color: white;
}

        </style>
        <script>

            function validate(form) {
                fail = validateNaam(form.naam.value)

                if (fail == "")
                    return true
                else {
                    alert(fail);
                    return false
                }
            }

            function validateNaam(field)
            {
                return (field == "") ? "Naam persoon mag niet leeg zijn\n" : ""
            }
        </script>
    </head>
    <body STYLE="font-size: 20px; font-family:Courier New, Courier, monospace;">
        <?php
        $var1 = count($_GET);
        if ($var1 == 1) {        // show personen
            echo "<p>";
            echo $_GET['errorText'];
            echo "</p>";
        }
        require_once 'loginGegevens.php';
        $conextion = new mysqli(DBSERVER, DBUSER, DBPASS, DBASE);

        if (!$conextion) {
            die('Could not connect: ' . mysqli_error($con));
        }

        $sql = "SELECT * FROM personen ";

        $result = mysqli_query($conextion, $sql);
        if ($result->num_rows === 0) {
//            die("lege result set");
        } else {
//            echo " result set niet leeg";
        }


        echo " <h5>  Dit zijn de bestaande personen</h5>
            <table>
            <tr>
                <th>Naam</th>
                <th>Adres</th>
                <th>Woonplaats</th>
                <th>Gender</th>
            </tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['naam'] . "</td>";
            echo "<td>" . $row['adres'] . "</td>";
            echo "<td>" . $row['woonplaats'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_close($conextion);
        ?>
        <h4>  Op dit scherm kunt personen toevoegen</h4>
        <hr>
        <form name="personenForm" action="voegPersoonToe.php" onsubmit="return validate(this)" >
            <table>
                <tr> <td> Naam           </td> <td>  <input type="text" name="naam" >  </td>
                <tr> <td> Adres          </td> <td>  <input type="text" name="adres" ></td>
                <tr> <td> Woonplaats     </td> <td>  <input type="text" name="woonplaats" ></td>
                <tr> <td>   
                        <input type="radio" name="gender" value="male" checked> Male <br>
                        <input type="radio" name="gender" value="female">       Female<br>
                    </td>
            </table>
            <br>
            <input type="submit" value="bewaar persoon">
        </form>   

        <form name="drop" action="dropPersonen.php">
            <input type="submit" value="drop tabel personen  en maak weer aan">
        </form>
    </body>
</html>
