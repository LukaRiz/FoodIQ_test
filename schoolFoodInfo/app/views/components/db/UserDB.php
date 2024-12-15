<?php

require_once "app/models/Abstracts/AbstractDB.php";

class UserDB extends AbstractDB {
    /**
     * Retrieve user credentials by email or ID.
     *
     * @param string|int $identifier User's email (string) or ID (int).
     * @return array|false User data as an associative array if found, false otherwise.
     * @throws InvalidArgumentException If the identifier is neither string nor numeric.
     */
    public static function getUserCredentials(string|int $identifier): array|false {
        if (is_string($identifier)) {
            $sql = "SELECT id_uporabnika, ime, priimek, id_vloge, geslo FROM Uporabnik WHERE e_posta = :email";
            $userData = parent::query($sql, ["email" => $identifier]);
        } elseif (is_numeric($identifier)) {
            $sql = "SELECT ime, priimek, id_vloge, geslo FROM Uporabnik WHERE id_uporabnika = :id_uporabnika";
            $userData = parent::query($sql, ["id_uporabnika" => $identifier]);
        } else {
            throw new InvalidArgumentException("Invalid input type. Must be string (email) or numeric (ID).");
        }

        return count($userData) === 1 ? $userData[0] : false;
    }

    /**
     * Check if an email is already registered.
     *
     * @param string $email The email to check.
     * @return bool True if the email is not registered, false otherwise.
     */
    public static function checkEmail(string $email): bool {
        $sql = "SELECT e_posta FROM Uporabnik WHERE e_posta = :email";
        $result = parent::query($sql, ["email" => $email]);

        return empty($result);
    }

    /**
     * Check if a user is active based on their email.
     *
     * @param string $email The email to check.
     * @return bool True if the user is active, false otherwise.
     */
    public static function checkUserStatus(string $email): bool {
        $sql = "SELECT aktiven FROM Uporabnik WHERE e_posta = :email";
        $result = parent::query($sql, ["email" => $email]);

        return !empty($result) && $result[0]["aktiven"] === 1;
    }

    /**
     * Insert a new user into the database.
     *
     * @param array $params Associative array with keys 'ime', 'priimek', 'e_posta', 'geslo', 'telefon'.
     * @return int The ID of the newly inserted user.
     */
    public static function insertUser(array $params): int {
        $sql = "INSERT INTO Uporabnik (ime, priimek, e_posta, geslo, telefon) VALUES (:ime, :priimek, :e_posta, :geslo, :telefon)";
        return parent::modify($sql, $params);
    }

    /**
     * Update a user's details in the database.
     *
     * @param array $params Associative array with keys 'ime', 'priimek', 'telefon', and 'id_uporabnika'.
     * @return int Number of affected rows.
     */
    public static function updateUserDetails(array $params): int {
        $sql = "UPDATE Uporabnik SET ime = :ime, priimek = :priimek, telefon = :telefon, id_vloge = :id_vloge WHERE id_uporabnika = :id_uporabnika";
        return parent::modify($sql, $params);
    }

    /**
     * Update a user's password in the database.
     *
     * @param array $params Associative array with keys 'geslo' and 'id_uporabnika'.
     * @return int Number of affected rows.
     */
    public static function updateUserPassword(array $params): int {
        $sql = "UPDATE Uporabnik SET geslo = :geslo WHERE id_uporabnika = :id_uporabnika";
        return parent::modify($sql, $params);
    }

    /**
     * Retrieve user information by ID.
     *
     * @param int $id The user's ID.
     * @return array|false User data as an associative array if found, false otherwise.
     */
    public static function getUserInfoById(int $id): array|false {
        $sql = "SELECT id_uporabnika, ime, priimek, telefon, e_posta, id_vloge FROM Uporabnik WHERE id_uporabnika = :id";
        $userData = parent::query($sql, ["id" => $id]);

        return count($userData) === 1 ? $userData[0] : false;
    }

    /**
     * Retrieve all users from the database.
     *
     * @return array|false Array of users if found, false otherwise.
     */
    public static function selectAllUsers(): array|false {
        $sql = "SELECT id_uporabnika, ime, priimek, e_posta, id_vloge, uporabnik_ustvarjen, telefon, aktiven FROM Uporabnik";
        $users = parent::query($sql);

        return count($users) >= 1 ? $users : false;
    }

    /**
     * Update a user's active status (activate or deactivate).
     *
     * @param string $action Either "activate" or "deactivate".
     * @param int $id The user's ID.
     * @return int|false Number of affected rows, or false if the action is invalid.
     */
    public static function updateUserStatus(string $action, int $id): int|false {
        if (!in_array($action, ["activate", "deactivate"])) {
            return false;
        }

        $isActive = $action === "activate" ? 1 : 0;

        $sql = "UPDATE Uporabnik SET aktiven = :isActive WHERE id_uporabnika = :id AND id_vloge != 1";
        return parent::modify($sql, ["isActive" => $isActive, "id" => $id]);
    }

    /**
     * Delete a user by ID, except users with the admin role.
     *
     * @param int $id The user's ID.
     * @return int Number of affected rows.
     */
    public static function deleteUser(int $id): int {
        $sql = "DELETE FROM Uporabnik WHERE id_uporabnika = :id AND id_vloge != 1";
        return parent::modify($sql, ["id" => $id]);
    }

    public static function getRoles(): array|false {
        $sql = "SELECT * FROM Vloga";
        $data = parent::query($sql);

        return count($data) >= 1 ? $data : false;
    }
}
