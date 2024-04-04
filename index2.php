<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodIQ Home</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<header class="header">
    <a href="#" class="logo">FoodIQ</a>
    <nav class="navbar">
        <a href="index2.php">Napoved</a>
        <a href="oNas.php">O nas</a>
        <a href="about.php">Kontakt</a>
        <a href="index.php">Odjava</a>
    </nav>
</header>

</body>
<div class="event-form-container">
    <form class="event-form">
        <h2>Dodaj dogodek</h2>
        <div class="form-field">
            <label for="month">Mesec:</label>
            <input type="text" id="month" name="month" required>
        </div>
        <div class="form-field">
            <label for="number-of-guests">Št. povabljenih:</label>
            <input type="number" id="number-of-guests" name="number-of-guests" required>
        </div>
        <div class="form-field">
            <label for="event-type">Tip dogodka:</label>
            <select id="event-type" name="event-type" required>
                <option value="">Izberi tip</option>
                <option value="private">Zasebno</option>
                <option value="business">Poslovno</option>
                <option value="other">Drugo</option>
            </select>
        </div>
        <button type="submit" class="submit-btn">OK</button>
    </form>
</div>

</html>

