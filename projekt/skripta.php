<!DOCTYPE html>
<html>

<head>
    <title>BBC PWA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ana Ilić">
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['naslov'];
    $slika = $_POST['slika'];
    $opis = $_POST['sazetak'];
    $kategorija = $_POST['kategorija'];
    $text = $_POST['tekst'];
    $obavijest = isset($_POST["obavijest"]) ? "Yes" : "No";

    $dbc = mysqli_connect('localhost', 'root', '', 'projekt') or die("Error: " . mysqli_connect_error());

    // Priprema i vezivanje upita za umetanje
    $stmt = $dbc->prepare("INSERT INTO articles (naslov, opis, text, kategorija, slika, prikaz)
        VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $opis, $text, $kategorija, $slika, $obavijest);

    // Izvršavanje upita
    if ($stmt->execute()) {
        echo "Članak uspješno spremljen.";
    } else {
        echo "Pogreška pri spremanju članka: " . $stmt->error;
    }

    // Zatvaranje upita
    $stmt->close();
}
?>

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
                    <a href="indexabout.html" class="nav-link">Administration</a>
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

    <div class="zuto">
        <section class="container">
            <div class="news1">
                <?php echo "<h1>$kategorija</h1>"; ?>
            </div>
        </section>
    </div>

    <section class="container">
        <?php echo "<h1>$title</h1>"; ?>
    </section>

    <section class="container ptica">
        <?php echo "<img src='slike/$slika' />"; ?>
    </section>

    <section class="container">
        <?php echo "<h1>$opis</h1>"; ?>
    </section>

    <article class="container clanak">
        <?php echo "<p>$text</p>"; ?>
    </article>

    <article class="container clanak" style="padding-bottom:20%;">
        <?php echo "<p>$obavijest</p>"; ?>
    </article>

    <footer>
        <div class="container fot">
            <p>Coded by Ana Ilić, 2023</p>
            <p>ailic@tvz.hr</p>
        </div>
    </footer>
</body>

</html>
