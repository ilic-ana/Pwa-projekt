<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $id_to_delete = $_POST['id'];

        // Provjera korisnika u bazi podataka
        $dbc = mysqli_connect('localhost', 'root', '', 'projekt') or die("Error" . mysqli_connect_error());

        // Priprema i vezivanje upita za brisanje naslova
        $stmt_delete = $dbc->prepare("DELETE FROM articles WHERE id = ?");
        $stmt_delete->bind_param("i", $id_to_delete);

        // Izvršavanje upita za brisanje
        if ($stmt_delete->execute()) {
            echo "Naslov je uspješno izbrisan.";
        } else {
            echo "Došlo je do greške prilikom brisanja naslova.";
        }

        // Zatvaranje upita za brisanje
        $stmt_delete->close();

        // Zatvaranje veze s bazom podataka
        $dbc->close();
    }
    elseif (isset($_POST['edit']) && isset($_POST['id'])) {
        $id_to_edit = $_POST['id'];
        // Preusmjeri korisnika na stranicu za uređivanje članka
        header("Location: uredivanje.php?id=".$id_to_edit);
        exit();
    }
}
?>

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
        .container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .container th,
        .container td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .container th {
            background-color: #f2f2f2;
        }

        .delete-btn,
        .edit-btn {
           
            color: #fff;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }

        .delete-btn {
            background-color: #ff0000;
        }
        .edit-btn{
            background-color: green;
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
    <div class="container" style="padding-top:10%;padding-left:24px;">
        <?php
        $dbc = mysqli_connect('localhost', 'root', '', 'projekt') or die("Error" . mysqli_connect_error());

        $query2 = "SELECT * FROM articles";
        $result2 = mysqli_query($dbc, $query2);

        if (mysqli_num_rows($result2) > 0) {
            // Prikaz vijesti
            echo "<table class='container' style='padding-bottom:20%;'>";
            echo "<tr>";
            echo "<th>Article</th>";
            echo "<th></th>"; // Dodajte prazan zaglavlje za gumb za brisanje
            echo "<th></th>"; // Dodajte prazan zaglavlje za gumb za uređivanje
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result2)) {
                $naslov = $row['naslov'];
                $id = $row['id'];
                echo "<tr>";
                echo
                "<td>".$naslov."</td>";
                echo "<td>";
                echo '<form method="post" action="administracija2.php">';
                echo '<input type="hidden" name="id" value="' . $id . '">';
                echo '<button type="submit" name="delete" class="delete-btn">Delete</button>';
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo '<form method="post" action="administracija2.php">';
                echo '<input type="hidden" name="id" value="' . $id . '">';
                echo '<button type="submit" name="edit" class="edit-btn">Edit</button>';
                echo "</form>";
                echo "</td>";
                echo "</tr>";
                }
                echo "</table>";
                }
                    // Zatvaranje upita za prikaz vijesti
    mysqli_free_result($result2);

    // Zatvaranje veze s bazom podataka
    $dbc->close();
    ?>
</div>
<footer>
    <div class="container fot">
        <p>Coded by Ana Ilić, 2023</p>
        <p>ailic@tvz.hr</p>
    </div>
</footer>
</body>
</html>