<div class="toggle">
    <div class="logo">
        <img src="<?= IMAGES_URL ?>crn_foodiq.png" alt="FoodIQ Logo">
    </div>

    <div class="close" id="close-btn">
        <span class="material-icons-sharp">close</span>
    </div>
</div>

<?php $path = substr($_SERVER["PATH_INFO"], strlen("/dashboard/")); ?>

<div class="sidebar">
    <a href="<?= BASE_URL ?>dashboard" class="<?= $path == "" ? "active" : "" ?>">
        <span class="material-icons-sharp">dashboard</span>
        <h3>Glavna plošča</h3>
    </a>

    <a href="<?= BASE_URL ?>users">
        <span class="material-icons-sharp">person_outline</span>
        <h3>Uporabniki</h3>
    </a>

    <a href="<?= BASE_URL ?>dashboard/history" class="<?= $path == "history" ? "active" : "" ?>">
        <span class="material-icons-sharp">receipt_long</span>
        <h3>Zgodovina</h3>
    </a>

    <a href="#">
        <span class="material-icons-sharp">insights</span>
        <h3>Analize</h3>
    </a>

    <a href="#">
        <span class="material-icons-sharp">settings</span>
        <h3>Nastavitve</h3>
    </a>

    <a href="<?= BASE_URL ?>logout">
        <span class="material-icons-sharp">logout</span>
        <h3>Odjava</h3>
    </a>
</div>
