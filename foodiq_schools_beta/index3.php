<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="assets/style3.css">
    <title>FoodIQ</title>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="assets/img/crn_foodiq.png">
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="index3.php">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Glavna plošča</h3>
                </a>
                <a href="index2.php">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Uporabniki</h3>
                </a>
                <a href="zgodovina.php">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>Zgodovina</h3>
                </a>
                <a href="#" class="active">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analize</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        settings
                    </span>
                    <h3>Nastavitve</h3>
                </a>
                <a href="index.html">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Odjava</h3>
                </a>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <!-- Menu Management Section -->
            <div class="recent-orders">
                <h2>3.1.1 Vnos Menija in Urejanje Menijev</h2>
                <div class="event-container">
                    <form id="menuForm">
                        <label for="menuDate">Datum (privzeto naslednji dan od zadnjega vnosa):</label>
                        <input type="date" id="menuDate" name="menuDate" required>

                        <label for="menuDish">Jed:</label>
                        <input type="text" id="menuDish" name="menuDish" placeholder="Vnesite ime jedi" required>

                        <label for="menuCategory">Kategorija Jedi:</label>
                        <select id="menuCategory" name="menuCategory" required>
                            <option value="" disabled selected>Izberi kategorijo</option>
                            <option value="juha">Juha</option>
                            <option value="priloga">Priloga</option>
                            <option value="glavna jed">Glavna jed</option>
                            <option value="solata">Solata</option>
                            <option value="sladica">Sladica</option>
                            <option value="pijača">Pijača</option>
                            <option value="drugo">Drugo</option>
                        </select>

                        <button type="button" id="addMenuEntry">Nov vnos</button>
                        <button type="reset">Prekliči</button>
                    </form>

                    <h3>Začasni Vnosi</h3>
                    <table id="temporaryEntriesTable">
                        <thead>
                            <tr>
                                <th>Jed</th>
                                <th>Kategorija</th>
                                <th>Urejanje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamic entries will be appended here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quantity Management Section -->
            <div class="recent-orders">
                <h2>3.1.2 Vnos Količin in Urejanje Količin</h2>
                <div class="event-container">
                    <form id="quantityForm">

                        <h4>Jedi iz menija za izbrani datum:</h4>
                        <div id="menuDishes">
                            <!-- Dynamic dishes -->
                        </div>

                        <label for="cookedQuantity">Vpis kuhane količine:</label>
                        <input type="number" id="cookedQuantity" name="cookedQuantity" required>

                        <label for="unusedQuantity">Vpis ne-postrežene količine:</label>
                        <input type="number" id="unusedQuantity" name="unusedQuantity" required>

                        <label for="registeredChildren">Vpis prijavljenih otrok na dan:</label>
                        <input type="number" id="registeredChildren" name="registeredChildren" required>

                        <label for="scannedChildren">Vpis poskeniranih otrok na dan:</label>
                        <input type="number" id="scannedChildren" name="scannedChildren" required>

                        <label for="notes">Polje za opombe:</label>
                        <textarea id="notes" name="notes"></textarea>

                        <button type="button" id="addQuantityEntry">Nov vnos</button>
                        <button type="reset">Prekliči</button>
                    </form>
                </div>
            </div>
        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <!-- Display selected user -->
                <div class="profile">
                    <div class="info">
                        <p>Pozdravljeni, <b id="displayUser"></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                </div>
            </div>
            <!-- End of Nav -->

            <div class="reminders">
                <div class="header">
                    <h2>Opombe</h2>
                    <span class="material-icons-sharp">
                        notifications_none
                    </span>
                </div>
            </div>
        </div>

    </div>
    <script>

    <script src="orders.js"></script>
    <script src="assets/index.js"></script>
    <script src="event.js"></script>
    </script>
</body>

</html>
