<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albumlijst</title>
    <link rel="stylesheet" href="public/css/simple.css">
</head>
<body>
<h1>Albumlijst</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Artiesten</th>
        <th>Release Datum</th>
        <th>URL</th>
        <th>Afbeelding</th>
        <th>Prijs</th>
    </tr>
    <?php


    // Toon alle albums
    if (!empty($albums)) {
        foreach ($albums as $album) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($album->getID()) . '</td>';
            echo '<td>' . htmlspecialchars($album->getNaam()) . '</td>';
            echo '<td>' . htmlspecialchars($album->getArtiesten()) . '</td>';
            echo '<td>' . htmlspecialchars($album->getReleaseDatum()) . '</td>';
            echo '<td><a href="' . htmlspecialchars($album->getURL()) . '">' . htmlspecialchars($album->getURL()) . '</a></td>';
            echo '<td>';
            if ($album->getAfbeelding()) {
                echo '<img src="' . htmlspecialchars($album->getAfbeelding()) . '" alt="' . htmlspecialchars($album->getNaam()) . '" style="max-width: 100px;">';
            } else {
                echo '<span>Geen afbeelding beschikbaar</span>';
            }
            echo '</td>';
            echo '<td>€' . htmlspecialchars($album->getPrijs()) . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="7">Er zijn geen albums beschikbaar.</td></tr>';
    }
    ?>
</table>

<div class="notice">
    <h2>Album Toevoegen:</h2>
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div id="responseMessage"></div>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success">Album succesvol toegevoegd!</div>';
    }
    ?>
    <form action="album_toevoegen.php" method="post" id="albumToevoegenForm">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required><br>

        <label for="artiesten">Artiesten:</label>
        <input type="text" id="artiesten" name="artiesten" required><br>

        <label for="release_datum">Release Datum:</label>
        <input type="date" id="release_datum" name="release_datum" required><br>

        <label for="url">URL:</label>
        <input type="url" id="url" name="url" required><br>

        <label for="afbeelding">Afbeelding:</label>
        <input type="text" id="afbeelding" name="afbeelding" required><br>

        <label for="prijs">Prijs:</label>
        <input type="text" id="prijs" name="prijs" required><br>

        <input type="submit" value="Toevoegen" id="submitAlbum">
    </form>
</div>
</body>
</html>