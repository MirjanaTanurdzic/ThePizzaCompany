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
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<link rel="icon" href="icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE PIZZA COMPANY-admin</title>
  </head>
  <body>
    <style>
    *{ 
    font-family: 'Times New Roman';
    }
    header{
    display: flex;
    flex-direction: row;
    width: 100%;
    height: 35%;
    background: #5a5959;
    }
    nav{
    margin: auto;
    width: 50%;
    height: 100%;
    }
    nav ul{
    list-style-type: none;
    display: flex;
    align-items: baseline;
    justify-content: center;
    justify-content: space-between;
    font-size: 20px;
    font-weight: bold;
    padding-left: 100px;
    }
    nav ul li a{
    color: #fff;
    text-decoration: none;
    }
    .logo{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50%;
    height: 100%
    }
	.sadrzajAdmin{
	background-image: url('backgroundN.jpg');
	background-size: contain;
	display: flex;
	flex-direction: column;
	width: 100%;
	height: 500px;
	margin-top: 2px;
	padding-top: 5px;
	padding-bottom: 60px;
	color: #fff;
	}
	.pretraga form{
	display: flex;
	flex-direction: row;
	justify-content: flex-end;
	margin-top: 15px;
	margin-right: 25px;
	}
  .pretraga .rezultati{
  display: flex;
  flex-direction: row;
  justify-content: center;
  width: 250px;
  height: auto;
  background:#0000004a;
  border: 1px solid black;
  position: relative;
  top: 10px;
  left: 925px;
  font-size: 12px;
  }
	.sadrzajAdmin h3{
	color: red;
	}
	.tabela table{
	box-shadow: 0 3px 8px black;
	}
	.tabela table tr th{
	padding: 2px 2px 0 2px;
	font-style: italic;
	font-size: 14px;
	}
	.tabela table tr td{
	padding: 2px 2px 0 2px;
	font-size: 10px;
	text-align: center;
	}
    .dugmad form{
    display: flex;
	align-items: baseline;
	justify-content: center;
    margin-top: 20px;
    }
    .dugmad form button{
    background: red;
	color: #fff;
	font-size: 14px;
	padding: 5px;
    }
    .dugmad form button:nth-child(1){
    margin-right: 10px;
    }
    .dugmad form button:nth-child(2){
    margin-right: 10px;
    }
	</style>
  <header>
    <nav>
    <ul>
        <?php
        $meni = array(
            array("url" => "index.php", "label" => "POČETNA"),
            array("url" => "narudzba.php", "label" => "NARUDŽBA"),
            array("url" => "admin.php", "label" => "ADMIN"),
            array("url"=>"kontakt.php","label"=>"KONTAKT")
        );
        foreach ($meni as $stranica) {
            echo "<li><a href='" . $stranica['url'] . "'>" . $stranica['label'] . "</a></li>";
        }
        ?>
    </ul>
    </nav>
    <div class="logo">
      <?php
      $putanjaSlike='logo.png';
      ?>
      <img src="<?php echo $putanjaSlike; ?>" alt="Logo" width="210px" height="70px">
    </div>
  </header>
  <div class="sadrzajAdmin">
  <div class="pretraga">
		<form method="post">
			<input type="text" name="search" id="search" placeholder="Pretrazi te:">
			<button type="submit"><img src="loup.png" width="10px" height="10px"></button>
		</form>
  <?php
  if(isset($_POST['search']) && !empty($_POST['search'])){
  $search = $_POST['search'];
  $sql = "SELECT id, ime, prezime FROM narudzba WHERE ime LIKE '%$search%' OR prezime LIKE '%$search%'";
  $result = mysqli_query($mysqli, $sql);

  if(mysqli_num_rows($result)>0){
    echo "<div class='rezultati'>";
    while($row = mysqli_fetch_assoc($result)) {
      echo "ID: ".$row["id"]. ", Ime: " . $row["ime"]. ", Prezime: " . $row["prezime"]. "<br>";
    }
    echo "</div>";
  }
  else{
    echo "<div class='rezultati'>Nema rezultata.</div>";
  }
  }
  ?>
	</div>
    <h1 align="center">Administrator</h1>
    <h3 align="center">Lista narudžbi:</h3>
    <div class="tabela">
      <table align="center" border="1">
			<tr>
                <th>ID</th>
				<th>Ime</th>
				<th>Prezime</th>
				<th>Broj telefona</th>
				<th>Adresa</th>
				<th>Veličina</th>
				<th>Količina</th>
				<th>Datum dostave</th>
				<th>Vreme dostave</th>
				<th>Plaćanje</th>
				<th>Sir</th>
				<th>Sos</th>
				<th>Sok</th>
				<th>Topping 1</th>
				<th>Topping 2</th>
				<th>Instrukcije</th>
			</tr>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['akcija'])) {
    if ($_POST['akcija'] === 'select') {
        $sql = "SELECT * FROM narudzba";
        $result = mysqli_query($mysqli, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['ime']}</td>
                    <td>{$row['prezime']}</td>
                    <td>{$row['brojTelefona']}</td>
                    <td>{$row['adresa']}</td>
                    <td>{$row['velicina']}</td>
                    <td>{$row['kolicina']}</td>
                    <td>{$row['datumDostave']}</td>
                    <td>{$row['vremeDostave']}</td>
                    <td>{$row['placanje']}</td>
                    <td>{$row['sir']}</td>
                    <td>{$row['sos']}</td>
                    <td>{$row['sok']}</td>
                    <td>{$row['topping']}</td>
                    <td>{$row['topp']}</td>
                    <td>{$row['instrukcije']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='16'>Nema podataka u bazi.</td></tr>";
        }
    }
    elseif ($_POST['akcija'] === 'delete') {
        $sql = "DELETE FROM narudzba";
        if (mysqli_query($mysqli, $sql)) {
            echo "<tr><td colspan='16'>Sve narudžbe su obrisane.</td></tr>";
        } else {
            echo "<tr><td colspan='16'>Greška prilikom brisanja: ".$mysqli->error."</td></tr>";
        }
    }
    elseif ($_POST['akcija'] === 'update') {
        $sql = "UPDATE narudzba SET instrukcije = 'Nema.' WHERE id=1";
        if (mysqli_query($mysqli, $sql)) {
            echo "<tr><td colspan='16'>Prvi red je uspešno ažuriran.</td></tr>";
        } else {
            echo "<tr><td colspan='16'>Greška prilikom ažuriranja: ".$mysqli->error."</td></tr>";
        }
    }
}

$mysqli->close();
?>
      </table>
    </div>
    <div class="dugmad">
        <form method="post">
            <button type="submit" name="akcija" value="select">Prikaži sve narudžbe</button>
            <button type="submit" name="akcija" value="delete">Obriši sve narudžbe</button>
            <button type="button" name="akcija" value="update">Uredi prvu narudžbu</button>
        </form>
    </div>
  </div>
  </body>
</html>