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


    <section class="container">
        <div class="wel">
            <h1>Welcome to BBC News </h1>
        </div>
    </section>

    <section class="container">
        <div class="news">
            <h1 class="red">News </h1>
        </div>
    </section>


    <section class="container vijesti" style="height: 150%;">
        <?php
        // Spajanje na bazu podataka
        $dbc = mysqli_connect('localhost', 'root', '', 'projekt') or die("Error" . mysqli_connect_error());
    
        // Dohvaćanje svih vijesti koje nisu arhivirane
        $query = "SELECT * FROM articles WHERE prikaz='Yes' AND kategorija = 'News'";
        $result = mysqli_query($dbc, $query);
    
        // Provjera jesu li pronađene vijesti
        if (mysqli_num_rows($result) > 0) {
            // Prikaz vijesti
            while ($row = mysqli_fetch_assoc($result)) {
                $kategorija = $row['kategorija'];
                $naslov = $row['naslov'];
                $sazetak = $row['opis'];
                $slika = $row['slika'];
                $link = "vijest.php?id=" . $row['id'];
    
                echo '<article class="post">';
                echo '<a href="' . $link . '">';
                echo '<img src="slike/' . $slika . '" />';
                echo '<h2>' . $naslov . '</h2>';
                echo '<p>' . $sazetak . '</p>';
                echo '</a>';
                echo '</article>';
            }
        } else {
            echo '<p>No news found.</p>';
        }
    
       
    ?>

    </section>

    <section class="container">
        <div class="news">
            <h1 class="yellow">Sport </h1>
        </div>
    </section>

    <section class="container vijesti" style="height: 200%;padding-bottom:15%;">
        <?php

        $query2 = "SELECT * FROM articles WHERE prikaz='Yes' AND kategorija = 'Sport'";
        $result2 = mysqli_query($dbc, $query2);
    
        // Provjera jesu li pronađene vijesti
        if (mysqli_num_rows($result2) > 0) {
            // Prikaz vijesti
            while ($row = mysqli_fetch_assoc($result2)) {
                $kategorija = $row['kategorija'];
                $naslov = $row['naslov'];
                $sazetak = $row['opis'];
                $slika = $row['slika'];
                $link = "vijest.php?id=" . $row['id'];
    
                echo '<article class="post">';
                echo '<a href="' . $link . '">';
                echo '<img src="slike/' . $slika . '" />';
                echo '<h2>' . $naslov . '</h2>';
                echo '<p style="font-size:20px;line-height:28px;">' . $sazetak . '</p>';
                echo '</a>';
                echo '</article>';
            }
        } else {
            echo '<p>No news found.</p>';
        }
    
        // Zatvaranje konekcije s bazom podataka
        mysqli_close($dbc);
        ?>

    </section>






    <footer>
        <div class="container fot">
            <p>Coded by Ana Ilić, 2023</p>
            <p>ailic@tvz.hr</p>
        </div>
    </footer>
</body>

</html>