<!DOCTYPE html>
<html lang="en">

<?php require_once "app/views/components/header.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_URL ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= CSS_URL ?>style.css">

    <title>FoodIQ - Uporabniški Profil</title>
</head>

<body>

    <?php require_once "app/views/pages/menu/navbar.php"; ?>

    <div class="card">
        <div class="card-header">
            <h3><span style="margin-left: 550px;">Uporabniški profil</span> <span class="float-right"> <a href="users" class="btn btn-primary">Nazaj</a></span></h3>
        </div>

        <div class="card-body">
            <div style="width:600px; margin:0px auto">
                <div class="form-group">
                    <p><strong>Ime: </strong><?= $name; ?></p>
                </div>
                <div class="form-group">
                    <p><strong>Priimek: </strong><?= $surname; ?></p>
                </div>
                <div class="form-group">
                    <p><strong>E-naslov: </strong><?= $email; ?></p>
                </div>
                <div class="form-group">
                    <p><strong>Telefon: </strong><?= $phone; ?></p>
                </div>
                <div class="form-group">
                    <p><strong>Vloga: </strong>
                    <?php
                    require_once "app/views/components/db/UserDB.php";
                    $roles = UserDB::getRoles();
                    echo $roles[$role - 1]["naziv_vloge"];
                    ?>
                    </p>
                </div>
                <a href="profile?id=<?= $id; ?>" class="btn btn-primary">Uredi Profil</a>
            </div>
        </div>
    </div>

    <?php require_once "app/views/components/footer.php"; ?>
</body>

</html>

