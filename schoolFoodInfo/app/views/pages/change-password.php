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
            <h3>Spremenite geslo<span class="float-right"> <a href="profile" class="btn btn-primary">Nazaj</a> </h3>
        </div>

        <div class="card-body">
            <div style="width:600px; margin:0px auto">
                <?php
                require_once "app/views/components/db/UserDB.php";

                if ($form->validate()) {
                    $formData = $form->getValue();

                    $passwordData = [
                        "geslo" => password_hash($formData["newPasswd"], PASSWORD_DEFAULT),
                        "id_uporabnika" => $session->get("user_id")
                    ];

                    UserDB::updateUserPassword($passwordData);

                    header("Location: " . BASE_URL . "users");
                    exit();
                } else {
                    echo $form;
                }?>
            </div>
        </div>
    </div>

    <?php require_once "app/views/components/footer.php"; ?>
</body>

</html>

