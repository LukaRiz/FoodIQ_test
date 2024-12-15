<!DOCTYPE html>
<html lang="en">

<?php require_once "app/views/components/header.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="assets/style3.css">

    <title>FoodIQ - Zgodovina</title>
</head>

<body>
    <div class="recent-orders">
        <h2>Zgodovina</h2>

        <div class="event-container">
            <form id="menuForm">
                <h3>Obstoječi Vnosi</h3>

                <table>
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Jed</th>
                            <th>Kategorija</th>
                            <th>Urejanje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "app/views/components/db/FoodDB.php";

                        $foods = FoodDB::getAllFood();

                        if ($foods) {
                            foreach ($foods as $value) { ?>
                                <tr>
                                    <td style="color: black;"><?= htmlspecialchars($value["datum"]) ?></td>
                                    <td style="color: black;"><?= htmlspecialchars($value["naziv"]) ?></td>
                                    <td style="color: black;"><?= htmlspecialchars($value["kategorija"]) ?></td>
                                    <td style="color: black;"></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="4">Ni vnosov za prikaz.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <?php require_once "app/views/components/footer.php"; ?>
</body>

</html>
