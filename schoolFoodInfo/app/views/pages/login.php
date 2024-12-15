<!DOCTYPE html>
<html lang="en">

<?php require_once "app/views/components/header.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= CSS_URL ?>style2.css" />

    <title>FoodIQ - Prijava</title>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">
                <i class="fas fa-sign-in-alt mr-2"></i>Prijava uporabnika
            </h3>
        </div>

        <div class="card-body">
            <div style="width:450px; margin:0px auto">
                <?php
                require_once "app/views/components/db/UserDB.php";

                if ($form->validate()) {
                    try {
                        $formData = $form->getValue();
                        $credentials = UserDB::getUserCredentials($formData["email"]);

                        if ($credentials && password_verify($formData["passwd"], $credentials["geslo"])) {
                            $session->set("login", true);
                            $session->set("fullName", $credentials["ime"] . " " . $credentials["priimek"]);
                            $session->set("role_id", $credentials["id_vloge"]);
                            $session->set("user_id", $credentials["id_uporabnika"]);

                            header("Location: dashboard");
                            exit();
                        } else {
                            echo $form;
                            echo "<p style='color: red; font-weight: bold;'>Error when trying to login</p>";
                        }
                    } catch (PDOException $exc) {
                        echo "<p style='color: red;'>Error when trying to login. Please try again later.</p>";
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
