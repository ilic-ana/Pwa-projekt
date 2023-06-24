<!DOCTYPE html>
<html>

<head>
    <title>BBC PWA - Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ana Ilić">
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css" />


    <style>
        .traka{
            background-color:  rgb(195, 195, 42);
            font-size: 24px;
            font-weight: bold;
            padding-left: 24px;
            padding-top: 16px;
            padding-bottom: 16px;
        }

        
    </style>
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

    

    <section class="container" style="padding-top:10%;width:100%;">
        <div class="article" style="width:100%;">
            <?php
            // Spajanje na bazu podataka
            $dbc = mysqli_connect('localhost', 'root', '', 'projekt') or die("Error" . mysqli_connect_error());


            // Provjera je li predan ID članka putem GET metode
            if (isset($_GET['id'])) {
                $articleId = $_GET['id'];

                // Dohvaćanje članka na temelju ID-ja
                $query = "SELECT * FROM articles WHERE id = $articleId";
                $result = mysqli_query($dbc, $query);

               

                // Provjera je li pronađen članak
                if (mysqli_num_rows($result) > 0) {
                    // Prikaz članka
                    $row = mysqli_fetch_assoc($result);
                    $kategorija = $row['kategorija'];
                    $opis = $row['opis'];
                    $naslov = $row['naslov'];
                    $sadrzaj = $row['text'];
                    $slika = $row['slika'];


                    echo "<div class='traka'>" . $kategorija . '</div>';

                    echo '<article class="post" style="width:100%;height:120%;padding-bottom:20%;">';
                    echo '<h2>' . $naslov . '</h2>';
                    echo '<img src="slike/' . $slika . '" />';
                    echo '<h2>' . $opis . '</h2>';
                    echo '<p>' . $sadrzaj . '</p>';
                    echo '</article>';
                } else {
                    echo '<p>Article not found.</p>';
                }
            } else {
                echo '<p>Invalid request.</p>';
            }

            // Zatvaranje konekcije s bazom podataka
            mysqli_close($dbc);
            ?>
        </div>
    </section>

    <footer>
        <div class="container fot">
            <p>Coded by Ana Ilić, 2023</p>
            <p>ailic@tvz.hr</p>
        </div>
    </footer>
</body>

</html>
