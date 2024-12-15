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
                <?php
                require_once "app/views/components/db/UserDB.php";

                if ($form->validate()) {
                    $formData = $form->getValue();

                    $data = [
                        "ime" => $formData["name"],
                        "priimek" => $formData["surname"],
                        "telefon" => $formData["phone"],
                        "id_vloge" => $formData["role"] ?? $session->get("role_id"),
                        "id_uporabnika" => $id
                    ];

                    UserDB::updateUserDetails($data);

                    if ($id == $session->get("user_id")) {
                        $credentials = UserDB::getUserCredentials($id);
                        $session->set("fullName", $credentials["ime"] . " " . $credentials["priimek"]);
                    }

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

