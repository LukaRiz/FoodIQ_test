<?php

require_once "app/models/Abstracts/AbstractDB.php";

class FoodDB extends AbstractDB {
    /**
     * Retrieve all food data including menu date, dish name, and category.
     *
     * @return array|false Array of food data if found, false otherwise.
     */
    public static function getAllFood(): array|false {
        $sql = "SELECT Meni.datum AS datum, Jed.naziv_jedi AS naziv, Kategorija.naziv_kategorije AS kategorija
                FROM Meni
                INNER JOIN Meni_Jed ON Meni.id_menija = Meni_Jed.id_menija
                INNER JOIN Jed ON Jed.id_jedi = Meni_Jed.id_jedi
                INNER JOIN Kategorija ON Jed.id_kategorije = Kategorija.id_kategorije";

        $foodData = parent::query($sql);

        return count($foodData) >= 1 ? $foodData : false;
    }

    /**
     * Retrieve all categories from the database.
     *
     * @return array|false Array of categories if found, false otherwise.
     */
    public static function getCategories(): array|false {
        $sql = "SELECT * FROM Kategorija";
        $data = parent::query($sql);

        return count($data) >= 1 ? $data : false;
    }

    /**
     * Insert a new dish into the database.
     *
     * @param array $params Associative array containing 'naziv_jedi' and 'id_kategorije'.
     * @return int The ID of the newly inserted record.
     */
    public static function insertDataJed(array $params): int {
        $sql = "INSERT INTO Jed (naziv_jedi, id_kategorije) VALUES (:naziv_jedi, :id_kategorije)";
        return parent::modify($sql, $params);
    }

    /**
     * Insert attendance data into the database.
     *
     * @param array $params Associative array containing 'prijavljeni_otroci', 'poskenirani_otroci', and 'opombe'.
     * @return int The ID of the newly inserted record.
     */
    public static function insertDataPrisotnost(array $params): int {
        $sql = "INSERT INTO Prisotnost (id_menija, datum, prijavljeni_otroci, poskenirani_otroci, opombe) VALUES (1, :datum, :prijavljeni_otroci, :poskenirani_otroci, :opombe)";
        return parent::modify($sql, $params);
    }

    /**
     * Insert menu-dish data into the database.
     *
     * @param array $params Associative array containing 'id_jedi', 'kolicina_kuhana', and 'kolicina_nepostrezena'.
     * @return int The ID of the newly inserted record.
     */
    public static function insertDataMeniJed(array $params): int {
        $sql = "INSERT INTO Meni_Jed (id_jedi, id_menija, kolicina_kuhana, kolicina_nepostrezena) VALUES (:id_jedi, 1, :kolicina_kuhana, :kolicina_nepostrezena)";
        return parent::modify($sql, $params);
    }
}
