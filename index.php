<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html  >
    <head>
        <link rel="stylesheet" type="text/css" href="mystyle.css">
        <title>Personen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>

            function validate(form) {
                fail = validateNaam(form.naam.value)
                fail += validateAdres(form.adres)
                if (fail == "")
                    return true
                else {
                    alert(fail);
                    return false
                }

            }

            function validateSchipnaam(field)
            {
                return (field == "") ? "Vul naam schip in\n" : ""
            }

            function validateCoordinaten(
                    fieldX1,
                    fieldY1,
                    fieldX2,
                    fieldY2)
            {
                eruit = "";

                if ((fieldX1 != fieldX2) && (fieldY1 != fieldY2)) {

                    eruit = "U kunt schepen horizontaal of vertikaal ingeven, \n\
horizontaal is: \n dat de eerste en de laatste horizontale positie hetzelfde zijn, \n\
\nvoor een vertikaal schip zijn dat de eerste en laatste vertikale positie.\n";
                } else {
                    if ((fieldX1 > fieldX2) || (fieldY1 > fieldY2)) {
                        eruit = "Eerste coordinaat mag niet groter zijn dan tweede coordinaat";
                    }
                }
                return (eruit);
            }

        </script>
    </head>
    <body STYLE="font-size: 20px; font-family:Courier New, Courier, monospace;">
        <h4>  Op dit scherm kunt personen toevoegen</h4>


        <hr>
        <form name="voegschiptoe" action="voegPersoonToe.php" onsubmit="return validate(this)">
            <table>
                <tr> <td> Naam           </td> <td>  <input type="text" name="naam" >  </td>
                <tr> <td> Adres          </td> <td>  <input type="text" name="adres" ></td>
                <tr> <td> Woonplaats     </td> <td>  <input type="text" name="woonplaats" ></td>
                <tr> <td>   
                        <input type="radio" name="gender" value="male" checked> Male<br>
                        <input type="radio" name="gender" value="female"> Female<br>
                    </td>
            </table>
            <br>

            <br><br>
            <input type="submit" value="bewaar persoon">

        </form>   


   <form name="speelZeeslag" action="dropPersonen.php">
            <input type="submit" value="drop tabel personen  en maak weer aan">
        </form>


    </body>
</html>
