<h1> Studentenprofiel </h1>

<?php
/* Gegevens Student --------------------------------------------------------- */
$id = $_GET["id"];
$link = mysql_connect("localhost","ism1h","gfy");
mysql_select_db("zoen",$link);

$result = mysql_query("SELECT * FROM Student
                        WHERE studentnr = '".$id."'");
$row = mysql_fetch_assoc($result);


print("<a href='?p=Wijzigstudenten&id=$row[studentnr]'>  Wijzigen </a> <br/> <br/> ");

print("

<table>
    <form>
        <tr>
            <td> Studentnummer: </td>
            <td> $row[studentnr] </td>
        </tr>
        <tr>
            <td> Voornaam: </td>
            <td> $row[voornaam] </td>
        </tr>
        <tr>
            <td> Achternaam: </td>
            <td> $row[achternaam] </td>
        </tr>
        <tr>
            <td> Adres: </td>
            <td> $row[adres] </td>
        </tr>
        <tr>
            <td> Postcode: </td>
            <td> $row[postcode] </td>
        </tr>
        <tr>
            <td> Woonplaats: </td>
            <td> $row[woonplaats] </td>
        </tr>
        <tr>
            <td> Geslacht: </td>
            <td> $row[geslacht] </td>
        </tr>
        <tr>
            <td> Geboortedatum: </td>
            <td> $row[geboortedatum] </td>
        </tr>
        <tr>
            <td> Email-adres: </td>
            <td> $row[emailadres] </td>
        </tr>
        <tr>
            <td> RFID-Code </td>
            <td> $row[RFID] </td>

        </tr>
    </form>
</table>");
$link = mysql_connect("localhost", "root", "root");
        mysql_select_db("zoen",$link);
if( $_SERVER['REQUEST_METHOD'] == 'POST'){ //kijken of knop is ingedrukt
       
        $onderwerp = $_POST["onderwerp"];
        $bericht = $_POST["bericht"];
        $datum = (date("Y-m-d"));
        $random = rand(5, 500);
        $result = mysql_query("INSERT INTO Profielbericht (profielberichtId, datum, onderwerp, inhoud, studentId)
        VALUES ($random, '$datum', '$onderwerp', '$bericht', '$id')", $link);

    }
//print ("Mijn berichten: (<a href='plaatsenprofielbericht.php'>toevoegen</a>)");
    //$link = mysql_connect("localhost", "root", "root");
    //mysql_select_db("zoen", $link);
    
    $result = mysql_query("SELECT datum, onderwerp, inhoud FROM Profielbericht;", $link);
    print("<table border=\"1\">");
    print ("Mijn berichten: <a href='plaatsenprofielbericht.php'>toevoegen</a>");
    for ($i = 0; $i < mysql_num_rows($result); $i++) {
        $row = mysql_fetch_assoc($result);
	print("<tr><td bgcolor='grey'><b> Datum</b> </td>");
	print("<td bgcolor='grey' width=400>" . $row['datum'] . "</td><br></tr>");
	print("<tr><td><b> Onderwerp</b> </td>");
	print("<td>" . $row['onderwerp'] . "<br></td><br></tr>");
	print("<tr><td><b> Inhoud</b> </td>");
	print("<td>" . $row['inhoud'] . "<br></td></tr>");
	print("<tr><td>&nbsp;</td> <td>&nbsp;</td></tr>");
    }
    
    
    print ('</table>');

/* Evenementen -------------------------------------------------------------- */
$datum = (date("Y-m-d"));

$resultbezocht = mysql_query("SELECT e.naam as Evenement,begindatum,v.naam as Vereniging,c.naam as Categorie,e.evenementId
                                FROM evenement e JOIN categorie c JOIN vereniging v JOIN aanmelding a
                                    ON e.categorieId = c.categorieId AND e.evenementId = a.evenementId AND e.organiserendeVerenigingId = v.verenigingId
                                        WHERE studentId = '".$row[studentId]."' AND begindatum < '".$datum."' ");

$resultnogbezoeken = mysql_query("SELECT e.naam as Evenement,begindatum,v.naam as Vereniging,c.naam as Categorie,e.evenementId
                                    FROM evenement e JOIN categorie c JOIN vereniging v JOIN aanmelding a
                                        ON e.categorieId = c.categorieId AND e.evenementId = a.evenementId AND e.organiserendeVerenigingId = v.verenigingId
                                            WHERE studentId = '".$row[studentId]."'AND begindatum > '".$datum."' ");
?>
<br/> <b> Evenementen </b> <br/>
        Bezocht: <br/>


    <table border="1">
        <tr>
            <th> Naam </th>
            <th> Begin </th>
            <th> Vereniging </th>
            <th> Categorie </th>
        </tr>
<?php
for($q=0;$q<mysql_num_rows($resultbezocht);$q++)
{
    $rowbezocht = mysql_fetch_assoc($resultbezocht);

print("
        <tr>
            <td> $rowbezocht[Evenement] </td>
            <td> $rowbezocht[begindatum] </td>
            <td> $rowbezocht[Vereniging] </td>
            <td> $rowbezocht[Categorie] </td>
        </tr> ");

}

?>
    </table>
        <br/>
        Ik ga nog naar: <br/>

        <table border="1">
        <tr>
            <th> Naam </th>
            <th> Begin </th>
            <th> Vereniging </th>
            <th> Categorie </th>
        </tr>
<?php


for($w=0;$w<mysql_num_rows($resultnogbezoeken);$w++)
{
    $rownogbezoeken = mysql_fetch_assoc($resultnogbezoeken);

 print("
         <tr>
             <td> $rownogbezoeken[Evenement] </td>
             <td> $rownogbezoeken[begindatum] </td>
             <td> $rownogbezoeken[Vereniging] </td>
             <td> $rownogbezoeken[Categorie] </td>
         </tr> ");
}


?>
        </table>
<?php



/* Verenigingen ------------------------------------------------------------- */
$result2 = mysql_query("SELECT v.naam as vereniging,l.studentid as studentid
                            FROM Vereniging v JOIN Lidmaatschap l
                                ON v.verenigingid = l.verenigingid
                                    WHERE studentid = '".$row[studentId]."'");



print("<br/> Ik ben member van de volgende vereniging(en): <br/>");
for($b=0;$b<mysql_num_rows($result2);$b++)
{
    $row2 = mysql_fetch_assoc($result2);
   
    print($row2[vereniging]); print("<br/>");
}
/* Test gedeelte -------------------------------------------------------------*/
?>
        <br/> <br/> <br/>
<?php
print("SELECT e.naam as Evenement,begindatum,v.naam as Vereniging,c.naam as Categorie,e.evenementId
                                FROM evenement e JOIN categorie c JOIN vereniging v JOIN aanmelding a
                                    ON e.categorieId = c.categorieId AND e.evenementId = a.evenementId AND e.organiserendeVerenigingId = v.verenigingId
                                        WHERE studentId = '".$row[studentId]."' AND begindatum < '".$datum."' ");
?>
