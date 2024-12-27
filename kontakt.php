<?php
class Korisnik {
    public $ime;
    public $prezime;
    public $email;
    public $poruka;

    public function __construct($ime,$prezime, $email, $poruka) {
        $this->ime = $ime;
        $this->prezime=$prezime;
        $this->email = $email;
        $this->poruka = $poruka;
    }

    public function validacijaPodataka() {
        if (!ctype_alpha($this->ime)) {
            echo"Ime može sadržavati samo slova. ";
        }
        else{echo "Ime sadrži samo slova. ";}
        if (!ctype_alpha($this->prezime)) {
            echo"Prezime može sadržavati samo slova. ";
        }
        else{echo "Prezime sadrži samo slova. ";}
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            echo "Email adresa nije validna. ";
        }
        else{echo "Email adresa je validna. ";}
        if (!ctype_print($this->poruka)) {
            echo "Poruka nije printabilna. ";
        }
        else{echo "Poruka je printabilna. ";}
        return true;
    }
}
class Baza {
    private $mysqli;
    private $pdo;

    public function __construct() {
        $this->mysqli = new mysqli("localhost", "root", "", "baza");
        if ($this->mysqli->connect_error) {
            echo "Greška pri spajanju sa bazom (mysqli): " . $this->mysqli->connect_error;
        }
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=baza;charset=utf8", "root", "");
            echo "Uspešno spajanje sa bazom (pdo)";
            
        } 
        catch (PDOException $e) {
            echo "Greška pri spajanju sa bazom (pdo): " . $e->getMessage();
        }
    }

    public function sacuvajKorisnikaMysqli($korisnik) {
        $stmt = $this->mysqli->prepare("INSERT INTO korisnik (ime, prezime, email, poruka) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $korisnik->ime, $korisnik->prezime, $korisnik->email, $korisnik->poruka);
        if (!$stmt->execute()) {
            echo "Greška pri unosu korisnika (mysqli): " . $stmt->error;
        }
        $stmt->close();
    }

    public function sacuvajKorisnikaPdo($korisnik) {
        $stmt = $this->pdo->prepare("INSERT INTO korisnik (ime, prezime, email, poruka) VALUES (:ime, :prezime, :email, :poruka)");
        $stmt->bindParam(':ime', $korisnik->ime);
        $stmt->bindParam(':prezime', $korisnik->prezime);
        $stmt->bindParam(':email', $korisnik->email);
        $stmt->bindParam(':poruka', $korisnik->poruka);
        if (!$stmt->execute()) {
            echo "Greška pri unosu kontakta (pdo).";
        }
    }

    public function pokreniTransakcije($korisnik) {

        $this->mysqli->begin_transaction();
        try {
            $this->sacuvajKorisnikaMysqli($korisnik);
            $this->mysqli->commit();
        } 
        catch (Exception $e) {
            $this->mysqli->rollback();
            echo "Greška pri izvršavanju transakcije (mysqli): " . $e->getMessage();
        }

        $this->pdo->beginTransaction();
        try {
            $this->sacuvajKorisnikaPdo($korisnik);
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo "Greška pri izvršavanju transakcije (pdo): " . $e->getMessage();
        }
    }
}
$ispis = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime = $_POST['ime'] ?? '';
    $prezime = $_POST['prezime'] ?? '';
    $email = $_POST['email'] ?? '';
    $poruka = $_POST['poruka'] ?? '';

    try {
        $korisnik = new Korisnik($ime, $prezime, $email, $poruka);
        $korisnik->validacijaPodataka();

        $baza = new Baza();
        $baza->pokreniTransakcije($korisnik);

        $ispis = "Korisnik je uspešno sačuvan!";
    } catch (Exception $e) {
        $ispis = "Greška: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<link rel="icon" href="icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE PIZZA COMPANY-kontakt</title>
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
	.sadrzajKontakt{
	background-image: url('backgroundN.jpg');
	background-size: contain;
	display: flex;
	flex-direction: column;
    align-items: center;
	width: 100%;
	height: 500px;
	margin-top: 2px;
	padding-top: 5px;
	padding-bottom: 60px;
	color: #fff;
	}
    .sadrzajKontakt form{
    margin-top: 20px;
    padding: 40px;
    border: 1px solid black;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.3);
    color: black;
    }
    form button{
    margin-left: 90px;
    margin-top: 10px;
    padding: 5px;
    background: red;
    color: white;
    font-size: 16px;
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
  <div class="sadrzajKontakt">
  <h1>Kontaktirajte nas</h1>
<form method="POST">
    <label for="ime">Ime:</label>
    <input id="ime" type="text" name="ime" required>
    <br><br>
    <label for="prezime">Prezime:</label>
    <input id="prezime" type="text" name="prezime" required>
    <br><br>
    <label for="email">Email:</label>
    <input id="email" type="email" name="email" required>
    <br><br>
    <label for="poruka">Poruka:</label>
    <textarea id="poruka" name="poruka" required></textarea>
    <br><br>
    <button type="submit">Pošalji</button>
</form>
<div class="ispis">
    <p><?php echo htmlspecialchars($ispis); ?></p>
</div>
</body>
</html>
