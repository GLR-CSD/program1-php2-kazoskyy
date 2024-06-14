<?php
// Includen van database connectie
try {
    $pdo = new PDO("sqlite:persoon.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

// Variabelen initialiseren
$naam = $artiesten = $release_datum = $url = $afbeelding = $prijs = "";
$errors = array();

// Formulierdata verwerken wanneer het formulier wordt ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Valideren van albumnaam
    if (empty(trim($_POST["naam"]))) {
        $errors['naam'] = "Voer een albumnaam in.";
    } else {
        $naam = trim($_POST["naam"]);
    }

// Valideren van artiesten
    if (empty(trim($_POST["artiesten"]))) {
        $errors['artiesten'] = "Voer artiesten in.";
    } else {
        $artiesten = trim($_POST["artiesten"]);
    }

// Valideren van release datum
    if (empty(trim($_POST["release_datum"]))) {
        $errors['release_datum'] = "Voer een release datum in.";
    } else {
        $release_datum = trim($_POST["release_datum"]);
    }

// Valideren van URL
    if (empty(trim($_POST["url"]))) {
        $errors['url'] = "Voer een URL in.";
    } else {
        $url = trim($_POST["url"]);
    }

// Valideren van afbeelding
    if (empty(trim($_POST["afbeelding"]))) {
        $errors['afbeelding'] = "Voer een afbeelding in.";
    } else {
        $afbeelding = trim($_POST["afbeelding"]);
    }

// Valideren van prijs
    if (empty(trim($_POST["prijs"]))) {
        $errors['prijs'] = "Voer een prijs in.";
    } else {
        $prijs = trim($_POST["prijs"]);
    }

// Valideren van de ingevoerde data en invoegen in database
    if (empty($errors)) {
        $sql = "INSERT INTO album (Naam, Artiesten, Release_datum, URL, Afbeelding, Prijs) VALUES (:naam, :artiesten, :release_datum, :url, :afbeelding, :prijs)";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":naam", $naam);
            $stmt->bindParam(":artiesten", $artiesten);
            $stmt->bindParam(":release_datum", $release_datum);
            $stmt->bindParam(":url", $url);
            $stmt->bindParam(":afbeelding", $afbeelding);
            $stmt->bindParam(":prijs", $prijs);

// Proberen de query uit te voeren
            if ($stmt->execute()) {
// Redirect naar dezelfde pagina na succesvolle invoer
                header("Location: album.php?success=1");
                exit();
            } else {
                $errors[] = "Er is iets fout gegaan. Probeer het later opnieuw.";
            }

// Statement sluiten
            unset($stmt);
        }
    }

// Databaseverbinding sluiten
    unset($pdo);
}

// Verwerk eventuele fouten en geef ze weer op de album_view.php pagina
header("Location: album_view.php?errors=" . urlencode(serialize($errors)));
exit();
?>