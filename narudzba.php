<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<link rel="icon" href="icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE PIZZA COMPANY-narudzba</title>
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
	.sadrzajNarudzba{
	background-image: url('backgroundN.jpg');
	background-size: contain;
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	width: 100%;
	height: 65%;
	margin-top: 2px;
	padding-bottom: 10px;
	color: #fff;
	}
	.sadrzajNarudzba h1 i{
	color: red;
	}
	table tr td h3{
	color: red;
	}
	.forma{
	width: 80%;
	margin: auto;
	}
	.forma form .dugmad{
	display: flex;
	align-items: baseline;
	justify-content: center;
	}
	.forma form legend{
	color: red;
	}
	.forma form .dugmad #dugme{
	background: red;
	color: #fff;
	font-size: 17px;
	padding: 5px;
	}
	.forma form .dugmad #dugme:nth-child(1){
	margin-right: 20px;
	}
	#slikaVreme{
	position: relative;
	left: 540px;
	width: 71px;
	height: 71px;
	}
	#vreme{
	position: relative;
	left: 540px;
	width: 60px;
	height: 60px;
	border: 1px solid red;
	background: #ff000055;
	border-radius: 50px;
	padding-bottom: 10px;
	padding-left: 5px;
	padding-right: 5px;
	}
	#sati{
	font-size: 12px;
	text-align: center;
	}
	#datum{
	font-size: 10px;
	text-align: center;
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
    <div class="sadrzajNarudzba">
	<h1 align="center">Kreirajte porudžbinu za Vašu unikatnu <i>PIZZU</i></h1>
	<br>
	<h2 align="center">Vrste:</h2>
	<table align="center" >
		<?php
		echo '<tr>';
			echo '<td valign="bottom"><img src="small.png" width=100 height=100></td>';
			echo '<td valign="bottom"><img src="small.png" width=150 height=150></td>';
			echo '<td valign="bottom"><img src="small.png" width=200 height=200></td>';
			echo '<td valign="bottom"><img src="small.png" width=250 height=250></td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td><h3 align="center">Mala Pizza</h3></td>';
			echo '<td><h3 align="center">Srednja Pizza</h3></td>';
			echo '<td><h3 align="center">Velika Pizza</h3></td>';
			echo '<td><h3 align="center">Porodična Pizza</h3></td>';
		echo '</tr>';
		?>
	</table>
	<div class="forma">
		<form action="connection.php" method="post" enctype="multipart/form-data">
			<fieldset>
			<legend>Lični podaci</legend>
			<label>Ime:</label> <input type="text" id="ime" name="ime" size=25 required>
			<label>Prezime:</label> <input type="text" id="prezime" name="prezime" size=25 required>
			<label>Broj telefona:</label> <input type="text" id="brojTelefona" name="brojTelefona" size=25 required><br><br>
		    <label>Adresa:</label> <input type="text" id="adresa" name="adresa" size=60 required>
			</fieldset>
			<fieldset>
			<legend>Detalji narudžbe</legend>
			<select name="velicina" id="velicina" required>
				<option>Označite veličinu pizze</option>
				<option value="mala">Mala</option>
				<option value="srednja">Srednja</option>
				<option value="velika">Velika</option>
				<option value="porodicna">Porodična</option>
			</select>
			<select name="kolicina" id="kolicina" required>
			    <option >Količina</option>
				<option value="1">1</option>
				<option value="2">2</option>
			    <option value="3">3</option>
			    <option value="4">4</option>
			</select>
		    <label>Datum dostave:</label><input type="date" name="datumDostave" id="datumDostave" required>
			<label>Vreme dostave:</label><input type="time" name="vremeDostave" id="vremeDostave" required>
			<select name="placanje" id="placanje" required>
				<option>Označite način plaćanja</option>
				<option value="pouzecem">Pouzećem</option>
				<option value="paypal">Paypal</option>
				<option value="kartica">Bankovnim računom</option>
			</select>
			</fieldset>
			<fieldset>
			<legend>Sirevi</legend>
			<input type="radio" name="sir" id="Mozzarella" value="Mozzarella" required>Mozzarella
			<input type="radio" name="sir" id="Gauda" value="Gauda">Gauda
			<input type="radio" name="sir" id="Feta" value="Feta">Feta
			<input type="radio" name="sir" id="Trapist" value="Trapist">Trapist
			<input type="radio" name="sir" id="Cheddar" value="Cheddar">Cheddar
			<input type="radio" name="sir" id="Parmezan" value="Parmezan">Parmezan
			</fieldset>
			<fieldset>
			<legend>Sosevi</legend>
			<input type="radio" name="sos" id="Kecap" value="Kecap" required>Kečap
			<input type="radio" name="sos" id="BBQ" value="BBQ">BBQ
			<input type="radio" name="sos" id="BeliLuk" value="BeliLuk">Beli luk
			<input type="radio" name="sos" id="Pesto" value="Pesto">Pesto
			<input type="radio" name="sos" id="Majonez" value="Majonez">Majonez
			<input type="radio" name="sos" id="LjutiKecap" value="LjutiKecap">Ljuti kečap
			<input type="radio" name="sos" id="Pavlaka" value="Pavlaka">Pavlaka
		    </fieldset>
		    <fieldset>
			<legend>Sok</legend>
			<input type="radio" name="sok" id="CocaCola" value="CocaCola" required>Coca Cola
			<input type="radio" name="sok" id="Pepsi" value="Pepsi">Pepsi
			<input type="radio" name="sok" id="7UP" value="7UP">7UP
		    <input type="radio" name="sok" id="Mirinda" value="Mirinda">Mirinda
			<input type="radio" name="sok" id="Fanta" value="Fanta">Fanta
			<input type="radio" name="sok" id="NextNarandza" value="NextNarandza">Next Narandža
			<input type="radio" name="sok" id="Sprite" value="Sprite">Sprite <br>
			</fieldset>
			<fieldset>
			<legend>Označite toping (osnova)</legend>
			<input type="radio" name="topping" id="Kulen" value="Kulen" required>Kulen
			<input type="radio" name="topping" id="Salama" value="Salama">Salama
			<input type="radio" name="topping" id="Kobasica" value="Kobasica">Kobasica
			<input type="radio" name="topping" id="SuviVrat" value="SuviVrat">Suvi vrat
			<input type="radio" name="topping" id="Prsuta" value="Prsuta">Pršuta
			</fieldset>
			<fieldset>
			<legend>Označite toping dodatak</legend>
			<input type="radio" name="topp" id="Rukola" value="Rukola" required>Rukola
			<input type="radio" name="topp" id="BeliLuk" value="BeliLuk">Beli luk
			<input type="radio" name="topp" id="Brokoli" value="Brokoli">Brokoli
			<input type="radio" name="topp" id="Masline" value="Masline">Masline
			<input type="radio" name="topp" id="Paprika" value="Paprika">Paprika
			<input type="radio" name="topp" id="Pecurke" value="Pecurke">Pečurke
			<input type="radio" name="topp" id="Luk" value="Luk">Luk
			</fieldset>
			<fieldset>
			<legend>Posebne instrukcije</legend>
			<textarea name="instrukcije" id="instrukcije" rows="3" cols="42"></textarea>
			</fieldset>
			<br>
			<div class="dugmad">
			<input type="submit" value="Naruči" id="dugme">
			<input type="reset" value="Počni ponovo" id="dugme">
		    </div>
	    </form>
    </div>
	<img src="sat.png" id="slikaVreme" onclick="ispisi()">
	<div id="vreme" style="display: none;" onclick="skloni()">
	<p id="sati"></p>
	<p id="datum"></p>
	<script>
		var slikaVreme=document.getElementById("slikaVreme");
		var vreme=document.getElementById("vreme");
		function ispisi(){
			slikaVreme.style.display="none";
			vreme.style.display="block";
			ispisVremena();
		}
		function skloni() {
			vreme.style.display="none";
			slikaVreme.style.display="block";
		}
		function ispisVremena(){
			var vreme=new Date();
			var sati=document.getElementById('sati');
			var datum=document.getElementById('datum');
			sati.innerHTML=vreme.toLocaleTimeString();
			datum.innerHTML=vreme.toDateString();
		}
		setInterval(vreme, 1000);
	</script>
	</div>
	</div>
</body>
</html>