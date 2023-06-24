<!DOCTYPE html>
<html>

<head>
    <title>BBC PWA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ana Ilić">
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css" />

    <style>
      .prijava {
        color: #fff;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
            margin-top: 16px;
            background-color: green;
            font-size: 20px;
      }

      .label{
        margin-top: 16px;
      }
    </style>

</head>

<body>
    <header>
        <div class="container nav-bar">
            <a href="index.php" class="logo"><img src="slike/BBC_Logo_2021.svg.png" style="width: 100px; background-color: white;" /></a>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="news.php" class="nav-link">News</a>
                </li>

                <li class="nav-item">
                    <a href="sports.php" class="nav-link">Sport</a>
                </li>
                <li class="nav-item">
                    <a href="administracija.php" class="nav-link">Administration</a>
                </li>

                <li class="nav-item">
                    <a href="unos.html" class="nav-link">Add</a>
                </li>
            </ul>

            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </header>

    <section class="container" style="padding-top:10%;">
        <form method="POST">
            <label for="korisnicko_ime">Korisničko ime:</label>
            <br>
            <input type="text" id="korisnicko_ime" name="korisnicko_ime" required>
            <br>
            <br>
            <label for="lozinka" >Lozinka:</label>
            <br>
            <input type="password" id="lozinka" name="lozinka" required>
            <br>
            <input type="submit" value="Prijavi se" class="prijava">
        </form>
    </section>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Dohvaćanje unesenih vrijednosti iz forme
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $lozinka = $_POST['lozinka'];

        // Provjera kor
        // Provjera korisnika u bazi podataka
        $dbc = mysqli_connect('localhost', 'root', '', 'projekt') or die("Error" . mysqli_connect_error());

        // Priprema i vezivanje upita za provjeru korisnika
        $stmt = $dbc->prepare("SELECT korIme FROM korisnik WHERE korIme = ? AND lozinka = ?");
        $stmt->bind_param("ss", $korisnicko_ime, $lozinka);

        // Izvršavanje upita
        $stmt->execute();

        // Povezivanje rezultata
        $stmt->bind_result($rezultat);

        // Provjera postoji li korisnik u bazi
        if ($stmt->fetch()) {
            // Preusmjeravanje na administracija2.php
            header("Location: administracija2.php");
            exit();
        } else {
            echo "Niste registrirani. Molimo, registrirajte se na sljedećem linku: <a href='registracija.php'>Registracija</a>";
        }

        // Zatvaranje upita
        $stmt->close();
        $dbc->close();
    }
    ?>
    
    <footer>
        <div class="container fot">
            <p>Coded by Ana Ilić, 2023</p>
            <p>ailic@tvz.hr</p>
        </div>
    </footer>
</body>

</html>

    
        
        