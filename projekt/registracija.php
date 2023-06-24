

<!DOCTYPE html>
<html>

<head>
    <title>BBC PWA - News</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ana Ilić">
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<header>
        <div class="container nav-bar">
            <a href="index.php" class="logo"><img src="slike/BBC_Logo_2021.svg.png"
                    style="width: 100px; background-color: white;" /></a>

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
    <script src="script.js"></script>


<section class="container" style="padding-top: 5%;">
    
    <form action="registracija.php" method="POST">
        <h3>Registracija korisnika</h3>
        <br>
        <label for="korisnicko_ime">Korisničko ime:</label>
        <br>
        <input type="text" name="korisnicko_ime" required><br>
        <br>
       
        <label for="ime">Ime:</label>
        <br>
        <input type="text" name="ime" required><br>
        <br>
       
        <label for="prezime">Prezime:</label> <br>
        <input type="text" name="prezime" required><br>
        <br>
        <label for="lozinka">Lozinka:</label> <br>
        <input type="password" name="lozinka" required><br>
        <br>
        <label for="lozinka2">Potvrdi lozinku:</label> <br>
        <input type="password" name="lozinka2" required><br>
        <br>
        <input type="submit" value="Registriraj se">
    </form>
</section>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dohvaćanje unesenih vrijednosti iz forme
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $lozinka = $_POST['lozinka'];
    $lozinka2 = $_POST['lozinka2'];

    // Provjera je li unesene lozinke podudaraju
    if ($lozinka === $lozinka2) {
        // Hashiranje lozinke
        //$hash_lozinka = password_hash($lozinka, PASSWORD_DEFAULT);

        // Spremanje korisnika u bazu podataka
        $dbc = mysqli_connect('localhost', 'root', '', 'projekt') or die("Error" . mysqli_connect_error());

        // Priprema i vezivanje upita za umetanje korisnika
        $stmt = $dbc->prepare("INSERT INTO korisnik (korIme, ime, prezime, lozinka, razina) VALUES (?, ?, ?, ?, 1)");
        $stmt->bind_param("ssss", $korisnicko_ime, $ime, $prezime, $lozinka);

        // Izvršavanje upita
        if ($stmt->execute()) {
            echo "Registracija uspješna.";
        } else {
            echo "Pogreška pri registraciji: " . $stmt->error;
        }

        // Zatvaranje upita
        $stmt->close();
        $dbc->close();
    } else {
        echo "Lozinke se ne podudaraju.";
    }
}
?>


<footer>
    <div class="container fot">
        <p>Coded by Ana Ilić, 2023</p>
        <p>ailic@tvz.hr</p>
    </div>
</footer>
</body>