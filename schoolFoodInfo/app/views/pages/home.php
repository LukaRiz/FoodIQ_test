<!DOCTYPE html>
<html lang="en">

<?php require_once "app/views/components/header.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= CSS_URL ?>style2.css" />

    <title>FoodIQ</title>
</head>

<body>
    <nav class="nav__bar">
        <div class="nav__header">
            <a href="#">
                <img src="<?= IMAGES_URL . "forcap_zelena_trans.png" ?>" alt="logo" class="logo" />
            </a>
        </div>

        <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-line"></i>
        </div>

        <ul class="nav__links" id="nav-links">
            <li><a href="#">Domov</a></li>
            <li><a href="https://forcapsolutions.com">O nas</a></li>
            <li><a href="https://forcapsolutions.com">Kontakt</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="container__left">
            <div class="container__btn">
                <h1>Prijava v FoodIQ</h1>
                <a href="<?= BASE_URL ?>login" class="btn">Prijava z ForCap ID</a>
            </div>
        </div>

        <div class="container__right">
            <div class="images">
                <img src="<?= IMAGES_URL . "Zelena_verzija.jpg" ?>" alt="tent-1" class="tent-1" />
            </div>

            <div class="content">
                <h2>FoodIQ | Schools Edition</h2>
                <h3>Powered by ForCap poslovne rešitve d.o.o.</h3>
                <p>FoodIQ omogoča natančen pregled porabe hrane v gostinstvih, menzah, cateringih ter šolah ter omogoča napovedne storitve za porabo obrokov.</p>
            </div>
        </div>

        <div class="socials">
            <span>
                <a href="#"><i class="ri-facebook-fill"></i></a>
            </span>
            <span>
                <a href="#"><i class="ri-instagram-line"></i></a>
            </span>
            <span>
                <a href="#"><i class="ri-twitter-fill"></i></a>
            </span>
        </div>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="main.js"></script>
</body>

<?php require_once "app/views/components/footer.php"; ?>

</html>
