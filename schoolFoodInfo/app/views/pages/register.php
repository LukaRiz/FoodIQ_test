<!DOCTYPE html>
<html lang="en">

<?php require_once "app/views/components/header.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_URL ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= CSS_URL ?>style.css">

    <title>FoodIQ - Registracija</title>
</head>

<body>

    <?php require_once "app/views/pages/menu/navbar.php"; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Registracija novega uporabnika</h3>
        </div>

        <div class="card-body">
            <div style="width:600px; margin:0px auto">
                <?php
                require_once "app/views/components/db/UserDB.php";

                if ($form->validate()) {
                    try {
                        $formData = $form->getValue();

                        $params = [
                            "ime" => $formData["name"],
                            "priimek" => $formData["surname"],
                            "e_posta" => $formData["email"],
                            "geslo" => password_hash($formData["passwd"], PASSWORD_DEFAULT),
                            "telefon" => ($formData["phone"] === "") ? null : $formData["phone"]
                        ];

                        $id = UserDB::insertUser($params);

                        header("Location: users");
                        exit();
                    } catch (PDOException $exc) {
                        echo "<p style='color: red;'>Error when trying to register. Please try again later.</p>";
                    }
                } else {
                    echo $form;
                }
                ?>
            </div>
        </div>
    </div>

    <?php require_once "app/views/components/footer.php"; ?>
</body>

</html>
