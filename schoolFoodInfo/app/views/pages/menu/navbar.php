<nav class="navbar navbar-expand-md" style="background-color: #ffffff; color: white;">
    <a class="navbar-brand" href="index.php">
        <img src="<?= IMAGES_URL ?>crn_foodiq.png" alt="Logo" style="height: 40px;">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="dashboard"><i class="fas fa-users mr-2"></i>Vstop v FoodIQ</span></a>
            </li>

            <?php if ($session->get("role_id") == "1") { ?>
            <li class="nav-item">
                <a class="nav-link" href="register"><i class="fas fa-user mr-2"></i>Dodaj uporabnika </span></a>
            </li>
            <?php  } ?>

            <li class="nav-item">
                <a class="nav-link" href="view-profile"><i class="fas fa-user mr-2"></i>Profil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout"><i class="fas fa-sign-out-alt mr-2"></i>Odjava</a>
            </li>
        </ul>
    </div>
</nav>
