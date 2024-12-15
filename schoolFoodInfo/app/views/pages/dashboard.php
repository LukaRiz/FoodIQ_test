<!DOCTYPE html>
<html lang="en">

<?php require_once "app/views/components/header.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_URL ?>style3.css">

    <title>FoodIQ - Dashboard</title>
</head>

<body>
    <div class="container">
        <aside>
            <?php require_once "menu/sidebar-left.php"; ?>
        </aside>

        <main>
            <?php require_once $fileName; ?>
        </main>

        <div class="right-section">
            <?php require_once "menu/sidebar-right.php"; ?>
        </div>
    </div>

    <script src="<?= SCRIPT_URL ?>index.js"></script>
</body>

</html>
