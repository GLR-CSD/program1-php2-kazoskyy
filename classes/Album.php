<?php

class Album
{
    private ?int $ID;
    private string $Naam;
    private ?string $Artiesten;
    private ?string $Release_Datum;
    private ?string $URL;
    private ?string $Afbeelding;
    private ?string $Prijs;

    public function __construct(?int $ID, string $Naam, ?string $Artiesten, ?string $Release_Datum, ?string $URL, ?string $Afbeelding, ?string $Prijs)
    {
        $this->ID = $ID;
        $this->Naam = $Naam;
        $this->Artiesten = $Artiesten;
        $this->Release_Datum = $Release_Datum;
        $this->URL = $URL;
        $this->Afbeelding = $Afbeelding;
        $this->Prijs = $Prijs;
    }

    public function getID(): ?int
    {
        return $this->ID;
    }

    public function getNaam(): string
    {
        return $this->Naam;
    }

    public function getArtiesten(): ?string
    {
        return $this->Artiesten;
    }

    public function getReleaseDatum(): ?string
    {
        return $this->Release_Datum;
    }

    public function getURL(): ?string
    {
        return $this->URL;
    }

    public function getAfbeelding(): ?string
    {
        return $this->Afbeelding;
    }

    public function getPrijs(): ?string
    {
        return $this->Prijs;
    }

    public static function getAll(PDO $db): array
    {
        $stmt = $db->query("SELECT * FROM album");
        $albums = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album = new Album(
                $row['ID'],
                $row['Naam'],
                $row['Artiesten'],
                $row['Release_datum'],
                $row['URL'],
                $row['Afbeelding'],
                $row['Prijs']
            );
            $albums[] = $album;
        }
        return $albums;
    }
}