<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<link rel="icon" href="icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE PIZZA COMPANY-pocetna</title>
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
    .sadrzajIndex{
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    height: 60%;
    padding-top: 2px;
    }
    .oNama{
    width: 100%;
    padding-bottom: 55px;
    margin-bottom: 2px;
    background-image: url('background.jpg');
    background-size: cover;
    }
    .text-video{
    text-align: center;
    color: #fff;
    }
    .slajder{
    margin: auto;
    overflow: hidden;
    }
    .slajder-slike {
    display: flex;
    transition: transform 0.5s ease;
    }
    .slika {
    flex: 0 0 auto;
    width: 100%;
    }
    .slika img{
    width: 1240px;
    height: 600px;
    }
    footer{
    display: flex;
    justify-content: center;
    width: 100%;
    height: 5%;
    background: #5a5959;
    }
    footer p{
    width: 100%;
    font-size: 12px;
    color: #292929;
    font-style: italic;
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
  <div class="sadrzajIndex">
      <div class="oNama">
        <div class="text-video">
        <?php
        $text1='ODLIČAN UKUS,';
        $text2='TOP KVALITET!';
        $text3='Vaša THE PIZZA KOMPANY';
        echo '<h1>' . $text1 .'<br>' . $text2 .'</h1><i>' . $text3 .'</i>';
        echo '<br><br>';
        $video_src="video.mp4";
        ?>
        <iframe width="560" height="315" src="<?php echo $video_src ?>" 
        frameborder="1" allow="accelerometer; autoplay; clipboard-write; 
        encrypted-media; gyroscope; picture-in-picture; web-share" 
        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div> 
      </div>
      <div class="slajder">
      <div class="slajder-slike">
            <?php
            $slike = array("slika1.jpg", "slika2.jpg", "slika3.jpg","slika4.jpg");
            foreach ($slike as $slika) {
                echo '<div class="slika"><img src="' . $slika . '"></div>';
            }
            ?>
        </div>
      <script>
      var trenutniSlajd = 0;
      var slajdovi = document.querySelectorAll('.slika');
      var brojSlajdova = slajdovi.length;
      function prikaziSledeciSlajd() {
          slajdovi[trenutniSlajd].style.display = 'none';
          trenutniSlajd = (trenutniSlajd + 1) % brojSlajdova;
          slajdovi[trenutniSlajd].style.display = 'block';
      }
      setInterval(prikaziSledeciSlajd, 3000);
      </script>
      </div>
  </div>
  <footer>
  <?php
  $counter_file = "brojac.txt";
  $counter = file_get_contents($counter_file);
  $counter++;
  file_put_contents($counter_file, $counter);
  $ispis="Broj poseta je: ";
  ?>
  <p><?php echo '<marquee direction="left" scrollamount="10">'.$ispis.$counter.'</marquee>' ?></p>
  </footer>
  </body>
  </html>