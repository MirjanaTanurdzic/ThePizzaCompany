<?php
$hostname="localhost";
$username="root";
$password= "";
$dbname="baza";
mysqli_report(MYSQLI_REPORT_OFF);
error_reporting(0);
$mysqli = new mysqli($hostname, $username, $password, $dbname);
if ($mysqli->connect_error) {
    echo "Id greške je: ". $mysqli->connect_error;
    echo "Neuspesna konekcija na bazu podataka. ". $mysqli->connect_error;
}
$ime = $_POST["ime"];
$prezime = $_POST["prezime"];
$brojTelefona = $_POST["brojTelefona"];
$adresa = $_POST["adresa"];
$velicina = $_POST["velicina"];
$kolicina = $_POST["kolicina"];
$datumDostave = $_POST["datumDostave"];
$vremeDostave = $_POST["vremeDostave"];
$placanje = $_POST["placanje"];

if($_POST['sir']=='Mozzarella'){
    $sir='Mozzarella';
}
elseif($_POST['sir']=='Gauda'){
    $sir='Gauda';
}
elseif($_POST['sir']=='Feta'){
    $sir='Feta';
}
elseif($_POST['sir']=='Trapist'){
    $sir='Trapist';
}
elseif($_POST['sir']=='Cheddar'){
    $sir='Cheddar';
}
elseif($_POST['sir']=='Parmezan'){
    $sir='Parmezan';
}

if($_POST['sos']=='Kecap'){
    $sos='Kecap';
}
elseif($_POST['sos']=='BBQ'){
    $sos='BBQ';
}
elseif($_POST['sos']=='BeliLuk'){
    $sos='Beli luk';
}
elseif($_POST['sos']=='Pesto'){
    $sos='Pesto';
}
elseif($_POST['sos']=='Majonez'){
    $sos='Majonez';
}
elseif($_POST['sos']=='LjutiKecap'){
    $sos='Ljuti kecap';
}
elseif($_POST['sos']=='Pavlaka'){
    $sos='Pavlaka';
}

if($_POST['sok']=='CocaCola'){
    $sok='Coca Cola';
}
elseif($_POST['sok']=='Pepsi'){
    $sok='Pepsi';
}
elseif($_POST['sok']=='7UP'){
    $sok='7UP';
}
elseif($_POST['sok']=='Mirinda'){
    $sok='Mirinda';
}
elseif($_POST['sok']=='Fanta'){
    $sok='Fanta';
}
elseif($_POST['sok']=='NextNarandza'){
    $sok='Next narandza';
}
elseif($_POST['sok']=='Sprite'){
    $sok='Sprite';
}

if($_POST['topping']=='Kulen'){
    $topping='Kulen';
}
elseif($_POST['topping']=='Salama'){
    $topping='Salama';
}
elseif($_POST['topping']=='Kobasica'){
    $topping='Kobasica';
}
elseif($_POST['topping']=='SuviVrat'){
    $topping='Suvi vrat';
}
elseif($_POST['topping']=='Prsuta'){
    $topping='Prsuta';
}

if($_POST['topp']=='Rukola'){
    $topp='Rukola';
}
elseif($_POST['topp']=='BeliLuk'){
    $topp='Beli luk';
}
elseif($_POST['topp']=='Brokoli'){
    $topp='Brokoli';
}
elseif($_POST['topp']=='Masline'){
    $topp='Masline';
}
elseif($_POST['topp']=='Paprika'){
    $topp='Paprika';
}
elseif($_POST['topp']=='Pecurke'){
    $topp='Pecurke';
}
elseif($_POST['topp']=='Luk'){
    $topp='Luk';
}

$instrukcije = $_POST["instrukcije"];

$sql="INSERT INTO narudzba (ime, prezime, brojTelefona, adresa, velicina, kolicina, datumDostave, vremeDostave, placanje, sir, sos, sok, topping, topp, instrukcije)
VALUES ('$ime','$prezime','$brojTelefona','$adresa','$velicina','$kolicina','$datumDostave','$vremeDostave','$placanje','$sir','$sos','$sok','$topping','$topp','$instrukcije')";
if($mysqli->query($sql)===TRUE){
    echo "Podaci uspesno uneseni u bazu podataka!";
}else{
    echo "Greska pri unosu podataka: ".$mysqli->error;
}
$mysqli->close();
?>