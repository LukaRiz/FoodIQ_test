<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>FoodIQ login</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="login.php" method="post">
                    <h2>FoodIQ Prijava</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <?= isset($_GET['error']) ? "<p class='error'>{$_GET['error']}</p>" : '' ?>
                        <input type="text" name="uname" placeholder="USERNAME"> 
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" placeholder="PASSWORD"> 
                    </div>
                    <button type="submit">Log in</button>
                </form>
                <!-- Dodan gumb za preusmeritev -->
                <button onclick="window.location.href = 'index2.php';">Go to Index 2</button>
            </div>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
